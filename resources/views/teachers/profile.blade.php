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
                            <i class="bi bi-person-lines-fill"></i> Usuario
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('teacher.list.show') }}">Lista de Usuarios</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Perfil</li>
                            </ol>
                        </nav>
                        <div class="mb-4">
                            <div class="row">
                                <div class="col-sm-4 col-md-3">
                                    <div class="card bg-light">
                                        <div class="px-5 pt-2">
                                            @if (isset($teacher->person->foto))
                                                <img src="{{ asset('/storage' . $teacher->foto) }}"
                                                    class="rounded-3 card-img-top" alt="Profile photo">
                                            @else
                                                <img src="https://i.postimg.cc/4xjMBMmX/pngegg.png"
                                                    class="rounded-3 card-img-top" alt="Profile photo">
                                            @endif
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $teacher->person->nombre }}
                                                {{ $teacher->person->apellidos }}</h5>
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">Género: {{ $teacher->person->genero }}</li>
                                            <li class="list-group-item">Teléfono: {{ $teacher->person->telefono }}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-sm-8 col-md-9">
                                    <div class="p-3 mb-3 border rounded bg-white">
                                        <h6>Informacion de Usuario</h6>
                                        <table class="table table-responsive mt-3">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Nombre(s):</th>
                                                    <td>{{ $teacher->person->nombre }}</td>
                                                    <th>Apellido(s):</th>
                                                    <td>{{ $teacher->person->apellidos }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Carnet de identidad:</th>
                                                    <td>{{ $teacher->email }}</td>
                                                    <th scope="row">Teléfono:</th>
                                                    <td>{{ $teacher->person->telefono }}</td>
                                                </tr>
                                                <tr>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Dirección:</th>
                                                    <td>{{ $teacher->person->direccion }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Mail:</th>
                                                    <td>{{ $teacher->mail }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Ciudad:</th>
                                                    <td>{{ $teacher->ciudad_nombre }}</td>
                                                    <th>Género:</th>
                                                    <td>{{ $teacher->person->genero }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row" style="padding-top: 30px;padding-left:20px">
                                    @if ($errors->has('confirm_password'))
                                        <div class="alert alert-danger">{{ $errors->first('confirm_password') }}</div>
                                    @endif
                                    <div class="col-12">
                                        <h6>Cambio de contraseña</h6>
                                        <form class="row g-3" action="{{ route('updatePassword', $teacher->id) }}"
                                            method="POST">
                                            @csrf
                                            <div class="col-md-3">
                                                <label for="inputFirstName" class="form-label">Nueva Constraseña<sup><i
                                                            class="bi bi-asterisk text-primary"></i></sup></label>
                                                <input type="password" class="form-control" id="password" name="password"
                                                    placeholder="Ingrese su nueva contraseña" required>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="inputFirstName" class="form-label">Confirmar Constraseña<sup><i
                                                            class="bi bi-asterisk text-primary"></i></sup></label>
                                                <input type="password" class="form-control" id="confirm_password"
                                                    name="confirm_password" placeholder="Confirme su nueva contraseña"
                                                    required>
                                            </div>

                                            <div class="col-12">
                                                <button type="submit" class="btn btn-sm btn-outline-primary"><i
                                                        class="bi bi-person-plus"></i> Actualizar</button>
                                            </div>
                                        </form>
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
