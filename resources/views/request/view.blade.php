@extends('layouts.app')

@section('content')
    <style>

    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <div class="container">
        <div class="row justify-content-start">
            @include('layouts.left-menu')
            <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
                <div class="row pt-2">
                    <div class="col ps-4">
                        <h1 class="display-6 mb-3">
                            <i class="bi bi-person-lines-fill"></i> Datos del solicitante
                        </h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('teacher.list.show') }}">Datos del
                                        solicitante</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Perfil</li>
                            </ol>
                        </nav>
                        @include('session-messages')
                        <div class="mb-4">
                            <div class="row">
                                <div class="col-sm-4 col-md-3">
                                    <div class="card bg-light">
                                        <div class="px-5 pt-2">

                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $users->user->person->nombre }}
                                                {{ $users->user->person->apellidos }}</h5>
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">Género: {{ $users->user->person->genero }}</li>
                                            <li class="list-group-item">Teléfono: {{ $users->user->person->telefono }}</li>
                                            <li class="list-group-item">Estado: {{ $users->estado }}</li>
                                            <li class="list-group-item">Código comprobante: {{ $users->codigo }}</li>
                                            @if ($users->estado == 'observado' || $users->estado == 'observado por direccion')
                                                <li class="list-group-item">Retroalimentación de dirección:
                                                    {{ $users->retro_direccion }}</li>
                                            @endif
                                        </ul>
                                    </div>
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h5 class="card-title">Cambio de Estado</h5>
                                        </div>
                                        @if ($users->estado != 'solicitud')
                                            @if ($users->estado != 'finalizado')
                                                <form action="{{ route('request.update', $users->id) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="card-body">
                                                        <input type="hidden" name="id_cert" value="{{ $users->id }}">
                                                        <label for="inputGender" class="form-label">Estado<sup><i
                                                                    class="bi bi-asterisk text-primary"></i></sup></label>
                                                        <select id="inputGender" class="form-select" name="estado"
                                                            required>
                                                            <option value="" disabled selected>Estado</option>
                                                            <option value="observado">Observado</option>
                                                            <option value="direccion">Dirección</option>
                                                            @if ($users->archivo)
                                                                <option value="finalizado">Finalizado</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="card-body">
                                                        <label for="inputGender" class="form-label">Clave<sup><i
                                                            class="bi bi-asterisk text-primary"></i></sup></label>
                                                        <input type="password" name="clave" class="form-control" required>
                                                    </div>
                                                    <div class="card-body">
                                                        <input type="submit" value="Actualizar" class="btn btn-primary">
                                                    </div>
                                                </form>
                                            @else
                                                <li class="list-group-item">Certificado generado <br> Trámite finalizado
                                                </li>
                                            @endif
                                        @else
                                            <form method="POST" action="{{ route('tomar', $users->id) }}"
                                                style="text-align: center;">
                                                <p>Antes debe tomar el trámite</p>
                                                @csrf
                                                <button type="submit" class="btn btn-primary">Tomar</button>
                                            </form>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-sm-8 col-md-9">
                                    <div class="p-3 mb-3 border rounded bg-white">
                                        <h6>Información del Solicitante</h6>
                                        <table class="table table-responsive mt-3">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Nombres</th>
                                                    <td>{{ $users->user->person->nombre }}</td>
                                                    <th>Apellidos</th>
                                                    <td>{{ $users->user->person->apellidos }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Carnet de identidad:</th>
                                                    <td>{{ $users->user->email }}</td>
                                                    <th>Género:</th>
                                                    <td>{{ $users->user->person->genero }}</td>
                                                </tr>
                                                <tr>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Dirección:</th>
                                                    <td>{{ $users->user->person->direccion }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Mail:</th>
                                                    <td>{{ $users->user->mail }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Ciudad:</th>
                                                    <td>{{ $ciudad->nombre }}</td>
                                                    <th scope="row">Teléfono:</th>
                                                    <td>{{ $users->user->person->telefono }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="container">
                                            <div class="btn-group">
                                                <button id="btnMostrarPDF1"
                                                    onclick="mostrarPDF('{{ asset('storage/' . $users->boleto) }}')"
                                                    class="btn-sm btn-primary">Mostrar comprobante</button>
                                                <button id="btnMostrarPDF2"
                                                    onclick="mostrarPDF('{{ asset('storage/' . $users->cert_nac) }}')"
                                                    class="btn-sm btn-secondary">Mostrar certificado de nacimiento</button>
                                                <button id="btnMostrarPDF3"
                                                    onclick="mostrarPDF('{{ asset('storage/' . $users->ci) }}')"
                                                    class="btn-sm btn-success">Mostrar carnet de identidad</button>
                                                <button id="showModalBtn" class="btn-sm btn-info">Checklist</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <div class="d-flex align-items-center">

                                            {{-- <div id="qrcodeContainer"></div> --}}

                                            @if ($users->archivo)
                                                <button id="btnMostrarPDF4"
                                                    onclick="mostrarPDF('{{ asset('storage/' . $users->archivo) }}')"
                                                    class="btn btn-primary">Mostrar certificado</button>
                                                <div></div>
                                                {{-- <a href="{{ route('deleteandgenerate', $users->id) }}"
                                                    class="btn btn-primary">Borrar y volver a generar</a> --}}
                                            @else
                                                <?php
                                                $contador = App\Models\Firmas::where('certificado_id', $users->id)->count();
                                                ?>

                                                @if ($contador >= 3)
                                                    <a href="{{ route('generatecertificate', $users->id) }}"
                                                        class="btn btn-primary">Generar Certificado</a>
                                                @else
                                                    <p>Faltan firmas para generar el certificado.</p>
                                                @endif
                                            @endif
                                        </div>
                                        {{-- @if ($users->notas_subidas != 1)
                                            <div class="card-body" style="padding: 50px 0px 0px 0px">
                                                <h5 class="card-title">Cargar Certificado de Notas</h5>
                                            </div>
                                            @if ($users->archivo == '')
                                                <p>No tiene generado el certificado.</p>
                                            @else
                                                <form action="{{ route('mergePDFsAction', $users->id) }}" method="post"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="card-body">
                                                        <label for="inputGender" class="form-label">Carga de Archivo<sup><i
                                                                    class="bi bi-asterisk text-primary"></i></sup></label>
                                                        <input type="file" name="files" id="files"
                                                            class="form-control">
                                                    </div>
                                                    <div class="card-body">
                                                        <input type="submit" value="Actualizar" class="btn btn-primary">
                                                    </div>
                                                </form>
                                            @endif
                                        @else
                                            <br><br>
                                            <p>El certificado de notas ya fue cargado.</p>
                                        @endif --}}
                                        @if ($users->estado == 'observado')
                                            <form action="{{ route('feedback') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $users->id }}">
                                                <div class="col-md-12">
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
                                        @endif
                                    </div>
                                </div>

                                <div id="visorPDF" style="display: none;">
                                    <h3 style="display: block; margin: 0 auto; text-align: center;">Previsualización</h3>
                                    <br>
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
                                <script>
                                    const showModalBtn = document.getElementById('showModalBtn');

                                    showModalBtn.addEventListener('click', () => {
                                        Swal.fire({
                                            title: 'Checklist',
                                            html: `
                                            <form method="POST" action="{{ route('checklist', $users->id) }}" style="text-align: left;">
                                                @csrf
                                                <input type="checkbox" name="item1" value="Item 1" style="margin-left: 80px;"> Certificado de nacimiento<br>
                                                <input type="checkbox" name="item2" value="Item 2" style="margin-left: 80px;"> Carnet de identidad<br>
                                                <input type="checkbox" name="item3" value="Item 3" style="margin-left: 80px;"> Comprobante<br>
                                                <input type="checkbox" name="item4" value="Item 4" style="margin-left: 80px;"> Datos personales<br>
                                                <br>
                                                <button type="submit" class="btn btn-primary" style="display: block; margin: 0 auto;">Enviar</a>
                                            </form>
                                            `,
                                            showConfirmButton: false,
                                            showCancelButton: true,
                                            showCancelButton: false,
                                            cancelButtonText: 'Cerrar',
                                            preConfirm: () => {
                                                const form = document.getElementById('checklistForm');
                                                const formData = new FormData(form);
                                                const checkedItems = Array.from(formData.values());
                                                console.log('Elementos seleccionados:', checkedItems);
                                            }
                                        });
                                    });
                                </script>

                            </div>

                        </div>
                    </div>
                </div>
                @include('layouts.footer')
            </div>
        </div>
    </div>

    @if ($users->archivo)
        <?php
        $nombreCodificado = base64_encode($users->user->person->nombre);
        $apellidosCodificados = base64_encode($users->user->person->apellidos);
        $idCodificado = base64_encode($users->id);
        $qrUrl = "http://127.0.0.1:8004/storage/certificado/{$nombreCodificado}_{$apellidosCodificados}{$idCodificado}.pdf";
        ?>
        <script>
            const urlToEncode = "{{ $qrUrl }}";
            document.addEventListener("DOMContentLoaded", function() {
                const qrcode = new QRCode(document.getElementById("qrcodeContainer"), {
                    text: urlToEncode,
                    width: 128,
                    height: 128,
                });
                const qrImageLink = document.createElement("a");
                qrImageLink.href = qrcode.getImg().src;
                qrImageLink.download = "qr_code.png";
                qrImageLink.textContent = "Descargar QR";
                document.getElementById("qrcodeContainer").appendChild(qrImageLink);
            });
        </script>
    @endif



@endsection
