<?php

namespace App\Livewire\Student;

use App\Exceptions\EnrollmentException;
use App\Models\Carrera;
use App\Models\Periodo;
use App\Models\Seccione;
use App\Models\Student;
use App\Services\EnrollmentService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Isolate;
use Livewire\Component;

#[Layout('components.layouts.app')]
class EnrollmentForm extends Component
{
    // IDs para serialización segura con Livewire - Bloqueados para evitar manipulación
    #[Locked]
    public int $studentId;
    #[Locked]
    public int $carreraId;
    #[Locked]
    public ?int $periodoActivoId;

    // Datos de solo lectura para la vista (recargados en render)
    public string $carreraNombre = '';
    public string $periodoNombre = '';

    // Campos Editables (Contacto)
    public string $email = '';
    public string $telefono = '';
    public string $turno = 'Matutino';
    public bool $aceptoTerminos = false;
    public array $seccionesSeleccionadas = [];

    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . Auth::id()],
            'telefono' => ['nullable', 'string', 'max:20'],
            'turno' => ['required', 'in:Matutino,Vespertino,Nocturno'],
            'aceptoTerminos' => ['accepted'],
            'seccionesSeleccionadas' => ['required', 'array', 'min:1'],
        ];
    }

    public function mount(): void
    {
        $user = Auth::user();
        $student = $user->student;

        // Validar si tiene perfil de estudiante y carrera asignada
        if (!$student || $student->carreras->isEmpty()) {
            abort(403, 'No tienes una carrera asignada. Contacta a Control de Estudio.');
        }

        $carrera = $student->carreras->first();
        $periodo = Periodo::where('activo', true)->first();

        // Almacenamos solo IDs (seguro para serialización de Livewire)
        $this->studentId = $student->id;
        $this->carreraId = $carrera->id;
        $this->periodoActivoId = $periodo?->id;
        $this->carreraNombre = $carrera->name;
        $this->periodoNombre = $periodo?->name ?? 'No disponible';

        // Pre-cargar datos editables
        $this->email = $user->email;
        $this->telefono = $user->telefono ?? '';
    }

    /**
     * Computed property: secciones disponibles para la carrera en el periodo activo.
     * Se recarga desde la BD en cada render, evitando serialización de modelos.
     */
    public function getSeccionesDisponiblesProperty()
    {
        if (!$this->periodoActivoId || !$this->carreraId) {
            return collect();
        }

        $materiasIds = Carrera::find($this->carreraId)
            ->materias
            ->pluck('id');

        return Seccione::with(['materia', 'profesor'])
            ->whereIn('materia_id', $materiasIds)
            ->where('periodo_id', $this->periodoActivoId)
            ->get();
    }

    #[Isolate]
    public function save(EnrollmentService $enrollmentService): void
    {
        $this->validate();

        $user = Auth::user();
        $student = $user->student;

        if (!$student) {
            abort(403, 'Perfil de estudiante no encontrado.');
        }

        // 1. Actualizar datos de contacto del usuario
        $user->update([
            'email' => $this->email,
            'telefono' => $this->telefono,
        ]);

        // 2. Seguridad: Validar que las secciones seleccionadas pertenecen a su carrera y al periodo activo
        $materiasIds = Carrera::find($this->carreraId)->materias->pluck('id');
        $seccionesValidas = Seccione::whereIn('id', $this->seccionesSeleccionadas)
            ->whereIn('materia_id', $materiasIds)
            ->where('periodo_id', $this->periodoActivoId)
            ->pluck('id')
            ->toArray();

        if (count($seccionesValidas) !== count($this->seccionesSeleccionadas)) {
            $this->dispatch('swal:error', [
                'title' => 'Error de Seguridad',
                'text' => 'Se han detectado secciones no válidas para tu carrera.',
            ]);
            return;
        }

        // 3. Procesar Inscripciones en una sola transacción atómica
        DB::beginTransaction();
        try {
            foreach ($this->seccionesSeleccionadas as $seccionId) {
                $seccion = Seccione::findOrFail($seccionId);
                $enrollmentService->enrollStudent($student, $seccion);
            }
            DB::commit();

            session()->flash('swal', [
                'type' => 'success',
                'title' => '¡Inscripción Exitosa!',
                'text' => 'Tu inscripción para el periodo ' . $this->periodoNombre . ' ha sido procesada correctamente.',
            ]);

            $this->redirect(route('student.dashboard'), navigate: true);

        } catch (EnrollmentException $e) {
            DB::rollBack();
            $this->dispatch('swal:error', [
                'title' => 'Error de Inscripción',
                'text' => $e->getMessage(),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            report($e);
            $this->dispatch('swal:error', [
                'title' => 'Error Inesperado',
                'text' => 'Ocurrió un error al procesar tu inscripción. Por favor, intenta de nuevo.',
            ]);
        }
    }

    public function render()
    {
        return view('livewire.student.enrollment-form');
    }
}
