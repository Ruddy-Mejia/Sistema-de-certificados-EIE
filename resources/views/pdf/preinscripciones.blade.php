<!DOCTYPE html>
<html>
<head>
    <title>Reporte de preincripciones PDF</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 10px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 5px 5px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1 style="font-size: 15px;">Listado de preincripciones </h1>

    <table>
    <thead>
                                <tr>

                                    <th scope="col" style="color:black">N°</th>
                                    <th scope="col" style="color:black">Nombre</th>
                                    <th scope="col" style="color:black">Apellidos</th>
                                    <th scope="col" style="color:black">Dirección</th>
                                    <th scope="col" style="color:black">Estado civil</th>
                                    <th scope="col" style="color:black">Curso</th>
                                    <th scope="col" style="color:black">Carnet de identidad</th>
                                    <th scope="col" style="color:black">Ciudad</th>
                                    <th scope="col" style="color:black">Teléfono</th>
                                    <th scope="col" style="color:black">Fecha de nacimiento</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($solicitud as $index => $solici)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>{{ $solici->nombre }}</td>
                                    <td>{{ $solici->apellidos }}</td>
                                    <td>{{ $solici->direccion }}</td>
                                    <td>{{ $solici->estado_civil }}</td>
                                    <td>{{ $solici->curso->nombre_curso }}</td>
                                    <td>{{ $solici->ci }}</td>
                                    <td>{{ $solici->ciudad }}</td>
                                    <td>{{ $solici->telefono }}</td>
                                    <td>{{ $solici->fecha_nacimiento }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
</body>
</html>
