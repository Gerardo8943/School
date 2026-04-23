<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seccione extends Model
{
    protected $fillable = ['materia_id', 'periodo_id', 'profesor_id', 'cupo_maximo', 'horario'];

    public function materia() {
        return $this->belongsTo(Materia::class);
    }
    public function periodo() {
        return $this->belongsTo(Periodo::class);
    }
    public function profesor() {
        return $this->belongsTo(User::class, 'profesor_id');
    }
    public function inscripciones() {
        return $this->hasMany(Inscripcione::class, 'seccion_id');
    }
    public function tareas() {
        return $this->hasMany(Tarea::class, 'seccion_id');
    }
}
