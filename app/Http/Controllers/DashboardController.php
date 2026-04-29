<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Redirige al usuario a su dashboard correspondiente según su rol.
     */
    public function index()
    {
        $user = Auth::user();

        // Si por alguna razón el usuario no tiene rol (no debería pasar), lo mandamos al inicio
        if (!$user->role) {
            return redirect()->route('home');
        }

        // Usamos un match para despachar a la ruta correcta
        return match ($user->role->name) {
            'admin', 'control_estudio' => redirect()->route('admin.dashboard'),
            'profesor'                 => redirect()->route('teacher.dashboard'),
            'estudiante'               => redirect()->route('student.dashboard'),
            default                    => redirect()->route('home'),
        };
    }
}
