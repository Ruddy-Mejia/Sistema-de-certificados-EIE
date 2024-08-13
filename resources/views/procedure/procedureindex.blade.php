@extends('layouts.app')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <div class="container">
        <div class="row justify-content-center">
            @include('layouts.left-menu')
            <div class="col-md-8">
                <div class="card">
                    {{-- <div class="card-header">{{ __('Estado del Trámite') }}</div> --}}

                    <div class="card-body">

                        <div class="form-group">
                            <select id="inputState" class="form-control" onchange="actualizarDiagrama()">
                                @foreach ($solicitudes as $solicitud)
                                    <option value="{{ $solicitud->estado }}"
                                        data-otra-variable="{{ $solicitud->diasTranscurridos }} "
                                        data-solicitud="{{ $solicitud }}">
                                        {{ $solicitud->user->person->nombre }} {{ $solicitud->user->person->apellidos }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <center><label for="inputState" style="text-align:center;">Estado del Trámite</label></center>
                            <div id="diagrama-flujo"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        #diagrama-flujo {
            width: 80%;
            height: 400px;
            background-color: white;
            margin: 20px auto;
            padding: 20px;
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/vis/4.21.0/vis.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vis/4.21.0/vis.min.js"></script>

    <script>
        var nodes = new vis.DataSet([]);
        var edges = new vis.DataSet([]);

        var container = document.getElementById('diagrama-flujo');
        var data = {
            nodes: nodes,
            edges: edges
        };

        var options = {
            nodes: {
                shape: 'box',
                widthConstraint: {
                    maximum: 220
                },
                heightConstraint: {
                    minimum: 100
                }
            },
            edges: {
                smooth: {
                    type: 'cubicBezier',
                    forceDirection: 'horizontal',
                    roundness: 0.4
                },
                arrows: {
                    to: {
                        enabled: true,
                        scaleFactor: 0.5
                    },
                    width: 2,
                    font: {
                        size: 14
                    }
                }
            },
            physics: {
                enabled: false
            }
        };

        var network = new vis.Network(container, data, options);

        function actualizarDiagrama() {
            var selectState = document.getElementById('inputState');
            var estadoTramite = selectState.value;
            var diastranscurridos = selectState.options[selectState.selectedIndex].getAttribute('data-otra-variable');
            var solicitud = selectState.options[selectState.selectedIndex].getAttribute('data-solicitud');
            var sol = JSON.parse(solicitud);
            nodes.clear();
            edges.clear();

            switch (estadoTramite) {
                case 'solicitud':

                    nodes.add({
                        id: 'solicitud',
                        label: 'Solicitud\n' + diastranscurridos +
                            'días de duración a partir del inicio del trámite',
                        shape: 'box',
                        color: '#007BFF',
                        width: 100,
                        height: 150,
                        x: 0,
                        y: 0,
                        font: {
                            size: 28
                        }
                    });
                    nodes.add({
                        id: 'secretaria',
                        label: 'Secretaría\nProceso pendiente ',
                        shape: 'box',
                        color: '#FFC107',
                        width: 100,
                        height: 150,
                        x: 200,
                        y: 0,
                        font: {
                            size: 28
                        }
                    });
                    nodes.add({
                        id: 'direccion',
                        label: 'Dirección\nProceso pendiente ',
                        shape: 'box',
                        color: '#28A745',
                        width: 100,
                        height: 150,
                        x: 400,
                        y: 0,
                        font: {
                            size: 28
                        }
                    });
                    nodes.add({
                        id: 'finalizado',
                        label: 'Finalizado\nProceso pendiente  ',
                        shape: 'box',
                        color: '#6C757D',
                        width: 100,
                        height: 150,
                        x: 600,
                        y: 0,
                        font: {
                            size: 28
                        }
                    });
                    edges.add({
                        from: 'solicitud',
                        to: 'secretaria'
                    });
                    edges.add({
                        from: 'secretaria',
                        to: 'direccion'
                    });
                    edges.add({
                        from: 'direccion',
                        to: 'finalizado'
                    });
                    break;
                case 'secretaria':
                    nodes.add({
                        id: 'solicitud',
                        label: 'Solicitud\nProceso completado',
                        shape: 'box',
                        color: '#007BFF',
                        width: 100,
                        height: 150,
                        x: 0,
                        y: 0,
                        font: {
                            size: 28
                        }
                    });
                    nodes.add({
                        id: 'secretaria',
                        label: 'Secretaría\n' + diastranscurridos +
                            ' días de duración\n a partir de la aprobación de solicitud',
                        shape: 'box',
                        color: '#FFC107',
                        width: 100,
                        height: 150,
                        x: 200,
                        y: 0,
                        font: {
                            size: 28
                        }
                    });
                    nodes.add({
                        id: 'direccion',
                        label: 'Dirección\nProceso pendiente ',
                        shape: 'box',
                        color: '#28A745',
                        width: 100,
                        height: 150,
                        x: 400,
                        y: 0,
                        font: {
                            size: 28
                        }
                    });
                    nodes.add({
                        id: 'finalizado',
                        label: 'Finalizado\nProceso pendiente ',
                        shape: 'box',
                        color: '#6C757D',
                        width: 100,
                        height: 150,
                        x: 600,
                        y: 0,
                        font: {
                            size: 28
                        }
                    });
                    edges.add({
                        from: 'solicitud',
                        to: 'secretaria'
                    });
                    edges.add({
                        from: 'secretaria',
                        to: 'direccion'
                    });
                    edges.add({
                        from: 'direccion',
                        to: 'finalizado'
                    });
                    break;
                case 'observado':
                    nodes.add({
                        id: 'solicitud',
                        label: 'Solicitud\nProceso completado',
                        shape: 'box',
                        color: '#007BFF',
                        width: 100,
                        height: 150,
                        x: 0,
                        y: 0,
                        font: {
                            size: 28
                        }
                    });
                    nodes.add({
                        id: 'secretaria',
                        label: 'Observado por secretaría',
                        shape: 'box',
                        color: '#FFC107',
                        width: 100,
                        height: 150,
                        x: 200,
                        y: 0,
                        font: {
                            size: 28
                        }
                    });
                    nodes.add({
                        id: 'observado',
                        label: 'Datos observados',
                        shape: 'box',
                        color: '#ff0000',
                        width: 100,
                        height: 150,
                        x: 200,
                        y: -100,
                        font: {
                            size: 28
                        }
                    });
                    nodes.add({
                        id: 'direccion',
                        label: 'Dirección\nProceso pendiente ',
                        shape: 'box',
                        color: '#28A745',
                        width: 100,
                        height: 150,
                        x: 400,
                        y: 0,
                        font: {
                            size: 28
                        }
                    });
                    nodes.add({
                        id: 'finalizado',
                        label: 'Finalizado\nProceso pendiente ',
                        shape: 'box',
                        color: '#6C757D',
                        width: 100,
                        height: 150,
                        x: 600,
                        y: 0,
                        font: {
                            size: 28
                        }
                    });
                    edges.add({
                        from: 'solicitud',
                        to: 'secretaria'
                    });
                    edges.add({
                        from: 'secretaria',
                        to: 'direccion'
                    });
                    edges.add({
                        from: 'direccion',
                        to: 'finalizado'
                    });
                    edges.add({
                        from: 'secretaria',
                        to: 'observado'
                    });
                    break;
                case 'direccion':
                    nodes.add({
                        id: 'solicitud',
                        label: 'Solicitud\nProceso completado ',
                        shape: 'box',
                        color: '#007BFF',
                        width: 100,
                        height: 150,
                        x: 0,
                        y: 0,
                        font: {
                            size: 28
                        }
                    });
                    nodes.add({
                        id: 'secretaria',
                        label: 'Secretaría\nProceso completado',
                        shape: 'box',
                        color: '#FFC107',
                        width: 100,
                        height: 150,
                        x: 200,
                        y: 0,
                        font: {
                            size: 28
                        }
                    });
                    nodes.add({
                        id: 'direccion',
                        label: 'Dirección\n' + diastranscurridos +
                            ' días de duración \na partir de la aprobación de secretaria',
                        shape: 'box',
                        color: '#28A745',
                        width: 100,
                        height: 150,
                        x: 400,
                        y: 0,
                        font: {
                            size: 28
                        }
                    });
                    nodes.add({
                        id: 'finalizado',
                        label: 'Finalizado\nProceso pendiente ',
                        shape: 'box',
                        color: '#6C757D',
                        width: 100,
                        height: 150,
                        x: 600,
                        y: 0,
                        font: {
                            size: 28
                        }
                    });
                    edges.add({
                        from: 'solicitud',
                        to: 'secretaria'
                    });
                    edges.add({
                        from: 'secretaria',
                        to: 'direccion'
                    });
                    edges.add({
                        from: 'direccion',
                        to: 'finalizado'
                    });
                    break;
                case 'finalizado':
                    nodes.add({
                        id: 'solicitud',
                        label: 'Solicitud\nProceso completado',
                        shape: 'box',
                        color: '#007BFF',
                        width: 100,
                        height: 150,
                        x: 0,
                        y: 0,
                        font: {
                            size: 28
                        }
                    });
                    nodes.add({
                        id: 'secretaria',
                        label: 'Secretaría\nProceso completado',
                        shape: 'box',
                        color: '#FFC107',
                        width: 100,
                        height: 150,
                        x: 200,
                        y: 0,
                        font: {
                            size: 28
                        }
                    });
                    nodes.add({
                        id: 'direccion',
                        label: 'Dirección\nProceso completado',
                        shape: 'box',
                        color: '#28A745',
                        width: 100,
                        height: 150,
                        x: 400,
                        y: 0,
                        font: {
                            size: 28
                        }
                    });
                    nodes.add({
                        id: 'finalizado',
                        label: 'Finalizado\n Inicio del trámite: hace ' + diastranscurridos + ' días',
                        shape: 'box',
                        color: '#6C757D',
                        width: 100,
                        height: 150,
                        x: 600,
                        y: 0,
                        font: {
                            size: 28
                        }
                    });
                    edges.add({
                        from: 'solicitud',
                        to: 'secretaria'
                    });
                    edges.add({
                        from: 'secretaria',
                        to: 'direccion'
                    });
                    edges.add({
                        from: 'direccion',
                        to: 'finalizado'
                    });
                    break;
                case 'observado por direccion':
                    nodes.add({
                        id: 'solicitud',
                        label: 'Solicitud\nProceso completado',
                        shape: 'box',
                        color: '#007BFF',
                        width: 100,
                        height: 150,
                        x: 0,
                        y: 0,
                        font: {
                            size: 28
                        }
                    });
                    nodes.add({
                        id: 'secretaria',
                        label: 'Observado por secretaría',
                        shape: 'box',
                        color: '#FFC107',
                        width: 100,
                        height: 150,
                        x: 200,
                        y: 0,
                        font: {
                            size: 28
                        }
                    });
                    nodes.add({
                        id: 'observado',
                        label: 'Datos observados por dirección',
                        shape: 'box',
                        color: '#ff0000',
                        width: 100,
                        height: 150,
                        x: 400,
                        y: -150,
                        font: {
                            size: 28
                        }
                    });
                    nodes.add({
                        id: 'direccion',
                        label: 'Dirección\nProceso pendiente ',
                        shape: 'box',
                        color: '#28A745',
                        width: 100,
                        height: 150,
                        x: 400,
                        y: 0,
                        font: {
                            size: 28
                        }
                    });
                    nodes.add({
                        id: 'finalizado',
                        label: 'Finalizado\nProceso pendiente ',
                        shape: 'box',
                        color: '#6C757D',
                        width: 100,
                        height: 150,
                        x: 600,
                        y: 0,
                        font: {
                            size: 28
                        }
                    });
                    edges.add({
                        from: 'solicitud',
                        to: 'secretaria'
                    });
                    edges.add({
                        from: 'secretaria',
                        to: 'direccion'
                    });
                    edges.add({
                        from: 'direccion',
                        to: 'finalizado'
                    });
                    edges.add({
                        from: 'direccion',
                        to: 'observado'
                    });
                    break;
            }
            var valores = sol.checklist.split(','); // Dividimos la cadena en un array de valores
            var etiquetas = ['Certificado de nacimiento', 'Carnet de identidad', 'Comprobante', 'Datos personales']; // Etiquetas para los checkboxes

            // Crear el HTML para los checkboxes
            var checkboxesHtml = '<div style="text-align: left;">';
            for (var i = 0; i < valores.length; i++) {
                var isChecked = valores[i] === '1' ? 'checked' : '';
                var etiqueta = etiquetas[i];
                checkboxesHtml += `<input type="checkbox" ${isChecked} style="margin-left: 80px;" disabled> ${etiqueta}<br>`;
            }
            checkboxesHtml += `</div>`;

            network.on('click', function(properties) {
                var nodeId = properties.nodes[0];
                if (nodeId === 'solicitud') {
                    Swal.fire({
                        title: 'Checklist',
                        html: checkboxesHtml,
                        showConfirmButton: true,
                        showCancelButton: false,
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor: '#0d6efd',
                        focusConfirm: false
                    });
                }
            });
            network.fit();
        }

        actualizarDiagrama();
    </script>
@endsection
