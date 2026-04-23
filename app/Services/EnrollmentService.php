<?php

namespace App\Services;

use App\Models\student;
use App\Models\Seccione;
use Exception;

class EnrollmentService
{
    /**
     * Valida e inscribe a un estudiante en una sección si cumple las reglas.
     */
    public function enrollStudent(student $student, Seccione $seccion)
    {
        // 1. Validar si Control de Estudio aprueba automáticamente o se pone en estado 'pendiente'.
        // 2. Validar choque de horarios con otras inscripciones activas.
        // 3. Validar si la sección tiene cupo disponible.
    }
}
