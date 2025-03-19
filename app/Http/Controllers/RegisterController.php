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

        // validacion
        $request->validate([
            'name' => 'required|min:3',
        ]);
    }
}
