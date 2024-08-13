@extends('layouts.app')

@section('content')
    <style>
        .card-counter {
            box-shadow: 2px 2px 10px #DADADA;
            margin: 5px;
            padding: 20px 10px;
            background-color: #fff;
            height: 100px;
            border-radius: 5px;
            transition: .3s linear all;
        }

        .card-counter:hover {
            box-shadow: 4px 4px 20px #DADADA;
            transition: .3s linear all;
        }

        .card-counter.primary {
            background-color: #007bff;
            color: #FFF;
        }

        .card-counter.danger {
            background-color: #ef5350;
            color: #FFF;
        }

        .card-counter.success {
            background-color: #66bb6a;
            color: #FFF;
        }

        .card-counter.info {
            background-color: #26c6da;
            color: #FFF;
        }

        .card-counter.warning {
            background-color: #8c0ed0;
            color: #FFF;
        }

        .card-counter i {
            font-size: 5em;
            opacity: 0.2;
        }

        .card-counter .count-numbers {
            position: absolute;
            right: 35px;
            top: 20px;
            font-size: 32px;
            display: block;
        }

        .card-counter .count-name {
            position: absolute;
            right: 35px;
            top: 65px;
            font-style: italic;
            /* text-transform: capitalize; */
            opacity: 0.5;
            display: block;
            font-size: 18px;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <div class="container">
        <div class="row justify-content-start">
            @include('layouts.left-menu')
            <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
                <div>
                    <p style="font-size: 30px; font-weight: bold; margin-bottom: 5px;"><i class="bi bi-calendar-check"></i>
                        Dashboard</p>
                </div>
                @if (Auth::user()->rol === 2)
                    <div class="row align-items-md-stretch mt-4">
                        <div class="col">
                            <div class="p-3 text-white bg-dark rounded-3">
                                <h3>Bienvenido a la Escuela de Idiomas </h3>
                                <p><i class="bi bi-emoji-heart-eyes"></i> Gracias por tu elección.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-6">
                            <div class="card mb-3">
                                <div class="card-header bg-transparent"><i class="bi bi-calendar-event me-2"></i> Calendario
                                </div>
                                <div class="card-body text-dark">
                                    @include('components.events.event-calendar', [
                                        'editable' => 'false',
                                        'selectable' => 'false',
                                    ])
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row pt-1">
                        <div class="col ps-2">
                            <div class="container">

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card-counter primary">
                                            <i class="fa fa-users"></i>
                                            <span class="count-numbers">{{ $teacherCount }}</span>
                                            <span class="count-name">Usuarios</span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="card-counter danger">
                                            <i class="fa fa-users"></i>
                                            <span class="count-numbers">{{ $studentCount }}</span>
                                            <span class="count-name">Estudiantes</span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="card-counter success">
                                            <i class="fa fa-tasks"></i>
                                            <span class="count-numbers">{{ $classCount }}</span>
                                            <span class="count-name">Certificados</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card-counter info">
                                            <i class="fa fa-clock-o"></i>
                                            <span class="count-numbers">{{ $tiempoMedio }} días</span>
                                            <span class="count-name">Tiempo medio de emisión de certificados</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card-counter warning">
                                            <i class="fa fa-tasks"></i>
                                            <span class="count-numbers">{{ $preinscriptionCount }}</span>
                                            <span class="count-name">Preinscripciones</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <div
                                        style="background-color: #ffffff; padding: 10px; box-shadow: 2px 2px 4px; #888888; border-radius: 10px;">
                                        <canvas id="miGraficaLineal" height="150"></canvas>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div
                                        style="background-color: #ffffff; padding: 10px; box-shadow: 2px 2px 4px; #888888; border-radius: 10px;">
                                        <canvas id="graficoCertificadosPorMes" height="150"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <div
                                        style="background-color: #ffffff; padding: 10px; box-shadow: 2px 2px 4px; #888888; border-radius: 10px;">
                                        <canvas id="graficoProgreso" height="100"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @include('layouts.footer')
            </div>
        </div>
    </div>
    <script>
        var ctx = document.getElementById('miGraficaLineal').getContext('2d');
        // var title = 'xd';
        var data = {
            labels: @json($dates),
            datasets: [{
                label: 'Número de usuarios por mes',
                data: @json($userCountData),
                borderColor: 'blue',
                backgroundColor: 'rgba(13,110,253,0.2)',
                fill: true,
            }]
        };

        var options = {
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Mes'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Cantidad'
                    },
                }
            }
        };

        var miGrafica = new Chart(ctx, {
            type: 'line',
            data: data,
            options: options
        });
    </script>



    <script>
        var ctx = document.getElementById('graficoCertificadosPorMes').getContext('2d');

        var data = {
            labels: @json($etiquetas),
            datasets: [{
                label: 'Número de certificados emitidos por Mes',
                data: @json($datos),
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
            }]
        };

        var opciones = {
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Mes'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Cantidad'
                    },
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        };

        var miGrafico = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: opciones
        });
    </script>
    <script>
        var ctx = document.getElementById('graficoProgreso').getContext('2d');

        var data = {
            labels: ['Solicitud', 'Secretaría', 'Dirección', 'Observado', 'Observado por Dirección', 'Finalizado'],
            datasets: [{
                label: 'Estado de trámites',
                data: [@json($solicitado), @json($secretaria),
                    @json($direccion),
                    @json($observado), @json($observadoDir),
                    @json($finalizado)
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)', // Color para Solicitud
                    'rgba(54, 162, 235, 0.5)', // Color para Secretaría
                    'rgba(75, 192, 192, 0.5)', // Color para Dirección
                    'rgba(255, 206, 86, 0.5)', // Color para Observado
                    'rgba(153, 102, 255, 0.5)', // Color para Observado por Dirección
                    'rgba(200, 200, 200, 0.5)', // Color para Finalizado
                ],
            }]
        };

        var opciones = {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Cantidad'
                    }
                }
            }
        };

        var miGrafico = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: opciones
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @if ($pendientes != '')
        <script>
            const message = @json($pendientes);
            toastr.warning(message);
        </script>
    @endif
    @if ($atrasados != '')
        <script>
            const asd = @json($atrasados);
            toastr.error(asd);
        </script>
    @endif
@endsection
