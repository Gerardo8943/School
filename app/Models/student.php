<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function carreras() {
        return $this->belongsToMany(Carrera::class, 'career_student');
    }
    public function inscripciones() {
        return $this->hasMany(Inscripcione::class, 'student_id');
    }
}
