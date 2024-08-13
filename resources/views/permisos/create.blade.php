@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        @include('layouts.left-menu')
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <h1 class="display-6 mb-3">
                        <i class="bi bi-shield-lock-fill"></i>Crear Permiso
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('permisos.index') }}">Permisos</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Crear Permiso</li>
                        </ol>
                    </nav>
                    <div class="mb-4">
                        <div class="container mt-5">
                            <form method="POST" action="{{ route('permisos.store') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="nombrePermiso" class="form-label">Nombre del Permiso:</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Ingrese el nombre del permiso" required>
                                </div>
                                <div class="mb-3">
                                    <label for="descripcion" class="form-label">Descripción del Permiso:</label>
                                    <textarea class="form-control" id="guard_name" name="guard_name" rows="3" placeholder="Ingrese una descripción del permiso"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Guardar Permiso</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
</div>
@endsection
