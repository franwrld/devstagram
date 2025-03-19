<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //
    public function index() 
    {
        return view('auth.register');
    }

    public function store(Request $request) 
    {
        // dd($request); ver que valores se estan enviando al servidor
        // dd($request->get('username')); 

        // validaciones
        $request->validate([
            'name' => 'required|min:3|max:30',
            'username' => 'required|unique:users|min:3|max:25',
            'email' => 'required|unique:users|email|max:35',
            'password' => 'required|max:30',
        ]);
    }
}
