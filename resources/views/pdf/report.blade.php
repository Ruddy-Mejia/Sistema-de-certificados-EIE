<!DOCTYPE html>
<html>
<head>
    <title>Reporte PDF</title>
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
    <h1>Reporte General</h1>

    <table>
        <thead>
            <tr>
                <!-- <th  style="color:black">Total inscritos</th>
                <th  style="color:black">Total en espera</th> -->
                <th  style="color:black">Solicitudes de Certificado</th>
                <th  style="color:black">Certificados Entregados</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <!-- <td>{{ $totalinscrito }}</td>
                <td>{{ $numInscriptions }}</td> -->
                <td>{{ $numSolicitudes }}</td>
                <td>{{ $totalsolicitud }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
