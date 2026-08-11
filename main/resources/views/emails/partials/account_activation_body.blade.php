@php
    $isCompany = (bool) ($isCompany ?? false);
    $accountLabel = $isCompany ? 'empresa' : 'cuenta';
@endphp
<p style="line-height: 24px; margin-bottom:15px;">¡Cordial saludo!</p>
<p style="line-height: 24px; margin-bottom:15px;">
    Gracias por registrarte en la <strong>Bolsa de Empleo UNIOC</strong>.
    Para activar tu {{ $accountLabel }}, haz clic en el siguiente botón:
</p>
<table border="0" align="center" width="220" cellpadding="0" cellspacing="0" bgcolor="0b3a6e" style="margin: 20px auto;">
    <tr>
        <td height="12" style="font-size: 12px; line-height: 12px;">&nbsp;</td>
    </tr>
    <tr>
        <td align="center" style="color: #ffffff; font-size: 14px; font-family: 'Work Sans', Calibri, sans-serif; letter-spacing: 1px;">
            <a href="{{ $activationUrl }}" style="color: #ffffff; text-decoration: none; display: inline-block; padding: 0 18px;">
                Activar mi cuenta
            </a>
        </td>
    </tr>
    <tr>
        <td height="12" style="font-size: 12px; line-height: 12px;">&nbsp;</td>
    </tr>
</table>
<p style="line-height: 24px; margin-bottom:15px;">
    Una vez activada, podrás ingresar con tu correo electrónico
    (<strong>{{ $user->email }}</strong>) y la contraseña que registraste.
</p>
<p style="line-height: 22px; margin-bottom:15px; font-size: 13px; color: #777777;">
    Si el botón no funciona, copia y pega esta URL en tu navegador:<br>
    <a href="{{ $activationUrl }}" style="color: #0b3a6e; word-break: break-all;">{{ $activationUrl }}</a>
</p>
<p style="line-height: 24px; margin-bottom:15px;">
    Agradecemos tu interés en hacer parte de la Bolsa de Empleo de la UNIOC.
</p>
