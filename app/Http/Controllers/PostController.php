<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show','index']);
    }
    public function index(User $user)
    {
        // Hacer referencia a Post modelo para saber que ID va a obtener para mostrar los posts de ese usuario
        $posts = Post::where('user_id', $user->id)->paginate(10);

        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
            //posts para decirle a la vista que info mostrar
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);

        /*Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);*/

        /*
        Otra Forma de guardar
        $post = new Post;
        $post->titulo = $request->titulo;
        $post->descripcion = $request->descripcion;
        $post->imagen = $request->imagen;
        $post->user_id = auth()->user()->id;
        $post->save();
        */

        /*
        Otra Forma de guardar con relaciones
        
        */

        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('posts.perfil', auth()->user()->username );
    }

    // Mostrar post seleccionado
    public function show(User $user, Post $post)
    {
        return view('posts.show',[
            'post' => $post
        ]);
    }
}
