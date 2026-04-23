<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    protected $fillable = ['user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function carreras() {
        return $this->belongsToMany(carrera::class, 'career_student');
    }
    public function inscripciones() {
        return $this->hasMany(Inscripcione::class, 'student_id');
    }
}
