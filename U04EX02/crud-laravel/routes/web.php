<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TascaController;
use App\Http\Controllers\CategoriaController;

Route::resource('tasques', TascaController::class);
Route::resource('categories', CategoriaController::class);

Route::redirect('/', '/tasques');