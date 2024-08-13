<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $table = 'curso';
    protected $fillable = ['nombre_curso', 'tipo_curso', 'semestre_id', 'sesion_id'];
}
