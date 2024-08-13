<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\SchoolSession;
use App\Interfaces\UserInterface;
use App\Repositories\NoticeRepository;
use App\Interfaces\SchoolClassInterface;
use App\Interfaces\SchoolSessionInterface;
use App\Models\Preinscripcion;
use App\Models\User;
use App\Models\Request;
use Illuminate\Auth\Access\AuthorizationException;
use Carbon\Carbon;

class HomeController extends Controller
{
    use SchoolSession;
    protected $schoolSessionRepository;
    protected $schoolClassRepository;
    protected $userRepository;
    public function __construct(
        UserInterface $userRepository,
        SchoolSessionInterface $schoolSessionRepository,
        SchoolClassInterface $schoolClassRepository
    ) {
        $this->userRepository = $userRepository;
        $this->schoolSessionRepository = $schoolSessionRepository;
        $this->schoolClassRepository = $schoolClassRepository;
    }

    public function index()
    {
        $userCounts = User::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        // Formatea los datos
        $dates = [];
        $userCountData = [];

        foreach ($userCounts as $userCount) {
            $formattedDate = strftime('%m/%y', strtotime("{$userCount->year}-{$userCount->month}-01"));
            $dates[] = $formattedDate;
            $userCountData[] = $userCount->count;
        }

        $solicitudes = Request::selectRaw('DATE_FORMAT(fecha_emision, "%m/%y") as mes, COUNT(*) as cantidad')
            ->groupBy('mes')
            ->orderByRaw('STR_TO_DATE(mes, "%m/%y")') // Ordenar correctamente los meses
            ->get();

        $etiquetas = $solicitudes->pluck('mes');
        $datos = $solicitudes->pluck('cantidad');


        $certificados = Request::all();

        $tiemposEntrega = $certificados->map(function ($certificado) {
            // Calcula la diferencia de tiempo entre created_at y fecha_emision
            return $certificado->created_at->diffInDays($certificado->fecha_emision);
        });

        $tiempoMedio = $tiemposEntrega->avg();


        $solicitado = Request::where('estado', 'solicitud')->count();
        $secretaria = Request::where('estado', 'secretaria')->count();
        $direccion = Request::where('estado', 'direccion')->count();
        $observado = Request::where('estado', 'observado')->count();
        $observadoDir = Request::where('estado', 'observado por direccion')->count();
        $finalizado = Request::where('estado', 'finalizado')->count();


        $classCount = Request::all()->count();
        $preinscriptionCount = Preinscripcion::all()->count();
        $studentCount = User::where('rol', 2)->count();
        $teacherCount = User::where('rol', '!=', 2)->count();
        $pendientes = "";
        $atrasados = "";
        $contador = 0;
        if (auth()->user()->can('crear firma')) {
            $firmas_pendientes = Request::where('estado', 'direccion')->where('estado', '!=', 'finalizado')->count();
            if ($firmas_pendientes > 0) {
                $pendientes = "Tiene $firmas_pendientes certificados pendientes para su revisión y firma";
            }


            $firmas_atrasadas = Request::where('estado', 'direccion')->where('estado', '!=', 'finalizado')->get();
            foreach ($firmas_atrasadas as $query) {
                $created_at = Carbon::parse($query->created_at);
                // $unDiaDespues = Carbon::parse($created_at)->addDay();
                $hoy = Carbon::now();
                $diferencia = $hoy->diffInDays($created_at);

                if ($diferencia > 2) {
                    $contador++;
                }
            }
            if ($contador > 0) {
                $atrasados = "Atención: Tiene certificados $contador pendientes de revisión y firma están atrasados.";
            }
        }
        $data = [
            'classCount'    => $classCount,
            'studentCount'  => $studentCount,
            'teacherCount'  => $teacherCount,
            'pendientes' => $pendientes,
            'atrasados' => $atrasados,
            'userCountData' => $userCountData,
            'dates' => $dates,
            'etiquetas' => $etiquetas,
            'datos' => $datos,
            'preinscriptionCount' => $preinscriptionCount,
            'tiempoMedio' => $tiempoMedio,
            'solicitado' => $solicitado,
            'secretaria' => $secretaria,
            'direccion' => $direccion,
            'observado' => $observado,
            'observadoDir' => $observadoDir,
            'finalizado' => $finalizado,
        ];

        return view('home', $data);
    }
}
