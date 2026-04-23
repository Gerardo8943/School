<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $fillable = ['seccion_id', 'titulo', 'descripcion', 'fecha_entrega', 'peso_porcentaje'];

    public function seccion() {
        return $this->belongsTo(Seccione::class);
    }
    public function calificaciones() {
        return $this->hasMany(Calificacione::class);
    }
}
