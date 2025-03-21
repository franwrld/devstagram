@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}
@endsection

@section('contenido')
    <div class="container mx-auto md:flex">
        <!-- Seccion de Foto del post, Likes etc -->
        <div class="md:w-1/2">
            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}">

            <div class="p-3">
                <p>0 likes</p>
            </div>

            <div>
                <p class="font-bold">{{ $post->user->username }}</p>
                <!-- diffForHumnas usa Larvel de la libreria Carbon para formatear las fechas -->
                <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                <p class="mt-5">{{ $post->descripcion }}</p>
            </div>

            @auth
                @if($post->user_id === auth()->user()->id)
                    <form method="POST" action="{{ route('posts.destroy', $post) }}">
                        <!-- Metodo Spoofing -->
                        @method('DELETE')
                        @csrf
                        <input type="submit" value="Eliminar Publicación" class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold mt-4 cursor-pointer"/>
                    </form>
                @endif
            @endauth
            
        </div>
        <!-- Seccion de Comentarios del post -->
        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white p-5 mb-5">
                @auth
                    <p class="text-xl font-bold text-center mb-4">Agrega un nuevo comentario</p>
                    @if (@session('mensaje'))
                        <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                            {{ session('mensaje') }}
                        </div>
                    @endif
                    <!-- Si esta autenticado mostrar -->
                    <form action="{{ route('comentarios.store', ['post' => $post, 'user' => $user ]) }}" method="POST">
                        @csrf
                        <div class="mb-5">
                            <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">Comentario</label>
                            <textarea 
                                id="comentario" 
                                name="comentario"
                                placeholder="Agrega un comentario a la publicación"
                                class="border p-3 w-full rounded-lg @error('name') border-red-500 @enderror"
                            >
                            </textarea>
                            @error('comentario')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                            @enderror
                        </div>

                        <input type="submit" value="Comentar" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold
                        w-full p-3 text-white rounded-lg"/>
                    </form>
                @endauth
                <!-- Caja de Comentarios -->
                <div class="shadow mb-5 mx-h96 overflow-y-scroll">
                    @if ($post->comentarios->count())
                        @foreach ($post->comentarios as $comentario )
                            <div class="p-5 border-gray-300 border-b">
                                <a href="{{ route('posts.perfil', $comentario->user) }}" class="font-bold">
                                    {{ $comentario->user->username }}
                                </a>

                                <p>{{ $comentario->comentario }}</p>

                                <p class="text-sm text-gray-500">{{ $comentario->created_at->diffForHumans() }}</p>
                            </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center">No hay comentarios aun</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection