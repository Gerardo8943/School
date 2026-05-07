<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    protected $fillable = ['name', 'codigo_materia', 'credito_materia', 'obligatoria'];

    public function carreras() {
        return $this->belongsToMany(Carrera::class, 'carrera_materia');
    }
    public function secciones() {
        return $this->hasMany(Seccione::class);
    }
}
