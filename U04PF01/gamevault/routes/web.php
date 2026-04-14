<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GenreController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('games.index');
});


//si l’usuari no ha fet login, no pot entrar. Compleix el requisit de protegir l’aplicació amb autenticació
Route::middleware(['auth', 'verified'])->group(function () {

    // el dashboard redirigeix directament al llistat de videojocs
    Route::get('/dashboard', function () {
        return redirect()->route('games.index'); //el portem al CRUD principal
    })->name('dashboard');

    // Generar totes les rutes del CRUD de videojocs
    Route::resource('games', GameController::class);

    // """   """ del CRUD de gèneres
    Route::resource('genres', GenreController::class);

    // rutes del perfil d'usuari
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';