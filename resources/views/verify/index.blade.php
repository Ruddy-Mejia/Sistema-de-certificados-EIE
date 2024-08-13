    @extends('layouts.app')

    @section('content')
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css"
            href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/bootstrap-extended.min.css">
        <link rel="stylesheet" type="text/css"
            href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/fonts/simple-line-icons/style.min.css">
        <link rel="stylesheet" type="text/css"
            href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/colors.min.css">
        <link rel="stylesheet" type="text/css"
            href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
        <style>
            .container-card {
                width: 50%;
            }

            @media (max-width: 768px) {
                * {
                    font-size: 14px;
                }
            }
        </style>

        <body>
            <div class="container">
                <div class="row justify-content-start">
                    <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
                        <div class="row pt-2">
                            <div class="col ps-4">
                                <h1 class="display-6 mb-3">
                                    <i class="bi bi-file-earmark-check"></i> Verificación de certificados
                                </h1>
                                {{-- <div class="card container-card col-md-6"> --}}
                                <div class="row">
                                    <div class="card col-md-6">
                                        <div
                                            style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
                                            <img src="{{ asset('storage/' . $certificado->foto) }}" width="150"
                                                style="margin-top: 10px" alt="Foto del estudiante">

                                            <span>Foto</span>
                                        </div>

                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="media d-flex">
                                                    <div class="media-body text-left">
                                                        <h4 class="primary">{{ $certificado->user->person->nombre }}
                                                            {{ $certificado->user->person->apellidos }}</h4>
                                                        <span>Nombre(s)</span>
                                                    </div>
                                                    <div class="align-self-center">
                                                        <i class="icon-user primary font-large-2 float-right"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="media d-flex">
                                                    <div class="media-body text-left">
                                                        <h4 class="primary">{{ 'La Paz' }}</h4>
                                                        <span>Lugar de emisión</span>
                                                    </div>
                                                    <div class="align-self-center">
                                                        <i class="icon-calendar primary font-large-2 float-right"></i>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="media d-flex">
                                                    <div class="media-body text-left">
                                                        {{-- <h4 class="primary">{{ $certificado->fecha_emision }}</h4> --}}
                                                        <h4 class="primary">{{ substr($certificado->fecha_emision, 0, 10) }}
                                                        </h4>
                                                        <span>Fecha de emisión</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="media d-flex">
                                                    <div class="media-body text-left">
                                                        <h4 class="primary">{{ $certificado->course->nombre_curso }}</h4>
                                                        <span>Curso</span>
                                                    </div>
                                                    <div class="align-self-center">
                                                        <i class="icon-graduation primary font-large-2 float-right"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card col-md-6">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="media d-flex">
                                                    <div class="media-body text-left">
                                                        <h4 class="primary">{{ $firmas[0]->nombre }}
                                                            {{ $firmas[0]->apellidos }}</h4>
                                                        <span>Firma 1</span>
                                                    </div>
                                                    <div class="align-self-center">
                                                        <i class="icon-key primary font-large-2 float-right"></i>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="media d-flex">
                                                    <div class="media-body text-left">
                                                        <h4 class="primary">
                                                            {{ $firmas[0]->hash }}
                                                        </h4>
                                                        <span>Hash</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="media d-flex">
                                                    <div class="media-body text-left">
                                                        <h4 class="primary">{{ $firmas[1]->nombre }}
                                                            {{ $firmas[1]->apellidos }}</h4>
                                                        <span>Firma 2</span>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="media d-flex">
                                                    <div class="media-body text-left">
                                                        <h4 class="primary">
                                                            {{ $firmas[1]->hash }}
                                                        </h4>
                                                        <span>Hash</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="media d-flex">
                                                    <div class="media-body text-left">
                                                        <h4 class="primary">{{ $firmas[2]->nombre }}
                                                            {{ $firmas[2]->apellidos }}</h4>
                                                        <span>Firma 3</span>
                                                    </div>

                                                </div>
                                                <br>
                                                <div class="media d-flex">
                                                    <div class="media-body text-left">
                                                        <h4 class="primary">
                                                            {{ $firmas[2]->hash }}
                                                        </h4>
                                                        <span>Hash</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </body>

        </html>
    @stop
