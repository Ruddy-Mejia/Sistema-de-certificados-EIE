<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;
    protected $table = 'semestre';

    protected $fillable = ['nombre_semestre', 'fecha_inicio', 'fecha_fin', 'sesion_id'];
}
