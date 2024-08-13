<!DOCTYPE html>
<html>
<head>
    <title>Reporte de solicitudes de inscripciones PDF</title>
    <style>
        /* Estilos para la tabla */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Listado de Solicitud de inscripciones </h1>

    <table>
        <thead>
                                <tr>

                                    <th scope="col" style="color:black">N°</th>
                                    <th scope="col" style="color:black">Nombre</th>
                                    <th scope="col" style="color:black">Apellidos</th>
                                    <th scope="col" style="color:black">Telefono</th>
                                    <th scope="col" style="color:black">Carnet de identidad</th>
                                    <th scope="col" style="color:black">Curso</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($inscriptions as $index => $inscription)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>{{ $inscription->user->person->nombre }}</td>
                                    <td>{{ $inscription->user->person->apellidos }}</td>
                                    <td>{{ $inscription->user->person->telefono }}</td>
                                    <td>{{ $inscription->user->person->email }}</td>
                                    <td>{{ $inscription->course->nombre_curso }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
</body>
</html>
