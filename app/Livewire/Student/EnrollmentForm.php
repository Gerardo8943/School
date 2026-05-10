<?php

namespace App\Livewire\Student;

use Livewire\Component;
use App\Models\Periodo;
use App\Models\Seccione;
use App\Services\EnrollmentService;
use App\Exceptions\EnrollmentException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

#[Layout('components.layouts.app')]
class EnrollmentForm extends Component
{
    public $student;
    public $carrera;
    public $periodoActivo;

    // Campos Editables (Contacto)
    #[Validate('required|email|max:255')]
    public $email;

    #[Validate('required|string|max:20')]
    public $telefono;

    // Preferencias
    #[Validate('required|in:Matutino,Vespertino,Nocturno')]
    public $turno = 'Matutino';

    #[Validate('accepted')]
    public $aceptoTerminos = false;

    // Selección de Materias/Secciones
    #[Validate('required|array|min:1')]
    public $seccionesSeleccionadas = [];

    public function mount()
    {
        $user = Auth::user();
        $this->student = $user->student;

        // Validar si tiene perfil de estudiante y carrera asignada
        if (!$this->student || $this->student->carreras->isEmpty()) {
            abort(403, 'No tienes una carrera asignada. Contacta a Control de Estudio.');
        }

        $this->carrera = $this->student->carreras->first();
        $this->periodoActivo = Periodo::where('activo', true)->first();

        // Pre-cargar datos editables
        $this->email = $user->email;
        $this->telefono = $user->telefono ?? '';
    }

    public function getSeccionesDisponiblesProperty()
    {
        if (!$this->periodoActivo || !$this->carrera) {
            return collect();
        }

        // Obtener las materias de esta carrera
        $materiasIds = $this->carrera->materias->pluck('id');

        // Obtener las secciones abiertas en el periodo activo para esas materias
        return Seccione::with(['materia', 'profesor'])
            ->whereIn('materia_id', $materiasIds)
            ->where('periodo_id', $this->periodoActivo->id)
            ->get();
    }

    public function save(EnrollmentService $enrollmentService)
    {
        $this->validate();

        // 1. Actualizar datos de contacto del usuario
        $user = Auth::user();
        $user->update([
            'email' => $this->email,
            'telefono' => $this->telefono,
        ]);

        // 2. Procesar Inscripciones usando el Servicio
        DB::beginTransaction();
        try {
            foreach ($this->seccionesSeleccionadas as $seccionId) {
                $seccion = Seccione::findOrFail($seccionId);
                $enrollmentService->enrollStudent($this->student, $seccion);
            }
            DB::commit();

            session()->flash('success', '¡Inscripción procesada correctamente para el periodo ' . $this->periodoActivo->name . '!');
            return redirect()->route('student.dashboard');

        } catch (EnrollmentException $e) {
            DB::rollBack();
            $this->addError('inscripcion', $e->getMessage());
        } catch (\Exception $e) {
            DB::rollBack();
            $this->addError('inscripcion', 'Ocurrió un error inesperado al procesar tu inscripción.');
        }
    }

    public function render()
    {
        return view('livewire.student.enrollment-form');
    }
}
