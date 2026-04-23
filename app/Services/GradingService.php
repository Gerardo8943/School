<?php

namespace App\Services;

use App\Models\Calificacione;
use App\Models\Inscripcione;
use Exception;

class GradingService
{
    /**
     * Asigna una nota validando las reglas de negocio (0 a 20).
     */
    public function assignGrade(Inscripcione $inscripcion, $nota, $tipo, $tareaId = null)
    {
        // 1. Validar que la nota esté entre 0 y 20.
        // 2. Verificar que las notas de este periodo no estén bloqueadas.
        if ($nota < 0 || $nota > 20) {
            throw new Exception("La nota debe estar entre 0 y 20.");
        }
    }
}
