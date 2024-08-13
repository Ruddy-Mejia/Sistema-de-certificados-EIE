@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-start">
            @include('layouts.left-menu')
            <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
                <div class="row pt-2">
                    <div class="col ps-4">
                        <h1 class="display-6 mb-3">
                            <i class="bi bi-person-lines-fill"></i>Crear Roles
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Crear Roles</li>
                            </ol>
                        </nav>
                        <div class="mb-4">
                            <div class="row">
                                @include('session-messages')

                                <div class="container">
                                    {{-- <form class="row g-3" action="{{ route('roluser.store') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="nombreRol" class="form-label">Nombre del Rol:</label>
                                            <input type="text" class="form-control" name="nombreRol" id="nombreRol"
                                                placeholder="Ingrese el nombre del rol">
                                        </div>

                                        <div class="table-responsive mb-3">
                                            <label for="permissions" class="form-label">Permisos:</label>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Permiso</th>
                                                        <th>Seleccionar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($permisions as $permission)
                                                        <tr>
                                                            <td>{{ $permission->name }}</td>
                                                            <td>
                                                                <input type="checkbox" name="permissions[]"
                                                                    value="{{ $permission->id }}">
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Guardar Rol</button>
                                    </form> --}}
                                    <form class="container" action="{{ route('roluser.store') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="nombreRol" class="form-label">Nombre del Rol:</label>
                                            <input type="text" class="form-control" name="nombreRol" id="nombreRol"
                                                placeholder="Ingrese el nombre del rol">
                                        </div>
                                        <h2>Permisos</h2>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Módulo</th>
                                                    <th>Crear</th>
                                                    <th>Ver</th>
                                                    <th>Editar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Usuarios</td>
                                                    <td><input type="checkbox" name="permissions[]"
                                                            value="{{ $permisions[0]->id }}"></td>
                                                    <td><input type="checkbox" name="permissions[]"
                                                            value="{{ $permisions[1]->id }}"></td>
                                                    <td><input type="checkbox" name="permissions[]"
                                                            value="{{ $permisions[2]->id }}"></td>
                                                </tr>
                                                <tr>
                                                    <td>Curso</td>
                                                    <td><input type="checkbox" name="permissions[]"
                                                            value="{{ $permisions[3]->id }}"></td>
                                                    <td><input type="checkbox" name="permissions[]"
                                                            value="{{ $permisions[4]->id }}"></td>
                                                    <td><input type="checkbox" name="permissions[]"
                                                            value="{{ $permisions[5]->id }}"></td>
                                                </tr>
                                                <tr>
                                                    <td>Firma</td>
                                                    <td><input type="checkbox" name="permissions[]"
                                                            value="{{ $permisions[6]->id }}"></td>
                                                    <td><input type="checkbox" disabled></td>
                                                    <td><input type="checkbox" disabled></td>
                                                </tr>
                                                <tr>
                                                    <td>Informes y reportes</td>
                                                    <td><input type="checkbox" disabled></td>
                                                    <td><input type="checkbox" name="permissions[]"
                                                            value="{{ $permisions[7]->id }}"></td>
                                                    <td><input type="checkbox" disabled></td>
                                                </tr>
                                                <tr>
                                                    <td>Progreso de trámites</td>
                                                    <td><input type="checkbox" disabled></td>
                                                    <td><input type="checkbox" name="permissions[]"
                                                            value="{{ $permisions[8]->id }}"></td>
                                                    <td><input type="checkbox" disabled></td>
                                                </tr>
                                                <tr>
                                                    <td>Certificados</td>
                                                    <td><input type="checkbox" disabled></td>
                                                    <td><input type="checkbox" name="permissions[]"
                                                            value="{{ $permisions[9]->id }}"></td>
                                                    <td><input type="checkbox" disabled></td>
                                                </tr>
                                                <tr>
                                                    <td>Roles</td>
                                                    <td><input type="checkbox" name="permissions[]"
                                                            value="{{ $permisions[11]->id }}"></td>
                                                    <td><input type="checkbox" disabled></td>
                                                    <td><input type="checkbox" disabled></td>
                                                </tr>
                                                <tr>
                                                    <td>Preinscripciones</td>
                                                    <td><input type="checkbox" disabled></td>
                                                    <td><input type="checkbox" name="permissions[]"
                                                            value="{{ $permisions[12]->id }}"></td>
                                                    <td><input type="checkbox" disabled></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <button type="submit" class="btn btn-primary">Guardar Rol</button>
                                    </form>
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
