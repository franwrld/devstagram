<?php

use App\Http\Controllers\ImagenController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
//Endpoint = URL

Route::get('/', function () {
    return view('principal');
});
// Registrarse
Route::get('/crear-cuenta', [RegisterController::class, 'index'])->name('register');
Route::post('/crear-cuenta', [RegisterController::class, 'store']);
// Login y LogOut
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');
// Perfil usuario
Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.perfil');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
//Posts
Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');