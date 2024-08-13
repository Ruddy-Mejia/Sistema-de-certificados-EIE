<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Certificado de Estudio con QR</title>
    <link href="https://fonts.googleapis.com/css2?family=Bernard+MT+Condensed&display=swap" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <style>
        td {
            text-align: center;
        }

        @page {
            size: A4 landscape;
            margin: 10mm;
        }

        body {
            font-family: Arial, sans-serif;
            /* text-align: center; */
            margin: 0;
            padding: 0;
        }

        .certificate {
            width: 1040px;
            height: 690px;
            position: relative;
            border: 5px solid black;
            box-sizing: border-box;
        }

        .content-container {
            width: 100%;
            height: 100%;
            box-sizing: border-box;
            position: absolute;
            top: 50px;
            left: 50%;
            transform: translate(-50%, 0);
        }

        .content-container p {
            text-align: center;
            font-family: "Open Sans", sans-serif;
            font-weight: bold;
            color: black;
            font-size: 24px;
            margin-bottom: 1px;
            line-height: 1.2;
        }

        .content-container span {
            font-size: 24px;
            text-align: left;
            font-family: "Monotype Corsiva", cursive;
            color: black;
            font-style: italic;
            display: inline-block;
            margin-top: 0;
            margin-bottom: 0;
            margin-left: 5px;
        }


        .header {
            text-align: center;
            font-size: 60px;
            font-weight: bold;
            margin-bottom: 1px;
            font-family: "Bernard MT Condensed", sans-serif;
            text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.5);
            /* Agrega un sombreado para mejorar la apariencia */
        }

        .content {
            font-size: 24px;
            padding: 10px;
            text-align: center;
        }

        .content span,
        .content p {
            font-size: 24px;
            text-align: left;
            font-family: "Monotype Corsiva", cursive;
            color: black;
            font-style: italic;
            display: inline;
            margin: 0;
        }

        .qr-code {
            position: absolute;
            top: 30px;
            right: 30px;
        }

        .logo {
            position: absolute;
            top: -50px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            z-index: 1;
        }

        .content-container .signature-container {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin-top: -70px;
            margin-bottom: -70px;
            width: 100%;
            height: 100%;
        }

        .content-container .signature-container .signature0 span {
            font-size: 16px;
            font-family: "Monotype Corsiva", cursive;
            color: black;
            font-style: italic;
            margin-right: 10px;
            text-align: center;
            position: relative;
            top: 90px;
        }

        .content-container .signature-container .signature1 span {
            font-size: 16px;
            font-family: "Monotype Corsiva", cursive;
            color: black;
            margin-top: -7px;
            margin-left: 30%;
            font-style: italic;
            text-align: center;
            top: 80px;
            /* top: -100px; */

        }

        .content-container .signature-container .signature2 span {
            font-size: 16px;
            font-family: "Monotype Corsiva", cursive;
            color: black;
            font-style: italic;
            margin-top: -80px;
            margin-left: 68%;
            text-align: right;
            /* bottom: 150px; */
            /* top: -30px; */
        }

        .content-container .signature-container .signature0 img {
            margin-right: 15px;
            max-width: 100px;
            max-height: 100px;
            position: relative;
            top: 100px;
            margin-left: 3%;
        }

        .content-container .signature-container .signature1 img {
            max-width: 100px;
            max-height: 100px;
            margin-left: 33%;
            align-content: center;
        }

        .content-container .signature-container .signature2 img {
            max-width: 100px;
            max-height: 100px;
            margin-top: -98px;
            margin-left: 70%;
            text-align: right;
            align-content: center;
        }
    </style>
</head>

