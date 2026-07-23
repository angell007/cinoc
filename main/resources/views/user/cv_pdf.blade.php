<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Hoja de vida - {{ $user->getName() }}</title>
    @include('user.partials.cv_styles')
</head>
<body>
    @include('user.partials.cv_body')
</body>
</html>
