@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-start">
            @include('layouts.left-menu')
            <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
                <div class="row pt-2">
                    <div class="col ps-4">
                        <h1 class="display-6 mb-3">
                            <i class="bi bi-person-lines-fill"></i> Datos del solicitante
                        </h1>
                        @include('session-messages')
                        <div class="mb-4">
                            <div class="row">
                                <div class="col-sm-4 col-md-3">
                                    <div class="card bg-light">
                                        <div class="px-5 pt-2">

                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $person->nombre }}
                                                {{ $person->apellidos }}</h5>
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">Género: {{ $person->genero }}</li>
                                            <li class="list-group-item">Teléfono: {{ $person->telefono }}</li>
                                            <li class="list-group-item">Estado: {{ $cert->estado }}</li>
                                            <li class="list-group-item">Código comprobante: {{ $cert->codigo }}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-sm-8 col-md-9">
                                    <div class="p-3 mb-3 border rounded bg-white">
                                        <h6>Información del Solicitante</h6>
                                        <table class="table table-responsive mt-3">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Nombres</th>
                                                    <td>{{ $person->nombre }}</td>
                                                    <th>Apellidos</th>
                                                    <td>{{ $person->apellidos }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Carnet de identidad:</th>
                                                    <td>{{ $user->email }}</td>
                                                    <th scope="row">Nacionalidad:</th>
                                                    <td>{{ $person->nacionalidad }}</td>
                                                </tr>
                                                <tr>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Dirección:</th>
                                                    <td>{{ $person->direccion }}</td>

                                                </tr>
                                                <tr>
                                                    <th scope="row">Ciudad:</th>
                                                    <td>{{ $person->ciudad }}</td>
                                                    <th>Código:</th>
                                                    <td>{{ $person->codigo }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Teléfono:</th>
                                                    <td>{{ $person->telefono }}</td>
                                                    <th>Género:</th>
                                                    <td>{{ $person->genero }}</td>
                                                </tr>
                                                <tr>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="container">
                                            <div class="btn-group">
                                                <button id="btnMostrarPDF1"
                                                    onclick="mostrarPDF('{{ asset('storage/' . $cert->boleto) }}')"
                                                    class="btn-sm btn-primary">Mostrar comprobante</button>
                                                <button id="btnMostrarPDF2"
                                                    onclick="mostrarPDF('{{ asset('storage/' . $cert->cert_nac) }}')"
                                                    class="btn-sm btn-secondary">Mostrar certificado de nacimiento</button>
                                                <button id="btnMostrarPDF3"
                                                    onclick="mostrarPDF('{{ asset('storage/' . $cert->ci) }}')"
                                                    class="btn-sm btn-success">Mostrar carnet de identidad</button>
                                            </div>
                                        </div>
                                    </div>
                                    <form action="{{ route('feedback_direccion') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $cert->id }}">
                                        <div class="col-md-6">
                                            <label for="inputretro" class="form-label">Retroalimentación<sup><i
                                                        class="bi bi-asterisk text-primary"></i></sup></label>
                                            <textarea class="form-control" id="retro" name="retro" rows="3"required
                                                placeholder="Escriba un mensaje de retroalimentación"></textarea>
                                        </div>
                                        <br>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary">Enviar</button>
                                        </div>
                                    </form>
                                    <div id="visorPDF" style="display: none;">
                                        <h2 style="display: block; margin: 0 auto; text-align: center;">Previsualización</h2>
                                        <object data="" type="application/pdf" width="70%" height="600"
                                            style="display: block; margin: 0 auto;"></object>
                                    </div>

                                    <script>
                                        var pdfObject = document.querySelector('object');
                                        var visorPDF = document.getElementById('visorPDF');

                                        function mostrarPDF(pdfPath) {
                                            pdfObject.data = pdfPath;
                                            visorPDF.style.display = 'block';
                                        }
                                    </script>

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
