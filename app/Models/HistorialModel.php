<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialModel extends Model
{
    use HasFactory;
    protected $table = 'historial_procesos';

    protected $fillable = [
        'certificado_id',
        'descripcion'
    ];
}
