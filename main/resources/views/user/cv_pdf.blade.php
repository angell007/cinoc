<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Hoja de vida - {{ $user->getName() }}</title>
</head>
<body>
    @include('user.partials.cv_body_pdf')
</body>
</html>
