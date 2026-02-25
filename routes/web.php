<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

    Route::middleware(['auth', 'role:admin,control_estudio,estudiante'])->group(function () {

    Route::get('/inscripciones', function () {
        return 'Modulo de Inscripcion';
    });

});

require __DIR__.'/settings.php';
