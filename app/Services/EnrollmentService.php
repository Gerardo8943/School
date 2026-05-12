<?php

namespace App\Services;

use App\Models\Inscripcione;
use App\Models\Student;
use App\Models\Seccione;
use App\Exceptions\EnrollmentException;
use Illuminate\Support\Facades\DB;

class EnrollmentService
{
    /**
     * Valida e inscribe a un estudiante en una sección si cumple las reglas.
     * 
     * @throws EnrollmentException
     */
    public function enrollStudent(Student $student, Seccione $seccion)
    {
        return DB::transaction(function () use ($student, $seccion) {
            // 0. Seguridad: Validar que la materia pertenezca a la carrera del estudiante
            $esMateriaValida = $student->carreras()
                ->whereHas('materias', function($query) use ($seccion) {
                    $query->where('materias.id', $seccion->materia_id);
                })
                ->exists();

            if (!$esMateriaValida) {
                throw new EnrollmentException("La materia {$seccion->materia->name} no pertenece a tu carrera asignada.");
            }

            // 1. Validar que el estudiante no esté ya inscrito en esta sección
            if ($student->inscripciones()->where('seccion_id', $seccion->id)->exists()) {
                throw new EnrollmentException('Ya te encuentras inscrito en esta sección.');
            }

            // 1b. Validar que el estudiante no esté inscrito en otra sección de la misma materia en este periodo
            $yaInscritoEnMateria = $student->inscripciones()
                ->whereHas('seccion', function($query) use ($seccion) {
                    $query->where('materia_id', $seccion->materia_id)
                          ->where('periodo_id', $seccion->periodo_id);
                })
                ->exists();
                
            if ($yaInscritoEnMateria) {
                throw new EnrollmentException("Ya estás inscrito en una sección de la materia: {$seccion->materia->name}.");
            }

            // 2. Validar si la sección tiene cupo disponible
            // lockForUpdate() en una subquery es compatible con PostgreSQL (no en count directo)
            $cuposOcupados = Inscripcione::whereIn(
                'id',
                Inscripcione::where('seccion_id', $seccion->id)->lockForUpdate()->select('id')
            )->count();
            
            if ($cuposOcupados >= $seccion->cupo_maximo) {
                throw new EnrollmentException('No hay cupos disponibles en esta sección.');
            }

            // 3. Crear la inscripción
            return $student->inscripciones()->create([
                'seccion_id' => $seccion->id,
                'status' => 'pendiente', // Control de Estudio aprueba o rechaza después.
            ]);
        });
    }
}
