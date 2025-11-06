<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="nl">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>E-Stalls Events - Retourverzoek</title>

    <style type="text/css">
        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table {
            border-collapse: collapse !important;
        }

        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        a {
            text-decoration: none;
        }

        @media screen and (max-width: 600px) {
            .container {
                width: 100% !important;
                padding: 12px !important;
            }

            .hero {
                padding: 24px 16px !important;
            }

            .two-col {
                display: block !important;
                width: 100% !important;
                padding: 0 !important;
            }

            .btn {
                width: 100% !important;
                display: block !important;
                text-align: center !important;
            }
        }
    </style>
</head>

<body style="margin:0; padding:0; background-color:#f3f2f0; font-family: Arial, Helvetica, sans-serif;">

    <center style="width:100%; background-color:#f3f2f0; padding:20px 0;">
        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="680" class="container"
            style="width:680px; max-width:680px; background:#ffffff; border-radius:8px; overflow:hidden;">

            <!-- Header / Logo -->
            <tr>
                <td align="center" style="padding:36px 24px 8px;">
                    <a href="{{ config('app.url') }}" target="_blank" style="display:inline-block;">
                        <img src="https://e-stalls.nl/public/images/logo-2.png" alt="E-Stalls" width="96"
                            style="display:block;" />
                    </a>
                </td>
            </tr>

            <!-- Hero -->
            <tr>
                <td align="left" class="hero" style="padding:28px 40px 16px; background:#ffffff;">
                    <h2 style="margin:0 0 8px 0; font-size:18px; color:#3d3d3d; font-weight:700;">Beste {{ $name }},</h2>
                    <p style="margin:0; font-size:15px; color:#4b5563; line-height:1.6;">
                    Een gebruiker met de naam {{ $return->name }} heeft een retourverzoek ingediend. Beheerders willen dat u het verzoek beoordeelt. U kunt het verzoek bekijken via uw dashboard.
                    </p>
                </td>
            </tr>

           
            <!-- CTA Button -->
            <tr>
                <td>
                    <table style="font-family: 'Roboto', sans-serif; padding: 25px 25px 0;" role="presentation"
                        cellpadding="0" cellspacing="0" width="100%" border="0">
                        <tbody>
                            <tr>
                                <td style="
                        background-color: #fff;
                        overflow-wrap: break-word;
                        word-break: break-word;
                        padding: 25px 35px 35px;
                        font-family: 'Roboto', sans-serif;
                        text-align: left;
                      " align="left">
                                    <p style="font-size: 18px; color: #3d3d3d;">
                                        Met vriendelijke groet,
                                    </p>

                                    <p style="

                          padding-bottom: 12px;
                          font-size: 18px;
                        color: #3d3d3d;">
                                        E-Stalls Events
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
    </center>
</body>

</html>
