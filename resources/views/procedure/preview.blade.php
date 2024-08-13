@extends('layouts.app')

@section('content')
    <style>
    </style>
    <div class="container">
        <div class="row justify-content-start">
            @include('layouts.left-menu')
            <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
                <div class="row pt-2">
                    <div class="col ps-4">
                        <h1 class="display-6 mb-3">
                            <i class="bi bi-person-lines-fill"></i> Datos del estudiante
                        </h1>
                        <div class="mb-6">
                            <div class="row">
                                <div class="col-sm-8 col-md-12">
                                    <div class="p-3 mb-3 border rounded bg-white">
                                        <table class="table table-responsive mt-4">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Nombre(s):</th>
                                                    <td>{{ $nombre }}</td>
                                                    <th>Apellido(s):</th>
                                                    <td>{{ $apellidos }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Carnet de identidad:</th>
                                                    <td>{{ $ci }}</td>
                                                    <th scope="row">Fecha de nacimiento:</th>
                                                    <td>{{ $fecha }}</td>
                                                </tr>
                                                <tr>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Email:</th>
                                                    <td>{{ $email }}</td>
                                                    <th scope="row">Curso:</th>
                                                    <td>{{ $curso }}</td>

                                                </tr>
                                                <tr>
                                                    <th scope="row">Ciudad:</th>
                                                    <td>{{ $ciudad }}</td>
                                                    <th>Dirección:</th>
                                                    <td>{{ $direccion }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Teléfono:</th>
                                                    <td>{{ $telefono }}</td>
                                                    <th>Estado civil:</th>
                                                    <td>{{ $estado }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('layouts.footer')
            </div>
        </div>
    </div>
@endsection
