<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});


//Route::get('/posts', [ApiController::class, 'getPosts']);

Route::get('/posts', [PostController::class, 'index']);

Route::get('/create-post', [ApiController::class, 'createPost']);

Route::get('/update-post', [ApiController::class, 'updatePost']);

Route::get('/delete-post', [ApiController::class, 'deletePost']);

// Ruta que rep el formulari i guarda el favorit
Route::post('/favorit', [PostController::class, 'store']);

// Ruta per eliminar un favorit
Route::post('/eliminar-favorit', [PostController::class, 'destroy']);

// Ruta que mostra només els posts que estan marcats com a favorits
Route::get('/favorits', [PostController::class, 'favorits']);