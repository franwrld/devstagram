<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

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

        if ($request->imagen) {
            $imagen = $request->file('imagen');
            // uuid permite crear un id unico a cada imagen
            $nombreImagen = Str::uuid() . '.' . $imagen->extension();
            // Instaciamos la imagen a procesar
            $imagenServidor =  Image::make($imagen);
            // Funcion que permite darle cortar la imagen al tamano deseado
            $imagenServidor->fit(1000, 1000);
            //Guardamos la imagen en perfiles $nombreImagen guarda el nombre unico de la imagen en carpeta perfiles ejemplo perfiles/124148478278.jpg
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            // Guardamos la imagen subida con la ruta asignada y formato
            $imagenServidor->save($imagenPath);
        }

        // Guardar cambios 
        $usuario = User::find(auth()->user()->id);
        // auth()->user()->imagen si solo cambio el nombre pero si tengo foto en BD la mantiene si no null
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;

        $usuario->save();

        // Redireccionar a $usuario-username ultima copia registrada
        return redirect()->route('posts.perfil', $usuario->username);

    }
}
