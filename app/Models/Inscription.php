<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    use HasFactory;
    protected $table = 'inscripcion';
    public function course()
    {
        return $this->belongsTo(Course::class, 'curso_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
