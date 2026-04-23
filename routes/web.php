<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Sistema\StudentController;
use App\Http\Controllers\Sistema\TeacherController;
use App\Http\Controllers\Sistema\AdminController;

// -----------------------------------------------------------------
// Rutas Landing Page (Para visitantes y plebeyos)
// -----------------------------------------------------------------
Route::get('/', function () {
    return view('welcome'); // En el futuro será 'landing.home'
})->name('home');

// -----------------------------------------------------------------
// Rutas del Sistema Escolar (Requiere estar autenticado)
// -----------------------------------------------------------------
Route::middleware(['auth', 'verified'])->prefix('sistema')->group(function () {

    // Ruta genérica 'dashboard' (sirve como puente para redirigir según el rol y para que las pruebas no fallen)
    Route::get('/dashboard', function () {
        // Aquí en el futuro redirigiremos según el rol, por ahora enviamos al admin
        // Ejemplo: if(auth()->user()->role->name == 'Estudiante') return redirect()->route('student.dashboard');
        return redirect()->route('admin.dashboard'); 
    })->name('dashboard');
    
    // === ESTUDIANTES ===
    // Envolveremos esto en un middleware de 'role:estudiante' luego
    Route::prefix('student')->name('student.')->group(function () {
        Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
        Route::post('/enroll', [StudentController::class, 'enroll'])->name('enroll');
    });

    // === PROFESORES ===
    // Envolveremos esto en un middleware de 'role:profesor' luego
    Route::prefix('teacher')->name('teacher.')->group(function () {
        Route::get('/dashboard', [TeacherController::class, 'dashboard'])->name('dashboard');
        Route::post('/assign-grade', [TeacherController::class, 'assignGrade'])->name('grade');
    });

    // === CONTROL DE ESTUDIOS (ADMIN) ===
    // Envolveremos esto en un middleware de 'role:control_estudio' luego
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    });

});

require __DIR__.'/settings.php';