<body>
    <div class="certificate">
        <img src="{{ public_path('imgs/bolivia.png') }}" alt="Logo" class="logo">
        <div class="qr-code">
            <?php
            $nombreCodificado = base64_encode($usuario->user->person->nombre);
            $apellidosCodificados = base64_encode($usuario->user->person->apellidos);
            $idCodificado = base64_encode($usuario->id);
            // $qrUrl = "https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl=http://127.0.0.1:8004/verificar/$usuario->id";
            $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=http://127.0.0.1:8004/verificar/$usuario->id";
            // $qrUrl = "https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl=https://d977-200-105-171-122.ngrok-free.app/verificar/$usuario->id";
            ?>
            <img src="{{ $qrUrl }}" alt="Código QR del certificado">
        </div>
        <div class="content-container">

            <p>COMANDO GENERAL DEL EJÉRCITO</p>
            <p>DEPARTAMENTO VI - EDUCACIÓN</p>
            <p>ESCUELA DE IDIOMAS DEL EJÉRCITO</p>
            <p>(Res. Min. 696/08)</p>
            <span>Confiere el presente: </span>
            <div class="header">CERTIFICADO DE EGRESO</div>
            <div class="content">
                @if ($usuario->user->person->genero === 'femenino')
                    <span>A la Señora. </span>
                    <p>{{ $usuario->user->person->nombre }} {{ $usuario->user->person->apellidos }}</p><br>
                @else
                    <span>Al Señor. </span>
                    <p>{{ $usuario->user->person->nombre }} {{ $usuario->user->person->apellidos }}</p><br>
                @endif

                <span>Por haber cumplido con los requisitos establecidos en el Reglamento de Administración </span>
                <span>Académica, Plan de Estudios, Diseño curricular y aprobado el </span>
                <p>"{{ $usuario->course->nombre_curso }}"</p>
                <span>aplicando el método {{ $usuario->course->metodo_estudio }} con un carga horaria de
                    {{ $usuario->course->carga_horaria }} horas académicas</span>

            </div><br><br><br><br><br>
            <table class="table" style="margin: 0 auto; width: 100%;">
                @foreach ($firmas as $key => $firma)
                    <td class="signature{{ $key }}">
                        @if ($key === 0)
                            <img src="{{ public_path('storage/' . $firma->archivo) }}" width="175"
                                style="position: absolute; top: 520px; left:50px"><br>
                        @elseif($key === 1)
                            <img src="{{ public_path('storage/' . $firma->archivo) }}" width="175"
                                style="position: absolute; top: 520px; left:380px"><br>
                        @else
                            <img src="{{ public_path('storage/' . $firma->archivo) }}" width="175"
                                style="position: absolute; top: 520px; left:780px"><br>
                        @endif
                        <span style="font-size: 16px;">{{ $firma->usuario->person->nombre }}
                            {{ $firma->usuario->person->apellidos }}</span>
                        @if ($key === 0)
                            <span style="font-size: 16px;">COMANDANTE DE LA EIE</span>
                            <p style="font-size: 10px; margin: 0; font-weight: normal;">
                                {{ $firmas[0]->hash }}</p>
                        @elseif ($key === 1)
                            <span style="font-size: 16px;">COMANDANTE GENERAL ACC. DEL EJÉRCITO</span>
                            <p style="font-size: 10px; margin: 0; font-weight: normal;">
                                {{ $firmas[1]->hash }}</p>
                        @else
                            <span style="font-size: 16px;">JEFE DEL DEPARTAMENTO VI - EDUCACIÓN</span>
                            <p style="font-size: 10px; margin: 0; font-weight: normal;">
                                {{ $firmas[2]->hash }}</p>
                        @endif

                        {{-- <p style="font-size: 10px; margin: 0; font-weight: normal;">
                            {{ md5($query1[1]->nombre . $query1[1]->apellidos . $query1[1]->clave) }}</p> --}}
                    </td>
                @endforeach
                <p style=" position: absolute; top: 650px; left:50px; font-size: 10px; margin: 0; font-weight: normal;">fecha de emisión: {{ substr($query->fecha_emision, 0, 10) }}</p>
            </table>
        </div>
    </div>
</body>

</html>
