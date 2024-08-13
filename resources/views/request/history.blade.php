@extends('layouts.app')

@section('content')
    <style>

    </style>
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    <div class="container">
        <div class="row justify-content-start">
            @include('layouts.left-menu')
            <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
                <div class="row pt-2">
                    <div class="col ps-4">
                        <div class="mb-6">
                            <div class="row">
                                <div class="col-sm-8 col-md-12">
                                    <div class="p-3 mb-3 border rounded bg-white">
                                        <h1 class="display-6 mb-3">
                                            <i class="bi bi-clock-history"></i> Historial de cambios
                                        </h1>
                                        <table class="table table-responsive mt-4">
                                            <tbody>
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Descripción</th>
                                                        <th scope="col">Fecha y hora</th>
                                                    </tr>
                                                </thead>
                                                @foreach ($query as $i)
                                                    <tr class="table-info">
                                                        <th scope="row">{{ $loop->iteration }}</th>
                                                        <td>{{ $i->descripcion }}</td>
                                                        <td>{{ $i->created_at }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <button id="showModalBtn">Checklist</button>
                <script>
                    const showModalBtn = document.getElementById('showModalBtn');

                    showModalBtn.addEventListener('click', () => {
                        Swal.fire({
                            title: 'Checklist',
                            html: `
                            <form method="POST" action="{{ route('checklist') }}" style="text-align: left;">
                                @csrf
                                <input type="checkbox" name="item1" value="Item 1" style="margin-left: 80px;"> Certificado de nacimiento<br>
                                <input type="checkbox" name="item2" value="Item 2" style="margin-left: 80px;"> Carnet de identidad<br>
                                <input type="checkbox" name="item3" value="Item 3" style="margin-left: 80px;"> Comprobante<br>
                                <input type="checkbox" name="item4" value="Item 4" style="margin-left: 80px;"> Datos personales<br>
                                <br>
                                <button type="submit" class="btn btn-primary" style="display: block; margin: 0 auto;">Enviar</a>
                            </form>
                            `,
                            showConfirmButton: false, // Oculta el botón de confirmación
                            showCancelButton: true, // Muestra solo el botón de cancelar
                            showCancelButton: false, // Muestra solo el botón de cancelar
                            cancelButtonText: 'Cerrar',
                            preConfirm: () => {
                                const form = document.getElementById('checklistForm');
                                const formData = new FormData(form);
                                const checkedItems = Array.from(formData.values());
                                console.log('Elementos seleccionados:', checkedItems);
                            }
                        });
                    });
                </script> --}}
                @include('layouts.footer')
            </div>
        </div>
    </div>
@endsection
