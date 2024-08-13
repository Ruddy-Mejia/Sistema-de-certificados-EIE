<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escuela de Idiomas del Ejército</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0-beta3/css/all.min.css" integrity="sha384-Gi2F3cOz2bO0wY6pt0+KFEVK3U+J7WGLdrGTlWCa8zdh0JwXb/hAaKzibpCtcG9C" crossorigin="anonymous">



    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Nunito';
        }

        .carousel-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .carousel {
            max-width: 400px;
            overflow: hidden;
        }

        .carousel img {
            width: 400px;
            height: 400px;
        }

        /* Estilo del logo */
        .logo {
            width: 100px;
            height: auto;
        }

        /* Estilo del footer */
        footer {
            background-color: #003770;
            color: #fff;
            text-align: center;
            padding: 20px;
            /* font-family: 'Noto Sans Shavian', sans-serif; */
            font-family: 'Nunito';
        }

        .contact-info {
            font-size: 16px;
        }

        hr {
            border-color: #003770;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-dark" style="background-color: #003770;">
        <a class="navbar-brand"><img src="https://i.postimg.cc/MZMNCzJ1/logo.png" alt="logo" width="130px">   Escuela de Idiomas del Ejército</a>
        <form class="form-inline">
            <a class="nav-link" href="{{ route('login') }}">Inicio de sesión</a>
            <a class="nav-link" href="{{ route('viewinscription') }}">Preinscripciones</a>
        </form>
    </nav>

    <div class="container-fluid">
        <div class="row justify-content-center align-items-center;" style="padding: 80px 50px 80px 150px;">
            <div class="col-md-6 text-center">
                <h1 style="text-align: left; font-size: 50px;">La Escuela de Idiomas del Ejército, tu mejor opción</h1>
                <p style="text-align: left;">En nuestra institución siempre existió la necesidad de aprender idiomas
                    nativos y extranjeros que permitieran al personal de cuadros conocer más sobre las costumbres e
                    idiomas.</p>
            </div>
            <div class="col-md-6 text-center">
                <div style="overflow: hidden; width: 500px; height: 500px; margin: 0 auto;">
                    <img src="{{ asset('imgs/carrusel1.jpg') }}" alt="Imagen" style="width: 100%; height: auto;border-radius: 5%;">
                    {{-- <img src="{{ asset('imgs/carrusel2.jpg') }}" alt="Imagen" style="width: 100%; height: auto;">
                    <img src="{{ asset('imgs/carrusel3.jpg') }}" alt="Imagen" style="width: 100%; height: auto;"> --}}
                </div>
            </div>
        </div>
    </div>


    <footer style="background-color: #003770; color: #fff; text-align: left; padding: 50px 150px 50px 150px; display: flex; justify-content: space-between; align-items: center;">
        <div class="contact-info">
            <h2>Contactanos</h2>
            <p>Correo: escueladeidiomas@eie.edu.bo</p>
            <p>Teléfono: (+591) 77579623</p>
            <p>Dirección: Cuartel General Estado Mayor, Avenida Saavedra Nro. 2059</p>
        </div>
        <img src="https://i.postimg.cc/MZMNCzJ1/logo.png" alt="Logo " style="width: 100px; height: auto;">
    </footer>

</body>

</html>
