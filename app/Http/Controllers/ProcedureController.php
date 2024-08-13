<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Request as Solicitud;
use Illuminate\Support\Facades\Auth;
use App\Models\Inscription;
use App\Models\User;
use App\Models\Firmas;
use PDF;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use App\Models\Preinscripcion;


class ProcedureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $userId = Auth::id();
            $solicitudes = Solicitud::with('course', 'user')->where('usuario_id', $userId)->where('estado', '!=', 'cerrado')->get();
            foreach ($solicitudes as $solicitude) {
                if ($solicitude->estado === 'finalizado') {
                    $solicitude->progress = 100;
                    $solicitude->step = 'Finalizado';
                } elseif ($solicitude->estado === 'secretaria') {
                    $solicitude->progress = 60;
                    $solicitude->step = 'Secretaría';
                } else {
                    $solicitude->progress = 10;
                    $solicitude->step = 'Solicitud';
                }
            }
            $solicitudes = $solicitudes->map(function ($solicitud) {
                $created_at = $solicitud->created_at;
                $hoy = Carbon::now();
                $solicitud->diasTranscurridos = $created_at->diffInDays($hoy);
                return $solicitud;
            });

            $data = [
                'solicitudes' => $solicitudes,
            ];

            return view('procedure.index', $data);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    public function create()
    {
        if (!auth()->user()->can('ver inscripciones')) {
            throw new AuthorizationException('No tienes permiso suficientes para ver los tramites.');
        }
        try {
            $inscriptions = Inscription::with('course', 'user')->where('estado', "solicitado")->get();
            $data = [
                'inscriptions' => $inscriptions,

            ];
            return view('procedure.listprocedure', $data);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }
    public function viewprocedure()
    {
        if (!auth()->user()->can('ver tramites')) {
            throw new AuthorizationException('No tienes permiso suficientes para ver los trámites.');
        }
        try {

            $solicitudes = Solicitud::with('course', 'user')
                ->whereIn('estado', ['solicitud', 'secretaria', 'direccion', 'finalizado', 'observado', 'observado por direccion'])
                ->get();
            $solicitudes = $solicitudes->map(function ($solicitud) {
                $created_at = $solicitud->created_at;
                $hoy = Carbon::now();
                $solicitud->diasTranscurridos = $created_at->diffInDays($hoy);
                return $solicitud;
            });
            $numSolicitudes = $solicitudes->count();

            $data = [
                'numSolicitudes' => $numSolicitudes,
                'solicitudes'       => $solicitudes,

            ];

            return view('procedure.procedureindex', $data);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }
    public function informationrepor()
    {
        if (!auth()->user()->can('ver informe y reportes')) {
            throw new AuthorizationException('No tienes permiso suficientes para ver los reportes.');
        }
        try {

            $solicitud = Solicitud::with('course', 'user')->where('estado', "solicitud")->get();
            $observado = Solicitud::with('course', 'user')->where('estado', "observado")->get();
            $direccion = Solicitud::with('course', 'user')->where('estado', "direccion")->get();
            $obs_dir = Solicitud::with('course', 'user')->where('estado', "observado por direccion")->get();
            $secretaria = Solicitud::with('course', 'user')->where('estado', "secretaria")->get();

            $solicitud = $solicitud->count();
            $observado = $observado->count();
            $direccion = $direccion->count();
            $obs_dir = $obs_dir->count();
            $secretaria = $secretaria->count();


            $solicitudes = Solicitud::where('estado', 'solicitud')->get();
            $entregados = Solicitud::where('estado', 'finalizado')->get();
            $inscrito = Inscription::with('course', 'user')->where('estado', "inscrito")->get();
            $preinscripciones = Preinscripcion::join('curso', 'pre_inscripciones.curso_id', '=', 'curso.id')
                ->select('pre_inscripciones.nombre as nombre', 'pre_inscripciones.apellidos as apellidos', 'pre_inscripciones.email as email', 'pre_inscripciones.direccion as direccion', 'pre_inscripciones.estado_civil as estado_civil', 'pre_inscripciones.ci as ci', 'pre_inscripciones.telefono as telefono', 'pre_inscripciones.fecha_nacimiento as fecha_nacimiento')->get();
            // $cursopreins = Preinscripcion::join('curso', 'pre_inscripciones.curso_id', '=', 'curso.id')->select('curso.nombre_curso as curso')->get();
            // $totalinscrito = $inscrito->count();
            // $totalsolicitud = $solicitud->count();
            // $numSolicitudes = $solicitudes->count();



            $data = [
                'solicitud'    => $solicitud,
                'observado'    => $observado,
                'direccion'    => $direccion,
                'obs_dir'    => $obs_dir,
                'secretaria'    => $secretaria,
                'entregados'    => $entregados,

                // 'numSolicitudes'    => $numSolicitudes,
                // 'numInscriptions'   => $numInscriptions,
                // 'totalinscrito'     => $totalinscrito,
                // 'totalsolicitud'    => $totalsolicitud,
                // 'observed'    => $numobserved,
                'inscritos'         => $inscrito,
                // 'inscriptions'      => $inscriptions,
                'solicitudes'       => $solicitudes,
                // 'solicitud'         => $solicitud,
                'preinscripciones' => $preinscripciones,
            ];
            return view('reportes.information', $data);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    // descargha de pdf pdf
    public function descargarReportePDF(Request $request)
    {
        try {
            $inscriptions = Inscription::with('course', 'user')->where('estado', "solicitado")->get();
            $solicitudes = Solicitud::with('course', 'user')
                ->whereIn('estado', ['solicitud', 'secretaria'])
                ->get();
            $inscrito = Inscription::with('course', 'user')->where('estado', "inscrito")->get();
            $solicitud = Solicitud::with('course', 'user')
                ->whereIn('estado', ['finalizado'])
                ->get();
            $totalinscrito = $inscrito->count();
            $totalsolicitud = $solicitud->count();
            $numSolicitudes = $solicitudes->count();
            $numInscriptions = $inscriptions->count();
            $data = [
                'totalinscrito' => $totalinscrito,
                'numInscriptions' => $numInscriptions,
                'numSolicitudes' => $numSolicitudes,
                'totalsolicitud' => $totalsolicitud,
            ];

            // Genera el contenido del PDF usando una vista blade
            $pdf = PDF::loadView('pdf.report', $data);
            return $pdf->download('reporte.pdf');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    public function estudiantesPDF()
    {
        try {
            $inscrito = Inscription::with('course', 'user')->where('estado', "inscrito")->get();
            $data = [
                'inscritos'         => $inscrito,
            ];
            $pdf = PDF::loadView('pdf.student', $data);
            return $pdf->download('reporte.pdf');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }
    public function inscritosPDF()
    {
        try {
            $inscriptions = Inscription::with('course', 'user')->where('estado', "solicitado")->get();
            $data = [
                'inscriptions'         => $inscriptions,
            ];
            $pdf = PDF::loadView('pdf.inscription', $data);
            return $pdf->download('reporte.pdf');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }
    public function certificatePDF()
    {
        try {
            $solicitudes = Solicitud::with('course', 'user')
                ->whereIn('estado', ['solicitud', 'secretaria'])
                ->get();
            $data = [
                'solicitudes'         => $solicitudes,
            ];
            $pdf = PDF::loadView('pdf.certificate', $data);
            return $pdf->download('reporte.pdf');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    public function entregatePDF()
    {
        try {
            $solicitud = Solicitud::with('course', 'user')
                ->whereIn('estado', ['finalizado'])
                ->get();
            $data = [
                'solicitud'         => $solicitud,
            ];
            $pdf = PDF::loadView('pdf.entregate', $data);
            return $pdf->download('reporte_entregados.pdf');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }
    public function preinscritosPDF()
    {
        try {
            $solicitud = Preinscripcion::all();
            $data = [
                'solicitud'         => $solicitud,
            ];
            $pdf = PDF::loadView('pdf.preinscripciones', $data);
            return $pdf->download('reporte_preinscripciones.pdf');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    public function generatecertificate($id)
    {
        $usuario = Solicitud::with('user')->find($id);
        $query = Solicitud::find($id);
        $query->fecha_emision = Carbon::now();
        $query->estado = "finalizado";
        $query->save();

        $query1 = Firmas::where('certificado_id', $id)
            ->join('usuario', 'firmas.usuario_id', '=', 'usuario.id')
            ->join('persona', 'usuario.persona_id', '=', 'persona.id')
            ->select('persona.nombre', 'persona.apellidos','firmas.hash', 'firmas.created_at as creacion')
            ->get();
        $firmas = Firmas::where('certificado_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();
        $logoUrl = public_path('imgs/escudobolivia.png');
        $pdf = PDF::loadView('pdf.generatecertificate', compact('usuario', 'logoUrl', 'firmas','query1','query'));
        $pdf->setPaper('a4', 'landscape');
        $pdfContent = $pdf->output();
        $nombreCodificado = base64_encode($usuario->user->person->nombre);
        $apellidosCodificados = base64_encode($usuario->user->person->apellidos);
        $idCodificado = base64_encode($usuario->id);
        $fileName = $nombreCodificado . '_' . $apellidosCodificados . $idCodificado . '.pdf';
        file_put_contents(public_path('storage/certificado/' . $fileName), $pdfContent);
        $usuario->archivo = 'certificado/' . $fileName;
        $usuario->save();
        return redirect()->route('listrequest');
    }

    public function deleteandgenerate($id)
    {
        $query = Solicitud::find($id);
        $query->archivo = null;
        $query->save();
        $this->generatecertificate($id);
        return back();
    }

    public function verify($id)
    {
        $query = Solicitud::with('user')->find($id);
        $query1 = Firmas::where('certificado_id', $id)
            ->join('usuario', 'firmas.usuario_id', '=', 'usuario.id')
            ->join('persona', 'usuario.persona_id', '=', 'persona.id')
            ->select('persona.nombre', 'persona.apellidos','firmas.hash','firmas.created_at as creacion')
            ->get();
        $data = [
            'certificado' => $query,
            'firmas' => $query1
        ];
        return view('verify.index', $data);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!auth()->user()->can('ver tramites')) {
            throw new AuthorizationException('No tienes permiso suficientes para ver los tramites.');
        }
        try {
            $solicitude = Solicitud::where('usuario_id', $id)->where('estado', '!=', 'cerrado')->first();

            if ($solicitude) {
                if ($solicitude->estado === 'finalizado') {
                    $solicitude->progress = 100;
                    $solicitude->step = 'Finalizado';
                } elseif ($solicitude->estado === 'secretaria') {
                    $solicitude->progress = 60;
                    $solicitude->step = 'Secretaría';
                } else {
                    $solicitude->progress = 10;
                    $solicitude->step = 'Solicitud';
                }
            } else {
                // Manejar el caso cuando no se encuentra una solicitud para el usuario
                // Por ejemplo, puedes establecer valores predeterminados o redireccionar a una página de error.
            }

            $data = [
                'solicitude' => $solicitude,
            ];

            return view('procedure.viewprocedure', $data);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    public function listpre()
    {
        if (!auth()->user()->can('ver pre inscripciones')) {
            throw new AuthorizationException('No tienes permiso suficientes para ver este modulo.');
        }
        try {
            $preinscrito = Preinscripcion::all();
            $data = [
                'preinscritos' => $preinscrito,
            ];
            return view('procedure.listpre', $data);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage());
        }
    }

    public function editsolicitud($id)
    {
        $request = Solicitud::find($id);
        $user = User::find($request->usuario_id);
        $courses = Course::all();

        // echo "funciona $query";
        $data = [
            'user' => $user,
            'courses' => $courses,
            'request' => $request
        ];
        return view('request.edit', $data);
    }

    public function updatesolicitud(Request $request)
    {
        try {
            $data = Solicitud::find($request->id);
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
            $data->save();
            return back()->with('status', 'Se actualizaron los datos');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al actualizar los datos');
        }
    }
}
