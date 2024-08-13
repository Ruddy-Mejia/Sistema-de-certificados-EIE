<?php

namespace App\Http\Controllers;

use App\Models\Cities;
use App\Models\Persona;
use Exception;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\HistorialModel;
use App\Models\Key;
use App\Models\User;
use App\Models\Request as Solicitud;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Auth\Access\AuthorizationException;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can('ver certificados')) {
            throw new AuthorizationException('No tienes permisos suficientes');
        }
        try {
            $solicitudes = Solicitud::with('course', 'user')->where('estado', 'solicitud')->get();
            $editor = Solicitud::with('course', 'user')->where('editor', Auth::user()->id)->where('estado', '!=', 'solicitud')->get();
            $data = [
                'solicitudes' => $solicitudes,
                'editor' => $editor,
            ];

            return view('request.index', $data);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    public function create()
    {
        try {
            $course = Course::all();

            $user = User::where('id', Auth::user()->id)->first();
            $ciudad = User::join('persona', 'usuario.persona_id', '=', 'persona.id')
                ->join('ciudades', 'persona.ciudad', '=', 'ciudades.id')
                ->select('ciudades.nombre as nombre')
                ->where('usuario.id', Auth::user()->id)
                ->first();
            $data = [
                'courses'       => $course,
                'user'          => $user,
                'ciudad' => $ciudad
            ];

            return view('request.add', $data);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $existingSolicitud = Solicitud::where('codigo', $request->voucher)->first();
        if ($existingSolicitud) {
            return back()->withError('El código ya ha sido registrado anteriormente.');
        }
        try {
            $data = new Solicitud();
            $data->curso_id = $request->curso_id;
            $data->estado = "solicitud";
            $data->usuario_id = Auth::user()->id;
            $data->codigo = $request->voucher;
            $time = Carbon::now()->toDateTimeString();
            $now = str_replace(":", ".", $time);
            if ($request->hasFile('boleto')) {
                // $path = $request->file('boleto')->store('comprobantes', 'public');
                $path = $request->file('boleto')->storeAs('comprobantes', "$now" . '.pdf', 'public');
                $data->boleto = $path;
            }
            if ($request->hasFile('ci')) {
                // $path = $request->file('ci')->store('carnet', 'public');
                $path = $request->file('ci')->storeAs('carnet', "$now" . '.pdf', 'public');
                $data->ci = $path;
            }
            if ($request->hasFile('cert_nac')) {
                // $path = $request->file('cert_nac')->store('certificadoNacimiento', 'public');
                $path = $request->file('cert_nac')->storeAs('certificadoNacimiento', "$now" . '.pdf', 'public');
                $data->cert_nac = $path;
            }
            if ($request->hasFile('foto')) {
                // $path = $request->file('cert_nac')->store('certificadoNacimiento', 'public');
                $path = $request->file('foto')->store('foto', 'public');
                $data->foto = $path;
            }
            $data->save();
            return back()->with('status', 'Solicitud registrada exitosamente!');
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
        if (!auth()->user()->can('ver certificados')) {
            throw new AuthorizationException('No tienes permiso suficientes para ver los tramites.');
        }
        try {
            $solicitud = Solicitud::with('course', 'user')->find($id);

            if ($solicitud->estado != 'solicitud') {
                if (Auth::user()->id != $solicitud->editor) {
                    return redirect()->route('listrequest')->with('error', "No tienes permisos suficientes para ver este trámite $solicitud->estado");
                }
            }
            $persona = $solicitud->user->persona_id;
            $query = Persona::find($persona);
            $ciudad = Cities::find($query->ciudad);
            $data = [
                'users'       => $solicitud,
                'ciudad' => $ciudad
            ];
            return view('request.view', $data);
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
        $mailController = new MailController();
        try {
            $data = Solicitud::find($id);
            if($request->estado == "direccion"){
                $user =  User::where('rol',6)->get();
                // dd($user);
                foreach ($user as $value) {
                    $mailController->manager($value->mail,'Notificación de Observación de Trámite',"");
                }
            }
            $clave = Key::where('usuario_id', '=', auth()->user()->id)->first();
            if (!Hash::check($request->clave, $clave->clave)) {
                return back()->with('error', 'Clave incorrecta');
            } else {
                if ($data->checklist != '1,1,1,1' && $request->estado != "secretaria" && $request->estado != "observado") {
                    return back()->with('error', 'Antes debe completar el checklist');
                }
                $historial = new HistorialModel();
                $historial->certificado_id = $id;
                $historial->descripcion = "Cambio de estado a $request->estado";
                $historial->save();
                $data->estado = $request->estado;
                $data->save();
                return back()->with('status', 'El estado se cambio exitosamente!');
            }
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    public function take($id)
    {
        $data = Solicitud::find($id);
        $data->editor = Auth::user()->id;
        $data->estado = 'secretaria';
        $data->save();
        return back()->with('status', 'Trámite tomado');
    }
    public function filesupdate(Request $request, $id)
    {
        try {
            $solicitud = Solicitud::findOrFail($id);
            $path = Storage::disk('public')->put('solicitud', $request['archivo']);
            $solicitud->archivo = $path;
            $solicitud->save();

            return back()->with('status', 'Certificado cargado exitosamente!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    public function feedback(Request $request)
    {
        $mailController = new MailController();
        $consulta = Solicitud::find($request->id);
        $user =  User::where('id', $consulta->usuario_id)->first();
        $mailController->observed($user->mail, 'Notificación de Observación de Trámite', "$request->retro");
        $consulta->retro = $request->retro;
        $consulta->save();
        return back()->with('status', "Retroalimentacion enviada");
    }

    public function history($id)
    {
        if (!auth()->user()->can('ver tramites')) {
            throw new AuthorizationException('No tienes permisos suficientes.');
        }
        $query = HistorialModel::where('certificado_id', $id)->get();
        $data = [
            'query' => $query
        ];
        return view('request.history', $data);
    }
    public function checklist(Request $request, $id)
    {
        $campos = ['item1', 'item2', 'item3', 'item4'];
        $array = [];
        foreach ($campos as $indice => $campo) {
            $valor = $request->input($campo);
            if (!empty($valor)) {
                $array[$indice] = 1;
            } else {
                $array[$indice] = 0;
            }
        }
        $arrayString = implode(',', $array);
        $query = Solicitud::find($id);
        $query->checklist = $arrayString;
        $query->save();
        return back()->with('status', "Checklist guardado");
    }
}
