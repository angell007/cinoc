<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Hoja de vida - {{ $user->getName() }}</title>
    <style>
        @page {
            margin: 18px 18px 22px 18px;
        }
        html, body {
            margin: 0;
            padding: 0;
        }
        img {
            border: 0;
            display: block;
        }
    </style>
</head>
<body>
    @include('user.partials.cv_body_pdf')
</body>
</html>
