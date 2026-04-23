<?php

namespace App\Http\Controllers\Sistema;

use App\Http\Controllers\Controller;
use App\Services\EnrollmentService;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function dashboard()
    {
        // Aquí cargaremos la vista del estudiante (materias inscritas, notas parciales, etc.)
        return view('sistema.student.dashboard');
    }

    public function enroll(Request $request, EnrollmentService $enrollmentService)
    {
        // Como tu Mano, me encargo de que el controlador envíe la orden al servicio
        // y no se ensucie las manos con reglas de horario o cruces.
        
        // $student = auth()->user()->student;
        // $seccion = Seccione::find($request->seccion_id);
        
        // $enrollmentService->enrollStudent($student, $seccion);
        
        return redirect()->route('student.dashboard')->with('success', 'Solicitud de inscripción procesada.');
    }
}
