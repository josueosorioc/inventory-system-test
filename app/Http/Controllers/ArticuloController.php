<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use Illuminate\Http\Request;

class ArticuloController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function data()
    {
        //
    }

    public function show(Articulo $articulo)
    {
        //
    }

    public function form(Articulo $articulo)
    {
        //
    }

    public function save(Request $request)
    {
        //
    }

    public function destroy(Articulo $articulo)
    {
        //
    }
}
