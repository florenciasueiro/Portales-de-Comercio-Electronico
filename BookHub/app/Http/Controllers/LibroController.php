<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categoria = $request->query('categoria');
        $search = $request->query('search');
        $view = $request->query('view'); // 'simple' para lista

        $query = Libro::query();
        if ($categoria) {
            $query->where('categoria', $categoria);
        }
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('titulo', 'like', "%$search%")
                  ->orWhere('autor', 'like', "%$search%")
                  ->orWhere('descripcion', 'like', "%$search%");
            });
        }

        $libros = $query->latest()->paginate(12);

        $categorias = Libro::select('categoria')
            ->whereNotNull('categoria')
            ->distinct()
            ->orderBy('categoria')
            ->pluck('categoria');

        if ($request->boolean('ajax')) {
            if ($view === 'simple') {
                return view('libros._list_simple', compact('libros'))->render();
            }
            return view('libros._list', compact('libros'))->render();
        }

        return view('libros.index', compact('libros', 'categorias', 'categoria', 'search', 'view'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('libros.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|string',
            'imagen_file' => 'nullable|image|max:2048',
            'categoria' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('imagen_file')) {
            $path = $request->file('imagen_file')->store('covers', 'public');
            $data['imagen'] = Storage::url($path); // /storage/covers/...
        }
        unset($data['imagen_file']);

        $libro = Libro::create($data);
        return redirect()->route('libros.index')->with('status', 'Libro creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function show(Libro $libro)
    {
        return view('libros.show', compact('libro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function edit(Libro $libro)
    {
        return view('libros.edit', compact('libro'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Libro $libro)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|string',
            'imagen_file' => 'nullable|image|max:2048',
            'categoria' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('imagen_file')) {
            $path = $request->file('imagen_file')->store('covers', 'public');
            $data['imagen'] = Storage::url($path);
        }
        unset($data['imagen_file']);

        $libro->update($data);
        return redirect()->route('libros.index')->with('status', 'Libro actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Libro $libro)
    {
        $libro->delete();
        return redirect()->route('libros.index')->with('status', 'Libro eliminado');
    }

    /**
     * Buscar portadas automáticamente usando Jikan API por título.
     * Admin-only route returns JSON array of candidates.
     */
    public function imageSearch(Request $request)
    {
        $this->middleware(['auth', 'admin']);

        $q = trim($request->query('titulo', ''));
        if ($q === '') {
            return response()->json(['data' => [], 'error' => 'Título requerido'], 422);
        }

        $client = new Client(['timeout' => 5.0]);
        $results = [];

        try {
            // Preferir manga; si no hay resultados, buscar anime
            $resp = $client->get('https://api.jikan.moe/v4/manga', [
                'query' => ['q' => $q, 'limit' => 8]
            ]);
            $json = json_decode($resp->getBody()->getContents(), true);
            foreach (($json['data'] ?? []) as $item) {
                $img = $item['images']['jpg']['large_image_url'] ?? ($item['images']['jpg']['image_url'] ?? null);
                if ($img) { $results[] = ['title' => $item['title'] ?? $q, 'image' => $img]; }
            }

            if (count($results) === 0) {
                $resp2 = $client->get('https://api.jikan.moe/v4/anime', [
                    'query' => ['q' => $q, 'limit' => 8]
                ]);
                $json2 = json_decode($resp2->getBody()->getContents(), true);
                foreach (($json2['data'] ?? []) as $item) {
                    $img = $item['images']['jpg']['large_image_url'] ?? ($item['images']['jpg']['image_url'] ?? null);
                    if ($img) { $results[] = ['title' => $item['title'] ?? $q, 'image' => $img]; }
                }
            }
        } catch (\Throwable $e) {
            // Silenciar errores de red y devolver respuesta vacía
        }

        return response()->json(['data' => $results]);
    }
}
