<!-- Código de la vista estado-tramite.blade.php -->

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/vis/4.21.0/vis.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vis/4.21.0/vis.min.js"></script>
    <style>
        #diagrama-flujo {
            width: 80%;
            height: 400px;
            background-color: #f0f0f0;
            margin: 20px auto;
            padding: 20px;
        }
    </style>
</head>
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        @include('layouts.left-menu')
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <h1 class="display-6 mb-3">
                        <i class="bi bi-person-video2 me-2"></i>Estado de Trámite
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Trámite</li>
                        </ol>
                    </nav>

                    @include('session-messages')

                    <div class="mb-4">
                        @if ($solicitudes->count() > 0)
                        @foreach($solicitudes as $solicitude)
                        <!-- <ul class="list-group mb-4">
                            <li class="list-group-item">Información</li>

                        </ul> -->
                        @if($solicitude->estado == "observado" )
                        <div class="card border-danger mb-3" style="max-width: 30rem;">
                        @elseif ($solicitude->estado == "finalizado")
                        <div class="card border-primary mb-3" style="max-width: 30rem;">
                        @else
                        <div class="card border-success mb-3" style="max-width: 30rem;">
                        @endif
                            <!-- <div class="card-header">Header</div> -->
                            <div class="card-body">
                                <h4 class="card-title">Estado del trámite</h4>
                                <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                                <li class="list-group-item"><i class="bi bi-book"></i> Curso: {{ $solicitude->course->nombre_curso }}</li>
                                <li class="list-group-item"><i class="bi bi-card-text"></i> Estado: {{ $solicitude->estado }}</li>
                                <li class="list-group-item"><i class="bi bi-calendar-day"></i> Días trascurridos: {{$solicitude->diasTranscurridos . ' días'}}</li>
                                @if($solicitude->estado == "observado" )
                                <li class="list-group-item "><i style="color: red" class="bi bi-exclamation-diamond-fill"></i> Retroalimentación: {{ $solicitude->retro }}</li>
                                <li class="list-group-item"><a href="{{ route('editsolicitud', ['id' => $solicitude->id]) }}" class="btn btn-primary">Corregir información</a></li>
                                @endif
                            </div>
                        </div>

                        @if($solicitude->archivo && $solicitude->estado == "finalizado" )
                        <div>
                            <a href="{{ asset('storage/' . $solicitude->archivo) }}" class="btn btn-primary" download>
                                <i class="bi bi-download"></i> Descargar Certificado
                            </a>
                            <br>
                            <br>
                        </div>
                        @endif
                        @endforeach
                        @else
                        <div class="alert alert-info mt-3" role="alert">
                            No se ha solicitado ningún trámite.
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
</div>
@endsection
