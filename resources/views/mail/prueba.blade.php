<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mail-sender</title>
</head>
<body>
    <form action="enviar-correo" method="POST">
        @csrf
        <label>Destinatario</label>
        <input type="email" name="destinatario" required>
        <textarea name="mensaje" cols="30" rows="10">Mensaje</textarea>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>
