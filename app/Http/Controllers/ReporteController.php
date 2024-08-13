<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\User;
use App\Models\Inscription;
use App\Models\Course;
use App\Models\Preinscripcion;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $courses = Course::all();
            $data = [
                'courses' => $courses,
            ];
            return view('sections.index', $data);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request -> validate([
                'captcha' => 'required|captcha'
            ]);
            $persona = new  Preinscripcion();
            $persona->nombre   = $request->nombre;
            $persona->apellidos    =  $request->apellidos;
            $persona->email  = $request->email;
            $persona->telefono        = $request->telefono;
            $persona->direccion      = $request->direccion;
            $persona->ciudad         = $request->ciudad;
            $persona->curso_id          = $request->curso_id;
            $persona->estado_civil = $request->estado_civil;
            $persona->ci = $request->ci;
            $persona->fecha_nacimiento = $request->fecha_nacimiento;
            $persona->save();
            return back()->with('status', 'Solicitud enviada con éxito');
        } catch (\Exception $e) {
            return back()->with('error', 'Error, la solicitud no se envió');
        }
    }

    public function reloadCaptcha(){
        return response()->json(['captcha'=>captcha_img('math')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
