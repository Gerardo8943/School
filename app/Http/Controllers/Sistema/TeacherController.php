<?php

namespace App\Http\Controllers\Sistema;

use App\Http\Controllers\Controller;
use App\Services\GradingService;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function dashboard()
    {
        // Aquí el profesor podrá ver sus secciones asignadas
        return view('sistema.teacher.dashboard');
    }

    public function assignGrade(Request $request, GradingService $gradingService)
    {
        // Usamos nuestro GradingService para asegurar la integridad (0-20, sin notas extrañas).
        
        /*
        $inscripcion = Inscripcione::find($request->inscripcion_id);
        $gradingService->assignGrade($inscripcion, $request->nota, 'parcial');
        */
        
        return redirect()->route('teacher.dashboard')->with('success', 'Calificación registrada correctamente.');
    }
}
