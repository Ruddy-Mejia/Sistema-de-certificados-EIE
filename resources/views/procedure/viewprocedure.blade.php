<!-- Código de la vista estado-tramite.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        @include('layouts.left-menu')
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <h1 class="display-6 mb-3">
                        <i class="bi bi-person-video2 me-2"></i>Estado de Trámite
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Trámite</li>
                        </ol>
                    </nav>

                    @include('session-messages')

                    <div class="mb-4">
                    @if ($solicitude->count() > 0)

                                <!-- Información de cada solicitud -->
                                <ul class="list-group mb-4">
                                    <li class="list-group-item">Certificado de {{ $solicitude->course->course_name }}</li>
                                </ul>
                                @if($solicitude->archivo && $solicitude->estado == "finalizado" )
                                <div class="row">
                                    <a href="{{ asset('storage/' . $solicitude->archivo) }}" class="btn btn-primary" download>
                                        Descargar Certificado
                                    </a>
                                </div>
                                @else
                                @endif

                                <!-- Gráfica de progreso del trámite para cada solicitud -->
                                <div class="col-4">
                                    <canvas id="progressChart_{{ $solicitude->id }}" style="width: 150px; height: 75px;"></canvas>
                                </div>


                                <script>
                                    // Configuración de la gráfica para esta solicitud
                                    var progress_{{ $solicitude->id }} = {{ $solicitude->progress }};
                                    var ctx_{{ $solicitude->id }} = document.getElementById('progressChart_{{ $solicitude->id }}').getContext('2d');
                                    ctx_{{ $solicitude->id }}.canvas.width = 50; // Ajusta el ancho del gráfico (torta)
                                    ctx_{{ $solicitude->id }}.canvas.height = 50;
                                    var progressChart_{{ $solicitude->id }} = new Chart(ctx_{{ $solicitude->id }}, {
                                        type: 'pie',
                                        data: {
                                            labels: ['Progreso del Trámite'],
                                            datasets: [{
                                                data: [progress_{{ $solicitude->id }}, 100 - progress_{{ $solicitude->id }}],
                                                backgroundColor: ['#007BFF', '#E2E2E2'],
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            plugins: {
                                                legend: {
                                                    display: false
                                                },
                                                title: {
                                                    display: true,
                                                    text: '{{ $solicitude->step }}',
                                                    position: 'bottom'
                                                }
                                            }
                                        }
                                    });
                                </script>

                        @else

                        <!-- Mensaje cuando no se ha solicitado ningún trámite -->
                        <div class="alert alert-info mt-3" role="alert">
                            No se ha solicitado ningún trámite.
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
</div>
@endsection
