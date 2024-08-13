@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        @include('layouts.left-menu')
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <h1 class="display-6 mb-3">
                        <i class="bi bi-person-lines-fill"></i> Listado de Inscritos
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Lista de inscritos</li>
                        </ol>
                    </nav>
                    <div class="mb-4 p-3 bg-white border shadow-sm">
                    <div class="table-responsive">
                        <table id="teachersTable" class="table">
                            <thead>
                                <tr>
                                    <th scope="col">N°</th>
                                    <th scope="col">Nombres</th>
                                    <th scope="col">Apellidos</th>
                                    <th scope="col">Correo Electrónico</th>
                                    <th scope="col">Teléfono</th>
                                    <th scope="col">Curso</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inscriptions as $index => $inscription)
                                <tr>
                                    <td>
                                        {{++$index}}
                                    </td>
                                    <td>{{$inscription->user->person->nombre}}</td>
                                    <td>{{$inscription->user->person->apellidos}}</td>
                                    <td>{{$inscription->user->email}}</td>
                                    <td>{{$inscription->user->person->telefono}}</td>
                                    <td>{{$inscription->course->nombre_curso}}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{route('inscription.show', $inscription->id)}}" role="button" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i> Perfil</a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('.table').DataTable({
        responsive: true,
        autoWidth: false,
        language: {
                    "sEmptyTable":     "No hay datos disponibles en la tabla",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "Showing": "Mostrando",
                    "to" : "a",
                    "of" : "de",
                    "entries" : "entradas",
                    "sInfoThousands":  ",",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sLoadingRecords": "Cargando...",
                    "sProcessing":     "Procesando...",
                    "sSearch":         "Buscar:",
                    "sZeroRecords":    "No se encontraron registros coincidentes",
                    "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                    },
                    "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }
    });
});
</script>
@endsection
