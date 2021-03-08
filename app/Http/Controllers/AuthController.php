<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function dashboard()
    {
        if (Auth::check() === true) {
            $obras = Obra::all()->where('status_db', 1)->where('data_final', '=', null)->where('data_inicio', '!=', null);
            return view('home', [
                'obras'=>$obras
            ]);
        }
        return redirect()->route('dashboard.login');
    }

    public function showLoginForm()
    {
        return view('logar');
    }

    public function showCadastroForm()
    {
        return view('cadastro');
    }

    public function login(Request $request)
    {
        if(!filter_var($request->email, FILTER_VALIDATE_EMAIL)){
            return redirect()->back()->withInput()->withErrors(['E-mail invalido']);
        }
        $credentials = [
            'email'=> $request->email,
            'password'=> $request->password
        ];
        if(Auth::attempt($credentials)){
            return redirect()->route('home');
        }

        return redirect()->back()->withInput()->withErrors(['E-mail e/ou senha incorretos']);
    }

    public function cadastro(Request $request)
    {

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function changeColor()
    {
        $user = Auth::user();
        echo "<pre>";
        print_r($user);
        echo "</pre>";
        exit;
    }
}
