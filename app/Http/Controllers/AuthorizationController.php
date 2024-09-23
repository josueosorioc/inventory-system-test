<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AuthorizationController extends Controller
{
    /**
     * Vista de inicio de sesión
     * 
     * @return View
     **/
    public function login()
    {
        return view('login');
    }

    /**
     * Vista de registro
     * 
     * @return View
     **/
    public function register()
    {
        return view('register');
    }

    /**
     * Login de usuarios
     * 
     * @param Request $data
     * @return JsonResponse
     **/
    function validateLogin(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withError($validator->errors()->all());
            }

            if (Auth::attempt($request->only(['email', 'password']))) {
                $request->session()->regenerate();
                $user = User::where('email', $request->email)->first();

                return redirect()->route('list.articles')->withSuccess("Acceso correcto");
            } else {
                return redirect()->back()->withError("Correo o contraseña incorrectos, intenta nuevamente");
            }
        } catch (\Exception $e) {
            Log::info("AuthorizationController->login() | " . $e->getMessage() . " | Line:" . $e->getLine());
            return redirect()->back()->withError($e->getMessage());
        }
    }

    /**
     * Registro de usuarios
     * 
     * @param Request $data
     * @return JsonResponse
     **/
    function registerSave(Request $request)
    {
        try {
            $inputs = $request->all();

            $validator = Validator::make($inputs, [
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withError($validator->errors()->all());
            }

            $user = User::create($inputs);
            Auth::loginUsingId($user->id);

            return redirect()->route('list.articles')->withSuccess("Acceso correcto");
        } catch (\Exception $e) {
            Log::info("AuthorizationController->register() | " . $e->getMessage() . " | Line:" . $e->getLine());
            return redirect()->back()->withError($e->getMessage());
        }
    }

    /**
     * Cierre de sesión
     * 
     * @return JsonResponse
     **/
    function logout(Request $request)
    {
        try {
            $user = User::find(Auth::user()->id);
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login');
        } catch (\Exception $e) {
            Log::info("AuthorizationController->logout() | " . $e->getMessage() . " | Line: " . $e->getLine());
            return redirect()->route('login');
        }
    }
}
