@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        @include('layouts.left-menu')
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <h1 class="display-6 mb-3">
                        <i class="bi bi-person-video2 me-2"></i> Editar solicitud de certificado
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Editar solicitud</li>
                        </ol>
                    </nav>

                    @include('session-messages')

                    <div class="mb-4">
                        <form class="row g-3" action="{{ route('updatesolicitud') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{$request->id}}">
                            <div class="col-md-3">
                                <label for="inputFirstName" class="form-label">Nombres<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                <input type="text" class="form-control" id="inputFirstName" name="name" placeholder="Ingrese su nombre" value="{{$user->person->nombre}}" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="inputLastName" class="form-label">Apellidos<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                <input type="text" class="form-control" id="inputLastName" name="last_name" placeholder="Ingrese su Apellido" value="{{$user->person->apellidos}}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="inputEmail" class="form-label">Carnet de identidad<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Ingrese su correo electronico" value="{{$user->email}}" readonly>
                            </div>
                            <div class="col-md-12">
                                <label for="inputAddress" class="form-label">Dirección<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                <input type="text" class="form-control" id="inputAddress" name="address" placeholder="Ingrese su direccion" value="{{$user->person->direccion}}" readonly>
                            </div>

                            <div class="col-md-4">
                                <label for="inputCity" class="form-label">Ciudad<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                <input type="text" class="form-control" id="inputCity" name="city" placeholder="La paz..." value="{{$user->person->ciudad}}" readonly>
                            </div>
                            <div class="col-md-4">
                                <label for="inputZip" class="form-label">Código<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                <input type="text" class="form-control" id="inputZip" name="code_student" value="{{$user->person->codigo}}" readonly>
                            </div>
                            <div class="col-md-4">
                                <label for="inputPhone" class="form-label">Teléfono<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                <input type="text" class="form-control" id="inputPhone" name="phone" value="{{$user->person->telefono}}" readonly>
                            </div>
                            <div class="col-md-4">
                                <label for="level_english" class="form-label">Curso<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                <select id="level_english" class="form-select" name="curso_id" required>
                                    @foreach($courses as $course)
                                    <option value="{{$course->id}}">{{$course->nombre_curso }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="inputGender" class="form-label">Cargar código comprobante<sup><i class="bi bi-asterisk text-primary"></i>(código único)</sup></label>
                                <input type="text" name="voucher" id="voucher" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label for="inputGender" class="form-label">Cargar comprobante<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                <input type="file" name="boleto" id="boleto" class="form-control" accept=".jpg,.jpeg,.png,.doc,.docx,.pdf" required>
                            </div>
                            <div class="col-md-4">
                                <label for="inputGender" class="form-label">Cargar carnet de identidad<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                <input type="file" name="ci" id="ci" class="form-control" accept=".jpg,.jpeg,.png,.doc,.docx,.pdf" required>
                            </div>
                            <div class="col-md-4">
                                <label for="inputGender" class="form-label">Cargar certificado de nacimiento<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                <input type="file" name="cert_nac" id="cert_nac" class="form-control" accept=".jpg,.jpeg,.png,.doc,.docx,.pdf" required>
                            </div>
                            <div class="col-12">
                                <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#confirmationModal"><i class="bi bi-person-plus"></i> Actualizar</button>
                            </div>
                            <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">¿Estás seguro?</h5>
                                        </div>
                                        <div class="modal-body">
                                            Al presionar el botón de confirmación usted asumirá la responsabilidad en caso de presentarse errores en sus datos
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-primary">Confirmar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </div>
</div>

@include('components.photos.photo-input')
@endsection
