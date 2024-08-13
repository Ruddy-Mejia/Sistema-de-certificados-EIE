<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inscription;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class InscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function create()
    {
        try{
            $user = User::where('id', Auth::user()->id)->first();
            $course = Course::all();
            $data = [
                'courses'       => $course,
                'user'          => $user,
            ];

            return view('request.inscription', $data);
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
            $data = new Inscription();
            $data->usuario_id = $request->usuario_id;
            $data->curso_id    = $request->course_id;
            $data->estado       = "solicitado";
            if ($request->hasFile('boleto')) {
                $path = $request->file('boleto')->store('comprobantes', 'public');
                $data->voucher = $path;
            }
            $data->save();
            return back()->with('status', 'Inscripcion registrada exitosamente!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $inscription = Inscription::find($id);
            $data = [
                'inscription'       => $inscription,
            ];
            return view('request.viewincription', $data);

            } catch (\Exception $e) {
                return back()->withError($e->getMessage());
            }
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
        try{
            $data = Inscription::find($id);
            $data->estado = $request->status;
            $data->save();
            return back()->with('status', 'El estado se cambio exitosamente!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }
    public function fileacademic(Request $request, $id)
    {
        try{
            $solicitud = Inscription::findOrFail($id);
            $path = Storage::disk('public')->put('inscripciones', $request['files']);
            $solicitud->boleto = $path;
            $solicitud->save();

            return back()->with('status', 'Curso cargado exitosamente!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
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
