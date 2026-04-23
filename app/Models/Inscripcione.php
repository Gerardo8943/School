<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscripcione extends Model
{
    protected $fillable = ['student_id', 'seccion_id', 'status'];

    public function student() {
        return $this->belongsTo(student::class, 'student_id');
    }
    public function seccion() {
        return $this->belongsTo(Seccione::class, 'seccion_id');
    }
    public function calificaciones() {
        return $this->hasMany(Calificacione::class, 'inscripcion_id');
    }
}
