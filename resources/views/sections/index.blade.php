@extends('layouts.app')

@section('content')
<body>

    <div class="container">
        <div class="row justify-content-start">

            <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
                <div class="row pt-2">
                    <div class="col ps-4">
                        <h1 class="display-6 mb-3">
                            <i class="bi bi-person-lines-fill"></i> Formulario de pre-inscripciones
                        </h1>
                        @include('session-messages')
                        <div class="mb-4">
                            <form class="row g-3" action="{{ route('storeinscription') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-3">
                                    <label for="inputFirstName" class="form-label">Nombre(s)<sup><i
                                                class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="text" class="form-control" id="inputFirstName" name="nombre"
                                        placeholder="Ingrese su nombre(s)" value="{{old('nombre')}}">
                                </div>
                                <div class="col-md-3">
                                    <label for="inputLastName" class="form-label">Apellido(s)<sup><i
                                                class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="text" class="form-control" id="inputLastName" name="apellidos"
                                        placeholder="Ingrese su apellido(s)" value="{{old('apellidos')}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputEmail" class="form-label">Correo Electrónico<sup><i
                                                class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="email" class="form-control" id="inputEmail" name="email"
                                        placeholder="Ingrese su correo electrónico" value="{{old('email')}}">
                                </div>
                                <div class="col-md-12">
                                    <label for="inputAddress" class="form-label">Dirección<sup><i
                                                class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="text" class="form-control" id="inputAddress" name="direccion"
                                        placeholder="Ingrese su dirección" value="{{old('direccion')}}">
                                </div>

                                <div class="col-md-4">
                                    <label for="inputCity" class="form-label">Ciudad<sup><i
                                                class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="text" class="form-control" id="inputCity" name="ciudad"
                                        placeholder="Ingrese el nombre de su ciudad" value="{{old('ciudad')}}">
                                </div>
                                <div class="col-md-4">
                                    <label for="inputZip" class="form-label">Estado Civil<sup><i
                                                class="bi bi-asterisk text-primary"></i></sup></label>
                                    <select class="form-control" name="estado_civil" id="estado_civil">
                                        <option value="soltero">Soltero(a)</option>
                                        <option value="casado">Casado(a)</option>
                                        <option value="divorsiado">Divorciado(a)</option>
                                        <option value="viudo">Viudo(a)</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="inputPhone" class="form-label">Teléfono<sup><i
                                                class="bi bi-asterisk text-primary"></i></sup></label>
                                    <input type="text" class="form-control" id="inputPhone" name="telefono"
                                    placeholder="Ingrese su número de teléfono" value="{{old('telefono')}}">
                                </div>

                                <div class="col-md-4">
                                    <label for="level_english" class="form-label">Curso<sup><i
                                                class="bi bi-asterisk text-primary"></i></sup></label>
                                    <select id="level_english" class="form-control" name="curso_id" required>
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->nombre_curso }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="apellido">Cédula de identidad</label>
                                    <input type="text" class="form-control" id="ci" name="ci"
                                        required value="{{old('ci')}}" placeholder="Ingrese su cedula de identidad">
                                </div>
                                <div class="col-md-4" style="padding-bottom: 50px;">
                                    <label for="email">Fecha de nacimiento</label>
                                    <input type="date" class="form-control" id="fecha_nacimiento"
                                        name="fecha_nacimiento" required value="{{old('fecha_nacimiento')}}">
                                </div>
                                <div class="col-md-4" style="padding-bottom: 50px;">
                                    <div class="captcha">
                                        <label>Código captcha</label>
                                        <br>
                                        <span>{!! captcha_img('math') !!}</span>
                                        <button type="button" class="btn btn-danger reload" id="reload">
                                            &#x21bb;
                                        </button>
                                    </div>
                                    <br>
                                    <div class="form-group mb-2">
                                        <input type="text" class="form-control"
                                            placeholder="Ingrese su código captcha" name="captcha">
                                        @error('captcha')
                                            <label for="" class="text-danger">Por favor, rellene el captcha de
                                                forma correcta</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-sm btn-primary"><i
                                            class="bi bi-person-plus"></i> Enviar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
        $('#reload').click(function() {
            $.ajax({
                type: 'GET',
                url: 'reload-captcha',
                success: function(data) {
                    $(".captcha span").html(data.captcha)
                }
            });
        });
    </script>
</body>

</html>
@stop
