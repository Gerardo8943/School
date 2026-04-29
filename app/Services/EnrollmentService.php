<?php

namespace App\Services;

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
            // 1. Validar que el estudiante no esté ya inscrito en esta sección
            if ($student->inscripciones()->where('seccion_id', $seccion->id)->exists()) {
                throw new EnrollmentException('Ya te encuentras inscrito en esta sección.');
            }

            // 2. Validar si la sección tiene cupo disponible
            // Usamos lockForUpdate() para evitar que el cupo se exceda si muchos se inscriben al mismo tiempo
            $cuposOcupados = $seccion->inscripciones()->lockForUpdate()->count();
            
            if ($cuposOcupados >= $seccion->cupo_maximo) {
                throw new EnrollmentException('No hay cupos disponibles en esta sección.');
            }

            // 3. Crear la inscripción
            return $student->inscripciones()->create([
                'seccion_id' => $seccion->id,
                'status' => 'activa', // MVP: activa por defecto. Luego se puede cambiar a 'pendiente' para control de estudios.
            ]);
        });
    }
}
