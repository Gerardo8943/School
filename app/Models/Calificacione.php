<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calificacione extends Model
{
    protected $fillable = ['inscripcion_id', 'tarea_id', 'nota', 'tipo', 'locked'];

    public function inscripcion() {
        return $this->belongsTo(Inscripcione::class, 'inscripcion_id');
    }
    public function tarea() {
        return $this->belongsTo(Tarea::class);
    }
}
