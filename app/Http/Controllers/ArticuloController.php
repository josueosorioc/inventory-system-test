<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;

class ArticuloController extends Controller
{

    public function index()
    {
        return view('dashboard');
    }

    public function data()
    {
        $articulos = Articulo::with('user')->orderBy('created_at', 'desc')->get();
        return response()->json($articulos, 200);
    }

    public function show(Articulo $articulo)
    {
        $articulo->load('user');
        return view('articulo', compact('articulo'));
    }

    public function form(Articulo $articulo = null)
    {
        if (!empty($articulo)) {
            if (Gate::denies('edit-article', $articulo)) {
                return redirect()->route('list.articles');
            }
            $articulo->load('user');
            return view("form_articulo", ['articulo' => $articulo]);
        }
        return view('form_articulo', ['articulo' => null]);
    }

    public function save(Request $request)
    {
        try {
            if ($request->id) {
                $articulo = Articulo::find($request->id);
                if (Gate::denies('edit-article', $articulo)) {
                    return redirect()->back()->withError("No tienes acceso para editar este artículo");
                }
            }

            $inputs = $request->all();

            $validator = Validator::make($inputs, [
                'nombre' => 'required',
                'descripcion' => 'required',
                'precio' => 'required|numeric|gt:0',
                'cantidad' => 'required|integer|min:0'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withError($validator->errors()->all());
            }

            $inputs['user_id'] = Auth::id();
            Articulo::updateOrCreate(["id" => $request->id], $inputs);

            return redirect()->route('list.articles')->withSuccess("Artículo guardado correctamente");
        } catch (\Exception $e) {
            Log::info("ArticuloController->save() | " . $e->getMessage() . " | Line:" . $e->getLine());
            return redirect()->back()->withError($e->getMessage());
        }
    }

    public function destroy(Articulo $articulo)
    {
        try {
            if (Gate::denies('delete-article', $articulo)) {
                return response()->json(['status' => true, 'message' => 'No puedes eliminar artículos que no son tuyos'], 403);
            }

            $articulo->delete();
            return response()->json(['status' => true, 'message' => 'Artículo eliminado correctamente'], 200);
        } catch (\Exception $e) {
            Log::info("ArticuloController->destroy() | " . $e->getMessage() . " | Line:" . $e->getLine());
            return response()->json(['status' => false, 'message' => $e->getMessage(), 'type' => 'server'], 500);
        }
    }
}
