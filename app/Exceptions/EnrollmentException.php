<?php

namespace App\Exceptions;

use Exception;

class EnrollmentException extends Exception
{
    // Una excepción dedicada permite que el controlador atrape solo los errores de negocio
    // y no otros errores del sistema por accidente.
}
