@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('layouts.left-menu')
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Informes') }}</div>
                    <div class="card-body">
                        <div class="row d-flex justify-content-between">

                            <div class="col-md-6 col-sm-12 mb-4">
                                <h3>Trámites</h3>
                                <div class="chart-container" style="max-width: 400px;">
                                    <canvas id="solicitudesChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @php
                            $total_sections = 0;
                        @endphp
                        <div class="col-12">
                            <div class="card my-3">
                                <div class="card-header bg-transparent">
                                    <ul class="nav nav-tabs card-header-tabs">
                                        <li class="nav-item">
                                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#reporte4"
                                                role="tab" aria-current="false"><i
                                                    class="bi bi-journal-text"></i>Solicitudes</button>
                                        </li>
                                        <li class="nav-item">
                                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#reporte5"
                                                role="tab" aria-current="false"><i
                                                    class="bi bi-journal-text"></i>Certificados entregados</button>
                                        </li>
                                        <li class="nav-item">
                                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#reporte6"
                                                role="tab" aria-current="false"><i
                                                    class="bi bi-journal-text"></i>Preinscripciones</button>
                                        </li>
                                    </ul>
                                </div>


                                <div class="card-body text-dark">
                                    <div class="tab-content">
                                        <div class="tab-pane fade" id="reporte2" role="tabpanel">
                                            <div class="card-header">{{ __('Estudiantes Inscritos') }}</div>
                                            <div class="mb-4 p-3 bg-white border shadow-sm">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">N°</th>
                                                                <th scope="col">Nombre</th>
                                                                <th scope="col">Apellidos</th>
                                                                <th scope="col">Telefono</th>
                                                                <th scope="col">Carnet de identidad</th>
                                                                <th scope="col">Curso</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($inscritos as $index => $inscrito)
                                                                <tr>
                                                                    <td>{{ ++$index }}</td>
                                                                    <td>{{ $inscrito->user->person->nombre }}</td>
                                                                    <td>{{ $inscrito->user->person->apellidos }}</td>
                                                                    <td>{{ $inscrito->user->person->telefono }}</td>
                                                                    <td>{{ $inscrito->user->email }}</td>
                                                                    <td>{{ $inscrito->course->nombre_curso }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <a href="{{ route('estudiantesPDF') }}" class="btn btn-primary">Descargar</a>
                                        </div>



                                        <div class="tab-pane fade" id="reporte4" role="tabpanel">
                                            <div class="card-header">{{ __('Solicitud de Certificados') }}</div>
                                            <div class="mb-4 p-3 bg-white border shadow-sm">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">N°</th>
                                                                <th scope="col">Nombre</th>
                                                                <th scope="col">Apellidos</th>
                                                                <th scope="col">Telefono</th>
                                                                <th scope="col">Carnet de identidad</th>
                                                                <th scope="col">Curso</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($solicitudes as $index => $solicitude)
                                                                <tr>
                                                                    <td>{{ ++$index }}</td>
                                                                    <td>{{ $solicitude->user->person->nombre }}</td>
                                                                    <td>{{ $solicitude->user->person->apellidos }}</td>
                                                                    <td>{{ $solicitude->user->person->telefono }}</td>
                                                                    <td>{{ $solicitude->user->email }}</td>
                                                                    <td>{{ $solicitude->course->nombre_curso }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <a href="{{ route('certificatePDF') }}" class="btn btn-primary">Descargar</a>
                                        </div>

                                        <div class="tab-pane fade" id="reporte5" role="tabpanel">
                                            <div class="card-header">{{ __('Certificados Entregados') }}</div>
                                            <div class="mb-4 p-3 bg-white border shadow-sm">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">N°</th>
                                                                <th scope="col">Nombre</th>
                                                                <th scope="col">Apellidos</th>
                                                                <th scope="col">Teléfono</th>
                                                                <th scope="col">Carnet de identidad</th>
                                                                <th scope="col">Curso</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($entregados as $index => $solici)
                                                                <tr>
                                                                    <td>{{ ++$index }}</td>
                                                                    <td>{{ $solici->user->person->nombre }}</td>
                                                                    <td>{{ $solici->user->person->apellidos }}</td>
                                                                    <td>{{ $solici->user->person->telefono }}</td>
                                                                    <td>{{ $solici->user->email }}</td>
                                                                    <td>{{ $solici->course->nombre_curso }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <a href="{{ route('entregatePDF') }}" class="btn btn-primary">Descargar</a>
                                        </div>
                                        <div class="tab-pane fade" id="reporte6" role="tabpanel">
                                            <div class="card-header">{{ __('Preinscripciones') }}</div>
                                            <div class="mb-4 p-3 bg-white border shadow-sm">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">N°</th>
                                                                <th scope="col">Nombre</th>
                                                                <th scope="col">Apellidos</th>
                                                                <th scope="col">Dirección</th>
                                                                <th scope="col">Carnet de identidad</th>
                                                                <th scope="col">Teléfono</th>
                                                                <th scope="col">Fecha de nacimiento</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($preinscripciones as $index => $solici)
                                                                <tr>
                                                                    <td>{{ ++$index }}</td>
                                                                    <td>{{ $solici->nombre }}</td>
                                                                    <td>{{ $solici->apellidos }}</td>
                                                                    <td>{{ $solici->direccion }}</td>
                                                                    <td>{{ $solici->ci }}</td>
                                                                    <td>{{ $solici->telefono }}</td>
                                                                    <td>{{ $solici->fecha_nacimiento }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <a href="{{ route('preinscritosPDF') }}"
                                                class="btn btn-primary">Descargar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/vis/4.21.0/vis.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vis/4.21.0/vis.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.table').DataTable({
                    responsive: true,
                    autoWidth: false,
                    language: {
                        "sEmptyTable": "No hay datos disponibles en la tabla",
                        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix": "",
                        "Showing": "Mostrando",
                        "to": "a",
                        "of": "de",
                        "entries": "entradas",
                        "sInfoThousands": ",",
                        "sLengthMenu": "Mostrar _MENU_ registros",
                        "sLoadingRecords": "Cargando...",
                        "sProcessing": "Procesando...",
                        "sSearch": "Buscar:",
                        "sZeroRecords": "No se encontraron registros coincidentes",
                        "oPaginate": {
                            "sFirst": "Primero",
                            "sLast": "Último",
                            "sNext": "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortAscending": ": Activar para ordenar la columna de manera ascendenteSolicitudes",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        }
                    }
                });
            });
        </script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var solicitud = {{ $solicitud }};
    var observado = {{ $observado }};
    var secretaria = {{ $secretaria }};
    var obs_dir = {{ $obs_dir }};
    var direccion = {{ $direccion }};

    var ctxSolicitudes = document.getElementById('solicitudesChart').getContext('2d');
    var solicitudesChart = new Chart(ctxSolicitudes, {
        type: 'pie',
        data: {
            labels: ['Solicitudes', 'Observados', 'Dirección', 'Secretaría', 'Observador por dirección'],
            datasets: [{
                data: [solicitud, observado, direccion, secretaria, obs_dir],
                backgroundColor: ['#07F65E', '#fa5661', '#f9dc3f', '#7d6fff', '#515760'],
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
                    text: 'Estados de trámites',
                    position: 'bottom'
                }
            }
        }
    });
</script>

    @endsection
