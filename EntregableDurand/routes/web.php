<?php

use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/poke', [App\Http\Controllers\pokeController::class, 'LaPokedes']);
