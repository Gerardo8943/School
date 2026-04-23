<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class carrera extends Model
{
    protected $fillable = ['name'];

    public function students() {
        return $this->belongsToMany(student::class, 'career_student');
    }
    public function materias() {
        return $this->belongsToMany(Materia::class, 'carrera_materia');
    }
}
