<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;

class NoticiaController extends Controller
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
        $view = $request->query('view');

        $query = Noticia::query();
        if ($categoria) {
            $query->where('categoria', $categoria);
        }
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('titulo', 'like', "%$search%")
                  ->orWhere('contenido', 'like', "%$search%");
            });
        }

        $noticias = $query->latest()->paginate(12);
        $categorias = Noticia::select('categoria')
            ->whereNotNull('categoria')
            ->distinct()
            ->orderBy('categoria')
            ->pluck('categoria');

        // Respuesta parcial para AJAX: devuelve solo el listado renderizado
        if ($request->boolean('ajax')) {
            if ($view === 'simple') {
                return view('noticias._list_simple', compact('noticias'))->render();
            }
            return view('noticias._list', compact('noticias'))->render();
        }

        return view('noticias.index', compact('noticias', 'categorias', 'categoria', 'search', 'view'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('noticias.create');
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
            'contenido' => 'required|string',
            'imagen' => 'nullable|string',
            'imagen_file' => 'nullable|image|max:3072',
            'categoria' => 'nullable|string|max:255',
            'fecha' => 'required|date',
        ]);

        if ($request->hasFile('imagen_file')) {
            $path = $request->file('imagen_file')->store('news', 'public');
            $data['imagen'] = Storage::url($path);
        }
        unset($data['imagen_file']);

        $noticia = Noticia::create($data);
        return redirect()->route('noticias.index')->with('status', 'Noticia creada');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Noticia  $noticia
     * @return \Illuminate\Http\Response
     */
    public function show(Noticia $noticia)
    {
        return view('noticias.show', compact('noticia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Noticia  $noticia
     * @return \Illuminate\Http\Response
     */
    public function edit(Noticia $noticia)
    {
        return view('noticias.edit', compact('noticia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Noticia  $noticia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Noticia $noticia)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
            'imagen' => 'nullable|string',
            'imagen_file' => 'nullable|image|max:3072',
            'categoria' => 'nullable|string|max:255',
            'fecha' => 'required|date',
        ]);

        if ($request->hasFile('imagen_file')) {
            $path = $request->file('imagen_file')->store('news', 'public');
            $data['imagen'] = Storage::url($path);
        }
        unset($data['imagen_file']);

        $noticia->update($data);
        return redirect()->route('noticias.index')->with('status', 'Noticia actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Noticia  $noticia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Noticia $noticia)
    {
        $noticia->delete();
        return redirect()->route('noticias.index')->with('status', 'Noticia eliminada');
    }

    /**
     * Extrae imágenes OG/Twitter de una URL externa para usar como miniatura.
     * Admin-only route returns JSON with candidates.
     */
    public function ogImage(Request $request)
    {
        $this->middleware(['auth', 'admin']);

        $url = trim($request->query('url', ''));
        if ($url === '') {
            return response()->json(['data' => [], 'error' => 'URL requerida'], 422);
        }

        $client = new Client(['timeout' => 6.0, 'headers' => [
            'User-Agent' => 'MangaHubBot/1.0 (+https://mangahub.local)'
        ]]);

        $html = '';
        $images = [];
        try {
            $resp = $client->get($url);
            $html = $resp->getBody()->getContents();
        } catch (\Throwable $e) {
            return response()->json(['data' => [], 'error' => 'No se pudo acceder a la URL'], 400);
        }

        // Buscar meta og:image y twitter:image
        $patterns = [
            '/<meta[^>]+property=["\\\']og:image["\\\'][^>]*content=["\\\']([^"\\\']+)["\\\'][^>]*>/i',
            '/<meta[^>]+name=["\\\']twitter:image["\\\'][^>]*content=["\\\']([^"\\\']+)["\\\'][^>]*>/i',
        ];
        foreach ($patterns as $pattern) {
            if (preg_match_all($pattern, $html, $matches)) {
                foreach ($matches[1] as $img) {
                    $images[] = ['title' => 'OG', 'image' => $img];
                }
            }
        }

        // Fallback: buscar primeras imágenes en la página
        if (count($images) === 0) {
            if (preg_match_all('/<img[^>]+src=["\\\']([^"\\\']+)["\\\'][^>]*>/i', $html, $matches)) {
                foreach (array_slice($matches[1], 0, 5) as $img) {
                    // Resolver rutas relativas simples
                    if (str_starts_with($img, '//')) { $img = 'https:' . $img; }
                    $images[] = ['title' => 'IMG', 'image' => $img];
                }
            }
        }

        return response()->json(['data' => $images]);
    }
}
