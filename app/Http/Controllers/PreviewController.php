<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Preinscripcion;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class PreviewController extends Controller
{
    public function preview($id)
    {
        if (!auth()->user()->can('ver pre inscripciones')) {
            throw new AuthorizationException('No tienes permisos suficientes');
        }
        $query = Preinscripcion::find($id);
        $couse = Course::find($query->curso_id);
        $data = [
            'nombre' => $query->nombre,
            'fecha' => $query->fecha_nacimiento,
            'apellidos' => $query->apellidos,
            'email' => $query->email,
            'direccion' => $query->direccion,
            'estado' => $query->estado_civil,
            'curso' => $couse->nombre_curso,
            'ci' => $query->ci,
            'ciudad' => $query->ciudad,
            'telefono' => $query->telefono,
            'id' => $query->id
        ];
        return view('procedure/preview', $data);
    }

    public function predelete($id){
        try{
            $query = Preinscripcion::find($id);
            $query->delete();
            return back()->with('status', 'Se borró exitosamente!');
        } catch (\Exception $e) {
            return back()->with('error', 'Ha ocurrido un error');
        }
    }
}
