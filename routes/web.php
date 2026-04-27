<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Sistema\StudentController;
use App\Http\Controllers\Sistema\TeacherController;
use App\Http\Controllers\Sistema\AdminController;

// -----------------------------------------------------------------
// Rutas Landing Page (Para visitantes y plebeyos)
// -----------------------------------------------------------------
Route::get('/', function () {
    return view('landing.welcome');
})->name('home');

// -----------------------------------------------------------------
// Rutas del Sistema Escolar (Requiere estar autenticado)
// -----------------------------------------------------------------

Route::middleware(['auth', 'verified'])->group(function () {

    // Ruta genérica 'dashboard' (puente principal esperado por Fortify y Pruebas)
    // Su ruta completa es '/dashboard'.
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    // Rutas protegidas bajo el prefijo '/sistema'
    Route::prefix('sistema')->group(function () {
        
        // === ESTUDIANTES ===
        Route::prefix('student')->name('student.')->group(function () {
            Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
            Route::post('/enroll', [StudentController::class, 'enroll'])->name('enroll');
        });

        // === PROFESORES ===
        Route::prefix('teacher')->name('teacher.')->group(function () {
            Route::get('/dashboard', [TeacherController::class, 'dashboard'])->name('dashboard');
            Route::post('/assign-grade', [TeacherController::class, 'assignGrade'])->name('grade');
        });

        // === CONTROL DE ESTUDIOS (ADMIN) ===
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        });

    });
});

require __DIR__.'/settings.php';
