<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
    <link href='https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700' rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Quicksand:300,400,700' rel="stylesheet">
    <style type="text/css">
        body { width: 100%; background-color: #ffffff; margin: 0; padding: 0; -webkit-font-smoothing: antialiased; }
        p, h1, h2, h3, h4 { margin-top: 0; margin-bottom: 0; padding-top: 0; padding-bottom: 0; }
        html { width: 100%; }
        table { font-size: 14px; border: 0; }
    </style>
</head>
<body class="respond" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
    <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff">
        <tr>
            <td align="center">
                <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
                    <tr><td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td></tr>
                    <tr>
                        <td align="center" height="100" style="height:100px;">
                            <img width="100" border="0" style="display: block; width: 100px;" src="https://bolsaempleo.iescinoc.edu.co/images/bannerescuelatecnologicav2.jpg" alt="UNIOC" />
                        </td>
                    </tr>
                    <tr><td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td></tr>
                </table>
            </td>
        </tr>
    </table>
    <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff">
        <tr>
            <td align="center">
                <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
                    <tr>
                        <td align="center" style="color: #343434; font-size: 24px; font-family: Quicksand, Calibri, sans-serif; font-weight:700; letter-spacing: 3px; line-height: 35px;">
                            <div style="line-height: 50px">{{ $title }}</div>
                        </td>
                    </tr>
                    <tr><td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td></tr>
                    <tr>
                        <td align="left">
                            <table border="0" width="590" align="center" cellpadding="0" cellspacing="0" class="container590">
                                <tr>
                                    <td align="left" style="color: #888888; font-size: 16px; font-family: 'Work Sans', Calibri, sans-serif; line-height: 24px;">
                                        @include($bodyView)
                                        <p style="line-height: 24px; margin-bottom:15px;">{{ $siteSetting->site_name ?? config('app.name') }}</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr><td height="40" style="font-size: 40px; line-height: 40px;">&nbsp;</td></tr>
    </table>
</body>
