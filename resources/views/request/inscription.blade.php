@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        @include('layouts.left-menu')
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <h1 class="display-6 mb-3">
                        <i class="bi bi-person-lines-fill"></i> Inscripciones
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Nueva Inscripcion</li>
                        </ol>
                    </nav>

                    @include('session-messages')

                    <div class="mb-4">
                        <form class="row g-3" action="{{route('inscription.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-3">
                                <label for="inputFirstName" class="form-label">Nombres<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                <input type="text" class="form-control" id="inputFirstName" name="name" placeholder="Ingrese su nombre" value="{{$user->nombre}}" readonly>
                                <input type="hidden"  name="usuario_id"  value="{{$user->id}}">
                            </div>
                            <div class="col-md-3">
                                <label for="inputLastName" class="form-label">Apellidos<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                <input type="text" class="form-control" id="inputLastName" name="last_name" placeholder="Ingrese su Apellido" value="{{$user->apellidos}}" readonly >
                            </div>
                            <div class="col-md-6">
                                <label for="inputEmail" class="form-label">Correo Electronico<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Ingrese su correo electronico" value="{{$user->email}}" readonly >
                            </div>
                            <div class="col-md-12">
                                <label for="inputAddress" class="form-label">Direccion<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                <input type="text" class="form-control" id="inputAddress" name="address" placeholder="Ingrese su direccion" value="{{$user->direccion}}" readonly>
                            </div>

                            <div class="col-md-4">
                                <label for="inputCity" class="form-label">Ciudad<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                <input type="text" class="form-control" id="inputCity" name="city" placeholder="La paz..." value="{{$user->ciudad}}" readonly>
                            </div>
                            <div class="col-md-4">
                                <label for="inputZip" class="form-label">Codigo<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                <input type="text" class="form-control" id="inputZip" name="code_student" value="{{$user->codigo}}" readonly>
                            </div>
                            <div class="col-md-4">
                                <label for="inputPhone" class="form-label">Telefono<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                <input type="text" class="form-control" id="inputPhone" name="phone" placeholder="+591 6747......" value="{{$user->telefono}}" readonly>
                            </div>

                            <div class="col-md-4">
                                <label for="level_english" class="form-label">Curso<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                <select id="level_english" class="form-select" name="curso_id" required>
                                    @foreach($courses as $course)
                                    <option value="{{$course->id}}">{{$course->nombre_curso }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="inputGender" class="form-label">Codigo Comprobante<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                <input type="text" name="boleto" id="boleto" class="form-control"  required>
                            </div>


                            <div class="col-12">
                                <button type="submit" class="btn btn-sm btn-outline-primary"><i class="bi bi-person-plus"></i> Guardar</button>
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
