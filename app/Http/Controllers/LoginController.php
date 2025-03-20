<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!auth::attempt(['email' => $request->email,'password' => $request->password])) 
        {
            return back()->with('mensaje', 'Credenciales Incorrectas');
        }

        return redirect()->route('posts.index');
    }
}
