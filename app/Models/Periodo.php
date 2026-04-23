<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    protected $fillable = ['name', 'fecha_inicio', 'fecha_fin', 'activo'];

    public function secciones() {
        return $this->hasMany(Seccione::class);
    }
}
