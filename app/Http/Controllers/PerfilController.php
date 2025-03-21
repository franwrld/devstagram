<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function __construct()
    {   
        // Evitamos que personas no autenticadas accedan a editar perfil
        $this->middleware('auth');
    }

    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        // modificar el reequest
        $request->merge(['username' => Str::slug($request->username)]);
        // validaciones pervenir que tenga otro usuario mismo username con unique users, si son mas de 3 validacines van en arrays
        // not_in usernamaes prohibidos y 'unique:users,username,' . auth()->user()->id, para verificar si es el mismo username existente
        $request->validate([
            'username' => [
            'required',
            'unique:users,username,' . auth()->user()->id,
            'min:3',
            'max:25', 
            'not_in:editar-perfil,login,logout,crear-cuenta,dashboard,nazi'
            ]
        ]);
    }
}
