<?php

namespace App\Http\Controllers\Sistema;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // El corazón de Control de Estudios. Aquí manejarán aprobaciones y calendarios fijos.
        return view('sistema.admin.dashboard');
    }
}
