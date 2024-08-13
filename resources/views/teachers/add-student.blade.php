@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-start">
            @include('layouts.left-menu')
            <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
                <div class="row pt-2">
                    <div class="col ps-4">
                        <h1 class="display-6 mb-3">
                            <i class="bi bi-person-lines-fill"></i> Agregar Nuevo
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Agregar Nuevo</li>
                            </ol>
                        </nav>

                        @include('session-messages')

                        <div class="mb-4">
                            <form class="row g-3" action="{{ route('school.teacher.create') }}" method="POST">
                                @csrf
                                <div class="col-md-3">
                                    <label for="inputFirstName" class="form-label">Nombres<sup><i
                                                class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="text" class="form-control" id="inputFirstName" name="nombre"
                                        placeholder="Ingrese su nombre" required value="{{ old('nombre') }}">
                                </div>
                                <div class="col-md-3">
                                    <label for="inputLastName" class="form-label">Apellidos<sup><i
                                                class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="text" class="form-control" id="inputLastName" name="apellidos"
                                        placeholder="Ingrese su Apellido" required value="{{ old('apellidos') }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputEmail" class="form-label">Carnet de identidad<sup><i
                                                class="bi bi-asterisk text-primary"></i></sup></label>
                                    <!-- <input type="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" name="email" placeholder="Ingrese su Carnet de identidad" required value="{{ old('email') }}"> -->
                                    <input type="number" class="form-control @error('email') is-invalid @enderror"
                                        id="inputEmail" name="email" placeholder="Ingrese su Carnet de identidad" required
                                        value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                {{-- <div class="col-md-6">
                                    <label for="inputPassword" class="form-label">Contraseña<sup><i
                                                class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="password" class="form-control" id="inputPassword" name="password" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword" class="form-label">Confirmar Contraseña<sup><i
                                                class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="password" class="form-control" id="inputPassword" name="confirm_password"
                                        required>
                                </div> --}}
                                <!-- <div class="col-md-6">
                                        <label for="formFile" class="form-label">Foto</label>
                                        <input class="form-control" type="file" id="formFile" onchange="previewFile()">
                                        <div id="previewPhoto"></div>
                                        <input type="hidden" id="photoHiddenInput" name="foto" value="">
                                    </div> -->
                                <div class="col-md-12">
                                    <label for="inputAddress" class="form-label">Dirección<sup><i
                                                class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="text" class="form-control" id="inputAddress" name="direccion"
                                        placeholder="Ingrese su dirección" required value="{{ old('direccion') }}">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Correo electrónico<sup><i
                                                class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="email" class="form-control"  name="mail"
                                        placeholder="Ingrese su correo electrónico" required value="{{ old('mail') }}">
                                </div>
                                <div class="col-md-4">
                                    <label for="inputCity" class="form-label">Ciudad<sup><i
                                                class="bi bi-asterisk text-primary"></i></sup></label>
                                    <select name="ciudad" class="form-select">
                                        <option value="" disabled selected>Selecciona una ciudad</option>
                                        @foreach ($cities as $ciudad)
                                            <option value="{{ $ciudad->id }}">{{ $ciudad->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="inputPhone" class="form-label">Teléfono<sup><i
                                                class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="number" class="form-control" id="inputPhone" name="telefono"
                                        placeholder="Ingrese su teléfono" required value="{{ old('telefono') }}" min="8">
                                </div>
                                <div class="col-md-4">
                                    <label for="inputGender" class="form-label">Género<sup><i
                                                class="bi bi-asterisk text-primary"></i></sup></label>
                                    <select id="inputGender" class="form-select" name="genero" required>
                                        <option value="" disabled selected>Selecciona un género</option>
                                        <option value="masculino" {{ old('gender') == 'masculino' }}>Masculino</option>
                                        <option value="femenino" {{ old('gender') == 'femenino' }}>Femenino</option>
                                    </select>
                                </div>
                                <div class="col-md-12" hidden>
                                    <label for="role" class="form-label">Rol<sup><i
                                                class="bi bi-asterisk text-primary"></i></sup></label>
                                    <select id="role" class="form-select" name="rol_id" required>
                                        {{-- <option value="" disabled selected>Selecciona un rol</option> --}}
                                        <option value="2" selected>Estudiante</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-sm btn-outline-primary"><i
                                            class="bi bi-person-plus"></i> Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @include('layouts.footer')
            </div>
        </div>
    </div>

    @include('components.photos.photo-input')
@endsection
