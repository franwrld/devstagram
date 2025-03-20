<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    public function store(Request $request)
    {
        $imagen = $request->file('file');
        // uuid permite crear un id unico a cada imagen
        $nombreImagen = Str::uuid() . '.' . $imagen->extension();
        // Instaciamos la imagen a procesar
        $imagenServidor =  Image::make($imagen);
        // Funcion que permite darle cortar la imagen al tamano deseado
        $imagenServidor->fit(1000, 1000);
        //Guardamos la imagen en uploads $nombreImagen guarda el nombre unico de la imagen en carpeta uploads ejemplo uploads/124148478278.jpg
        $imagenPath = public_path('uploads') . '/' . $nombreImagen;
        // Guardamos la imagen subida con la ruta asignada y formato
        $imagenServidor->save($imagenPath);

        return response()->json(['imagen' => $nombreImagen ]);
    }
}
