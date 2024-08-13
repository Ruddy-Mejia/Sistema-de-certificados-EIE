<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Persona;
use Illuminate\Http\Request;
use App\Models\Firmas;
use App\Models\Key;
use App\Models\Request as Solicitud;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use setasign\Fpdi\Fpdi;
use setasign\Fpdf\Fpdf;
use Illuminate\Auth\Access\AuthorizationException;



class FirmasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    public function create()
    {
        if (!auth()->user()->can('crear firma')) {
            throw new AuthorizationException('No tienes permiso suficientes.');
        }
        try {
            $usuarioActual = Auth::user();

            $solicitudesSinFirma = Solicitud::where('estado', 'direccion')
                ->whereNotIn('id', function ($query) use ($usuarioActual) {
                    $query->select('certificado_id')
                        ->from('firmas')
                        ->where('usuario_id', $usuarioActual->id);
                })
                ->get();
            $filesize = 10;
            $maxFilesize = 10;
            $data = [
                'solicitudes' => $solicitudesSinFirma,
                'filesize'     => $filesize,
                'maxFilesize'  => $maxFilesize
            ];

            return view('firmas.create', $data);
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
        if (!auth()->user()->can('crear firma')) {
            throw new AuthorizationException('No tienes permisos suficientes.');
        }
        $clave = Key::where('usuario_id', '=', auth()->user()->id)->first();
        if (Hash::check($request->clave, $clave->clave)) {
            $imagenFirma = $request->file('firma');
            $rutaImagenFirma = $imagenFirma->store('firmas', 'public');
            $firma = new Firmas();
            $firma->certificado_id = $request->input('certificado_id');
            $firma->archivo = $rutaImagenFirma;
            $firma->usuario_id =  Auth::user()->id;
            $firma->hash = md5($request->clave . Carbon::now() . auth()->user()->nombre . auth()->user()->apellidos);
            $firma->save();
            return back()->with('status', 'Se firmó correctamente');
        } else {
            return back()->with('error', 'La clave no coincide');
        }
    }



    public function mergePDFs($pdfPaths, $outputPath)
    {
        $pdf = new Fpdi();

        foreach ($pdfPaths as $pdfPath) {
            $pageCount = $pdf->setSourceFile($pdfPath);

            for ($i = 1; $i <= $pageCount; $i++) {
                $pdf->AddPage('L');
                $tplIdx = $pdf->importPage($i);
                $pdf->useTemplate($tplIdx);
            }
        }

        $pdf->Output($outputPath, 'F');
    }
    public function mergePDFsAction(Request $request, $id)
    {
        $archive = $request->file('files');
        $data = Solicitud::find($id);
        $pdfPaths = [
            public_path('storage/' . $data->archivo),
            $archive->getRealPath(),
        ];
        $nombreCodificado = base64_encode($data->user->person->nombre);
        $apellidosCodificados = base64_encode($data->user->person->apellidos);
        $idCodificado = base64_encode($data->id);
        $fileName = $nombreCodificado . '_' . $apellidosCodificados . $idCodificado . '.pdf';
        $outputPath = public_path('storage/certificado/' . $fileName);

        $this->mergePDFs($pdfPaths, $outputPath);
        $data->archivo = 'certificado/' . $fileName;
        $data->notas_subidas = 1;
        $data->save();

        return redirect()->route('listrequest')->with('success', 'Firma guardada correctamente');
    }

    public function dataview($id)
    {
        if (!auth()->user()->can('crear firma')) {
            throw new AuthorizationException('No tienes permiso suficientes para crear firmas.');
        }
        $cert = Solicitud::find($id);
        $user = User::find($cert->usuario_id);
        $person = Persona::find($user->persona_id);
        $course = Course::find($cert->curso_id);
        $data = [
            'person' => $person,
            'user' => $user,
            'cert' => $cert,
            'couse' => $course
        ];

        return view('firmas.view', $data);
    }
    public function feedback_direccion(Request $request)
    {
        $consulta = Solicitud::find($request->id);
        $consulta->retro_direccion = $request->retro;
        $consulta->estado = 'observado por direccion';
        $consulta->save();
        return back()->with('status', "Retroalimentacion enviada");
    }
}
