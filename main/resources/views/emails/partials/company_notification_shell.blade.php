@php
    $logoUrl = url('images/logo.jpeg');
@endphp
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
    <link href='https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700' rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Quicksand:300,400,700' rel="stylesheet">
    <style type="text/css">
        body { width: 100%; background-color: #f4f7fb; margin: 0; padding: 0; -webkit-font-smoothing: antialiased; }
        p, h1, h2, h3, h4 { margin-top: 0; margin-bottom: 0; padding-top: 0; padding-bottom: 0; }
        html { width: 100%; }
        table { font-size: 14px; border: 0; }
    </style>
</head>
<body class="respond" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
    <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="f4f7fb">
        <tr>
            <td align="center">
                <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590" style="background:#ffffff; border:1px solid #e5e9f0;">
                    <tr>
                        <td bgcolor="ffb72f" height="8" style="font-size: 8px; line-height: 8px; background-color:#ffb72f;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="center" style="padding: 28px 20px 10px 20px;">
                            <img width="140" border="0" style="display: block; width: 140px;" src="{{ $logoUrl }}" alt="UNIOC" />
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="color: #0b3a6e; font-size: 24px; font-family: Quicksand, Calibri, sans-serif; font-weight:700; letter-spacing: 2px; line-height: 35px; padding: 10px 20px 0 20px;">
                            <div style="line-height: 40px">{{ $title }}</div>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding: 12px 0 8px 0;">
                            <table border="0" width="60" align="center" cellpadding="0" cellspacing="0" bgcolor="ffb72f">
                                <tr>
                                    <td height="3" style="font-size: 3px; line-height: 3px; background-color:#ffb72f;">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="left" style="color: #555555; font-size: 16px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px; padding: 16px 28px 8px 28px;">
                                        @include($bodyView, [
                                            'user' => $user ?? null,
                                            'isCompany' => $isCompany ?? false,
                                            'activationUrl' => $activationUrl ?? null,
                                            'name' => $name ?? null,
                                            'email' => $email ?? null,
                                            'link' => $link ?? null,
                                            'link_admin' => $link_admin ?? null,
                                        ])
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding: 8px 28px 24px 28px; color:#0b3a6e; font-family: 'Work Sans', Calibri, sans-serif; font-size: 14px; font-weight: 600;">
                            Bolsa de Empleo UNIOC
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="0b3a6e" align="center" style="background-color:#0b3a6e; padding: 16px 20px;">
                            <p style="margin:0 0 12px 0; color:#ffffff; font-size:12px; font-family: 'Work Sans', Calibri, sans-serif;">
                                Síguenos en nuestras redes
                            </p>
                            <div style="line-height: 0;">
                                @include('admin.layouts.email_template_social')
                            </div>
                            <p style="margin:14px 0 0 0; color:#cdd9e8; font-size:11px; font-family: 'Work Sans', Calibri, sans-serif;">
                                © {{ date('Y') }} UNIOC — Bolsa de Empleo
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr><td height="30" style="font-size: 30px; line-height: 30px;">&nbsp;</td></tr>
    </table>
</body>
