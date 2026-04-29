<?php

namespace App\Http\Controllers\Sistema;

use App\Http\Controllers\Controller;
use App\Services\EnrollmentService;
use Illuminate\Http\Request;

use App\Models\Seccione;
use App\Exceptions\EnrollmentException;

use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function dashboard()
    {
        // Aquí cargaremos la vista del estudiante (materias inscritas, notas parciales, etc.)
        return view('sistema.student.dashboard');
    }

    public function enroll(Request $request, EnrollmentService $enrollmentService)
    {
        $request->validate([
            'seccion_id' => 'required|exists:secciones,id'
        ]);

        $student = Auth::user()->student;
        
        if (!$student) {
            return redirect()->back()->with('error', 'No tienes un perfil de estudiante asignado.');
        }

        $seccion = Seccione::findOrFail($request->seccion_id);

        try {
            $enrollmentService->enrollStudent($student, $seccion);
            return redirect()->route('student.dashboard')->with('success', 'Inscripción procesada correctamente.');
        } catch (EnrollmentException $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
