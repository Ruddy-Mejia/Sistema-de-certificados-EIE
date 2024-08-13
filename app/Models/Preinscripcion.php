<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preinscripcion extends Model
{
    use HasFactory;
    protected $table = 'pre_inscripciones';
    public function curso()
    {
        return $this->belongsTo(Course::class, 'curso_id');
    }
}
