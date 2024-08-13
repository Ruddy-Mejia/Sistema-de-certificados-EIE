@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        @include('layouts.left-menu')
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10" >
            <div class="row pt-2">
                <div class="col ps-4">
                    <h1 class="display-6 mb-3">
                        <i class="bi bi-person-lines-fill"></i> Lista de roles
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Lista Roles</li>
                        </ol>
                    </nav>
                    <a class="btn btn-primary" href="{{ route('roluser.create') }}">Crear Rol</a>
                    <div class="mb-4 p-3 bg-white border shadow-sm">
                        <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">N°</th>
                                    <th scope="col">Nombre</th>
                                    <!-- <th scope="col">Nombre Guardia</th>
                                    <th scope="col">Acciones</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $index => $rol)
                                <tr>
                                    <td>
                                      {{++$index}}
                                    </td>
                                    <td>{{$rol->name}}</td>
                                    <!-- <td>{{$rol->guard_name}}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{url('teachers/view/profile/'.$rol->id)}}" role="button" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i> Profile</a>
                                            @can('edit users')
                                            <a href="{{route('teacher.edit.show', ['id' => $rol->id])}}" role="button" class="btn btn-sm btn-outline-primary"><i class="bi bi-pen"></i> Editar</a>
                                            @endcan

                                        </div>
                                    </td> -->
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/vis/4.21.0/vis.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vis/4.21.0/vis.min.js"></script>
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
    </div>
</div>
@endsection
