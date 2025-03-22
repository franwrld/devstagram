<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function index() 
    {
        return view('auth.register');
    }

    public function store(Request $request) 
    {
        // modificar el reequest
        $request->merge(['username' => Str::slug($request->username)]);

        // dd($request); ver que valores se estan enviando al servidor
        // dd($request->get('username')); 
        //lower para username en minisculas str::slug para cadena url
        // validaciones
        $request->validate([
            'name' => 'required|min:3|max:30',
            'username' => 'required|unique:users|min:3|max:25',
            'email' => 'required|unique:users|email|max:35',
            'password' => 'required|confirmed|min:5|max:30',
        ]);

        //dd($request);
        // hash::make para encriptar la password

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        //Autenticar usuario
        auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);
        //Otra forma de autetificar usuario
        //auth::attempt($request->only('email','password'));
        //Redireccionar
        return redirect()->route('posts.perfil', auth()->user()->username);
    }
}
