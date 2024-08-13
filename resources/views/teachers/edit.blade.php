@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-start">
            @include('layouts.left-menu')
            <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
                <div class="row pt-2">
                    <div class="col ps-4">
                        <h1 class="display-6 mb-3">
                            <i class="bi bi-person-lines-fill"></i> Editar Usuario
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Lista de Usuarios</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Editar Usuario</li>
                            </ol>
                        </nav>

                        @include('session-messages')

                        <div class="mb-4">
                            <form class="row g-3" action="{{ route('school.teacher.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">
                                <input type="hidden" name="persona_id" value="{{ $teacher->persona_id }}">
                                <div class="col-4">
                                    <label for="inputFirstName" class="form-label">Nombres<sup><i
                                                class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="text" class="form-control" id="inputFirstName" name="nombre"
                                        placeholder="First Name" required value="{{ $teacher->person->nombre }}">
                                </div>
                                <div class="col-4">
                                    <label for="inputLastName" class="form-label">Apellidos<sup><i
                                                class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="text" class="form-control" id="inputLastName" name="apellidos"
                                        placeholder="Last Name" required value="{{ $teacher->person->apellidos }}">
                                </div>
                                <div class="col-4">
                                    <label for="inputEmail" class="form-label">Carnet de identidad<sup><i
                                                class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="number" class="form-control" id="inputEmail" name="email" required
                                        value="{{ $teacher->email }}">
                                </div>
                                <div class="col-12">
                                    <label for="inputAddress" class="form-label">Dirección<sup><i
                                                class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="text" class="form-control" id="inputAddress" name="direccion"
                                        placeholder="634 Main St" required value="{{ $teacher->person->direccion }}">
                                </div>


                                <div class="col-4">
                                    <label for="inputCity" class="form-label">Ciudad<sup><i
                                                class="bi bi-asterisk text-primary"></i></sup></label>
                                    <select name="ciudad" class="form-select">
                                        @foreach ($cities as $ciudad)
                                            <option value="{{ $ciudad->id }}">{{ $ciudad->nombre }}</option>
                                        @endforeach
                                    </select>
                                    {{-- <input type="text" class="form-control" id="inputCity" name="ciudad" required
                                        value="{{ $teacher->person->ciudad }}"> --}}
                                </div>


                                <div class="col-4">
                                    <label for="inputPhone" class="form-label">Teléfono<sup><i
                                                class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="text" class="form-control" id="inputPhone" name="telefono"
                                        placeholder="+591 67......" required value="{{ $teacher->person->telefono }}">
                                </div>
                                <div class="col-4">
                                    <label for="inputState" class="form-label">Género<sup><i
                                                class="bi bi-asterisk text-primary"></i></sup></label>
                                    <select id="inputState" class="form-select" name="genero" required>
                                        <option value="masculino" {{ $teacher->person->genero == 'masculino' }}>Masculino
                                        </option>
                                        <option value="femenino" {{ $teacher->person->genero == 'femenino' }}>Femenino
                                        </option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-sm btn-outline-primary"><i
                                            class="bi bi-person-check"></i> Actualizar </button>
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
