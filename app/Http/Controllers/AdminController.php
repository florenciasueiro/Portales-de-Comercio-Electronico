<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Muestra el panel principal de administración.
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }
}