<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;
    protected $table = 'certificado';
    protected $fillable = ['usuario_id','curso_id','archivo', 'boleto','retro','notas_subidas','ci','cert_nac','retro_direccion','checklist', 'fecha_emision','foto', 'editor'];
    public function course()
    {
        return $this->belongsTo(Course::class, 'curso_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

}
