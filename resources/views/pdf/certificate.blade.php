<!DOCTYPE html>
<html>
<head>
    <title>Reporte de solicitudes de certificados PDF</title>
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
    <h1>Listado de Solicitud de certificados</h1>

    <table>
        <thead>
            <tr>
                <th scope="col" style="color:black">N°</th>
                <th scope="col" style="color:black">Nombre</th>
                <th scope="col" style="color:black">Apellidos</th>
                <th scope="col" style="color:black">Telefono</th>
                <th scope="col" style="color:black">Carnet de identidad</th>
                <th scope="col" style="color:black">Curso</th>
                <th scope="col" style="color:black">Fecha de inicio</th>
            </tr>
        </thead>
        <tbody>
            <!-- Verificar si hay datos en $solicitudes antes de iterar -->
            @if(count($solicitudes) > 0)
                @foreach($solicitudes as $index => $solicitude)
                <tr>
                    <td>{{ ++$index }}</td>
                    <td>{{ $solicitude->user->person->nombre }}</td>
                    <td>{{ $solicitude->user->person->apellidos }}</td>
                    <td>{{ $solicitude->user->person->telefono }}</td>
                    <td>{{ $solicitude->user->email }}</td>
                    <td>{{ $solicitude->course->nombre_curso }}</td>
                    <td>{{ $solicitude->created_at }}</td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6">No hay solicitudes disponibles.</td>
                </tr>
            @endif
        </tbody>
    </table>
</body>
</html>
