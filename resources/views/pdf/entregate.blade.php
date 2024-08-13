<!DOCTYPE html>
<html>
<head>
    <title>Reporte de certificados entregados PDF</title>
    <style>
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
    <h1>Listado de certificados Entregados </h1>

    <table>
    <thead>
                                <tr>

                                    <th scope="col" style="color:black">N°</th>
                                    <th scope="col" style="color:black">Nombre</th>
                                    <th scope="col" style="color:black">Apellidos</th>
                                    <th scope="col" style="color:black">Teléfono</th>
                                    <th scope="col" style="color:black">Carnet de identidad</th>
                                    <th scope="col" style="color:black">Curso</th>
                                    <th scope="col" style="color:black">Fecha de inicio</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($solicitud as $index => $solici)
                                <tr>
                                    <td>{{ ++$index }}</td>
                                    <td>{{ $solici->user->person->nombre }}</td>
                                    <td>{{ $solici->user->person->apellidos }}</td>
                                    <td>{{ $solici->user->person->telefono }}</td>
                                    <td>{{ $solici->user->email }}</td>
                                    <td>{{ $solici->course->nombre_curso }}</td>
                                    <td>{{ $solici->created_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
</body>
</html>
