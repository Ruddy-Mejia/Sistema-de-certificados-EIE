<!DOCTYPE html>
<html>
<head>
    <title>Reporte de estudiantes PDF</title>
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
    <h1>Listado de estudiantes </h1>

    <table>
                            <thead>
                                <tr>

                                    <th style="color:black">N°</th>
                                    <th style="color:black">Nombre</th>
                                    <th style="color:black">Apellidos</th>
                                    <th style="color:black">Telefono</th>
                                    <th style="color:black">Email</th>
                                    <th style="color:black">Curso</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($inscritos as $index => $inscrito)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>{{ $inscrito->user->person->nombre }}</td>
                                    <td>{{ $inscrito->user->person->apellidos }}</td>
                                    <td>{{ $inscrito->user->person->telefono }}</td>
                                    <td>{{ $inscrito->user->person->email }}</td>
                                    <td>{{ $inscrito->course->nombre_curso }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
</body>
</html>
