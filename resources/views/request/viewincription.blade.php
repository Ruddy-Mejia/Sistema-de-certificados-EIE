@extends('layouts.app')

@section('content')
<style>
/* .table th:first-child,
.table td:first-child {
  position: relative;
  background-color: #f8f9fa;
} */
</style>
<div class="container">
    <div class="row justify-content-start">
        @include('layouts.left-menu')
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <h1 class="display-6 mb-3">
                        <i class="bi bi-person-lines-fill"></i> Datos del Inscrito
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                          <li class="breadcrumb-item"><a href="{{route('procedure.create')}}">Inscritos</a></li>
                          <li class="breadcrumb-item active" aria-current="page">Perfil</li>
                        </ol>
                    </nav>
                    <div class="mb-4">
                        <div class="row">
                        @include('session-messages')
                            <div class="col-sm-4 col-md-3">
                                <div class="card bg-light">
                                    <div class="px-5 pt-2">

                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{$inscription->user->person->nombre}} {{$inscription->user->person->apellidos}}</h5>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">Genero: {{$inscription->user->person->genero}}</li>
                                        <li class="list-group-item">Telefono: {{$inscription->user->person->telefono}}</li>
                                        <li class="list-group-item">Estado: {{$inscription->estado}}</li>
                                    </ul>
                                </div>
                                <div class="card bg-light">

                                    <div class="card-body">
                                        <h5 class="card-title">Cambio de Estado</h5>
                                    </div>
                                    <form action="{{route('inscription.update', $inscription->id)}}" method="post">
                                    @csrf
                                    @method('PUT')
                                        <div class="card-body">
                                            <label for="inputGender" class="form-label">Estado<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                            <select id="inputGender" class="form-select" name="status" required>
                                                <option value="solicitado">Solicitado</option>
                                                <option value="inscrito">Inscrito</option>

                                            </select>
                                        </div>
                                        <div class="card-body">
                                            <input type="submit" value="Actualizar" class="btn btn-primary">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-sm-8 col-md-9">
                                <div class="p-3 mb-3 border rounded bg-white">
                                    <h6>Informacion del Solicitante</h6>
                                    <table class="table table-responsive mt-3">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Nombres:</th>
                                                <td>{{$inscription->user->person->nombre}}</td>
                                                <th>Apellidos</th>
                                                <td>{{$inscription->user->person->apellidos}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Correo Electronico:</th>
                                                <td>{{$inscription->user->email}}</td>
                                                <th scope="row">Nacionalidad:</th>
                                                <td>{{$inscription->user->person->nacionalidad}}</td>
                                            </tr>
                                            <tr>
                                            </tr>
                                            <tr>
                                                <th scope="row">Direccion:</th>
                                                <td>{{$inscription->user->person->direccion}}</td>

                                            </tr>
                                            <tr>
                                                <th scope="row">Ciudad:</th>
                                                <td>{{$inscription->user->person->ciudad}}</td>
                                                <th>Codigo:</th>
                                                <td>{{$inscription->user->person->codigo}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Telefono:</th>
                                                <td>{{$inscription->user->person->telefono}}</td>
                                                <th>Genero:</th>
                                                <td>{{$inscription->user->person->genero}}</td>
                                            </tr>
                                            <tr>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- <div class="col-sm-12 col-md-6">
                                    <div class="row">
                                        <a href="{{ asset('storage/' . $inscription->boleto) }}" class="btn btn-primary" download>
                                            Descargar Comprobante
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">Cargar Curso</h5>
                                    </div>

                                    <form action="{{route('fileacademic', $inscription->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                        <div class="card-body">
                                            <label for="inputGender" class="form-label">Carga de Archivo<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                            <input type="file" name="boleto" id="boleto" class="form-control">
                                        </div>
                                        <div class="card-body">
                                            <input type="submit" value="Actualizar" class="btn btn-primary">
                                        </div>
                                    </form>
                                </div> -->

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
