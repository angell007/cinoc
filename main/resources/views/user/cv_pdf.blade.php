<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Hoja de vida - {{ $user->getName() }}</title>
    <style>
        @page {
            margin: 16px 16px 0 16px;
        }
        html, body {
            margin: 0;
            padding: 0;
        }
        img {
            border: 0;
            display: block;
        }
        .cv-page-footer {
            position: fixed;
            left: 0;
            right: 0;
            bottom: 0;
            height: 22px;
            background: #f5a623;
        }
    </style>
</head>
<body>
    @include('user.partials.cv_body_pdf')
    <div class="cv-page-footer">&nbsp;</div>
</body>
</html>
