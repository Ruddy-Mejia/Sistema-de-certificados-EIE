@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-start">
            @include('layouts.left-menu')
            <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
                <div class="row pt-2">
                    <div class="col ps-4">
                        <h1 class="display-6 mb-3">
                            <i class="bi bi-person-video2 me-2"></i> Agregar Firma
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Ingreso de Firma</li>
                            </ol>
                        </nav>

                        @include('session-messages')

                        <div class="mb-4">
                            <div class="card p-3">
                                <h5 class="card-title text-center">Ingrese su firma</h5>
                                <form class="mt-3" action="{{ route('firma.store') }}" method="POST"
                                    enctype="multipart/form-data" id="myform">
                                    @csrf
                                    <div class="mb-3 custom-file-upload-container">
                                        <label for="firma" class="custom-file-upload">
                                            <i class="bi bi-upload"></i> Carge su firma aquí
                                            <input type="file" name="firma" id="firma" class="form-control "
                                                accept="image/*" required>
                                        </label>
                                        <label>
                                            <i class="bi bi-key-fill"></i> Ingrese su clave
                                            <input type="password" name="clave" id="clave" class="form-control" required>
                                        </label>
                                    </div>
                                    <div class="mb-4 p-3 bg-white border shadow-sm ">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">N°</th>
                                                        <th scope="col">Nombres</th>
                                                        <th scope="col">Apellidos</th>
                                                        {{-- <th scope="col">Carnet de identidad</th> --}}
                                                        <th scope="col">Fecha de inicio del trámite</th>
                                                        <th scope="col">Acciones</th>
                                                    </tr>
                                                </thead>
                                                @foreach ($solicitudes as $index => $solicitud)
                                                    <tbody>
                                                        <tr>
                                                            <td>{{ ++$index }}</td>
                                                            <td>{{ $solicitud->user->person->nombre }}</td>
                                                            <td>{{ $solicitud->user->person->apellidos }}</td>
                                                            {{-- <td>{{ $solicitud->user->email }}</td> --}}
                                                            <td>{{ $solicitud->created_at }}</td>
                                                            <td class="btn-group" role="group">
                                                                <input type="hidden" name="certificado_id"
                                                                    value="{{ $solicitud->id }}">
                                                                <a href="{{ url('dataview/' . $solicitud->id) }}"
                                                                    role="button" class="btn btn-sm btn-outline-primary"><i
                                                                        class="bi bi-eye"></i>
                                                                    Ver información del
                                                                    solicitante</a>
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-outline-primary"><i
                                                                        class="bi bi-person-plus"></i>
                                                                    Firmar</button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
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
    <style>
        .custom-file-upload-container {
            text-align: center;
            padding: 20px;
            border: 2px dashed #ccc;
            border-radius: 4px;
            background-color: #f9f9f9;
        }

        .custom-file-upload {
            cursor: pointer;
            display: block;
            margin: 0 auto;
            padding: 20px;
            font-size: 18px;
        }

        .custom-file-upload-input {
            display: none;
        }
    </style>
@endsection
