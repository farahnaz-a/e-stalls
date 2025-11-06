<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="color-scheme" content="light dark" />
    <meta name="supported-color-schemes" content="light dark" />
    <title>E-Stalls Events</title>
    <style type="text/css">
      @import url("https://fonts.googleapis.com/css2?family=Roboto:wght@100,300;400;500;700&display=swap");
      table {
        border-spacing: 0;
      }
      td {
        padding: 0;
      }
      p {
        font-size: 15px;
        margin: 0;
      }
      img {
        border: 0;
        border-width: 0;
      }
      a {
        color: #277fd2;
        text-decoration: none;
      }
    </style>

    <!--[if !mso]><!-->
    <link
      href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700&display=swap"
      rel="stylesheet"
      type="text/css"
    />
    <!--<![endif]-->

    <!--[if (gte mso 9)|(IE)]>
      <style type="text/css">
        table {
          border-collapse: collapse !important;
        }
      </style>
    <![endif]-->
  </head>
  <body
    style="
      margin: 0;
      padding-top: 0;
      padding-right: 0;
      padding-bottom: 0;
      padding-left: 0;
      min-width: 100%;
      background: #f3f2f0;
    "
  >
    <!--[if (gte mso 9)|(IE)]>
      <style type="text/css">
        body {
          background-color: #f6f9fc !important;
        }
        body,
        table,
        td,
        p,
        a {
          font-family: sans-serif, Arial, Helvetica !important;
        }
      </style>
    <![endif]-->

    <center style="width: 100%; table-layout: fixed; padding-bottom: 40px">
      <div style="max-width: 680px">
        <!-- Preheader (remove comment) -->
        <div
          style="
            font-size: 0px;
            color: #fafdfe;
            line-height: 1px;
            mso-line-height-rule: exactly;
            display: none;
            max-width: 0px;
            max-height: 0px;
            opacity: 0;
            overflow: hidden;
            mso-hide: all;
          "
        >
          <!-- Add Preheader Text Here (85-100 characters in length) -->
        </div>
        <!-- End Preheader (remove comment) -->

        <!--[if (gte mso 9)|(IE)]>
				<table width="680" align="center" style="border-spacing:0;color:#3d3d3d;" role="presentation">
				<tr>
				<td style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;">
			<![endif]-->

        <table
          cellpadding="0"
          cellspacing="0"
          role="presentation"
          align="center"
          style="
            border-spacing: 0;
            color: #3d3d3d;
            font-family: 'Roboto', sans-serif, Arial, Helvetica;
            background-color: #ffffff;
            margin: 0;
            padding-top: 0;
            padding-right: 0;
            padding-bottom: 0;
            padding-left: 0;
            width: 100%;
            max-width: 680px;
          "
          background="#ffffff"
          role="presentation"
        >
          <!-- START LOGO -->
          <tr>
            <td
              style="
                padding-top: 0;
                padding-right: 0;
                padding-bottom: 0;
                padding-left: 0;
              "
            >
              <table
                width="100%"
                style="border-spacing: 0"
                cellpadding="0"
                cellspacing="0"
                role="presentation"
              >
                <tr>
                  <td
                    style="
                      padding-top: 60px;
                      padding-bottom: 37px;
                      width: 100%;
                      width: 680px;
                      text-align: center;
                    "
                  >
                    <a href="https://e-stalls.nl/">
                      <img
                        src="https://e-stalls.nl/public/images/logo-2.png"
                        alt="e-stalls"
                        width="94"
                        style="border-width: 0"
                        border="0"
                      />
                    </a>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <!-- END LOGO -->

          <tr>
            <td align="center">
              <table
                class="darkmode-transparent"
                cellpadding="0"
                cellspacing="0"
                role="presentation"
              >
                <tr>
                  <!--[if (gte mso 9)|(IE)]>
                    <td
                      style="
                        padding-top: 80px;
                        padding-bottom: 20px;
                      "
                    ></td>
                  <![endif]-->
                  <td
                    style="
                      width: 30px;
                      max-width: 30px;
                      padding-top: 100px;
                    "
                    width="30"
                  ></td>

                  <td
                    valign="middle"
                    align="left"
                    style="vertical-align: middle; padding: 0 30px;"
                  >
                    <p
                      style="
                        font-weight: bold;
                        font-size: 18px;
                      "
                    >
                        Hallo,
                    </p>

                    <p
                      style="font-size: 18px;
                        font-weight: 100;
                        padding-top: 34px;
                        line-height: 1.7;">
                        Er is een nieuwe ondernemersaanvraag binnengekomen met de volgende opties:
                        <br />
                    </p>
                    <table style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif; margin: 20px 0;">
                        <thead>
                            <tr style="background-color: #f2f2f2;">
                                <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">#</th>
                                <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">Optie</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @if ($vendor->offer)
                                @foreach (explode(',', $vendor->offer) as $item)
                                    <tr style="border: 1px solid #ddd;">
                                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $loop->iteration }}</td>
                                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $item }}</td>
                                    </tr> 
                                @endforeach
                            @else
                                <tr style="border: 1px solid #ddd;">
                                    <td colspan="2" style="padding: 10px; border: 1px solid #ddd; text-align: center; font-weight: bolder;">Geen opties gekozen</td>
                                </tr>
                            @endif
                            {{-- <tr style="border: 1px solid #ddd;">
                            <td style="padding: 10px; border: 1px solid #ddd;">3</td>
                            <td style="padding: 10px; border: 1px solid #ddd;">Keyboard</td>
                            <td style="padding: 10px; border: 1px solid #ddd; color: red;">Out of Stock</td>
                            </tr> --}}
                        </tbody>
                    </table> 

                  </td>

                  <td
                    style="
                      width: 30px;
                      max-width: 30px;
                      padding-bottom: 60px;
                    "
                    width="30"
                  ></td>
                </tr>
              </table>
            </td>
          </tr>

          <tr>
            <td>
              <table
                style="font-family: 'Roboto', sans-serif; padding: 25px 25px 0;"
                role="presentation"
                cellpadding="0"
                cellspacing="0"
                width="100%"
                border="0"
              >
                <tbody>
                  <tr>
                    <td
                      style="
                        background-color: #fff;
                        overflow-wrap: break-word;
                        word-break: break-word;
                        padding: 25px 35px 35px;
                        font-family: 'Roboto', sans-serif;
                        text-align: left;
                      "
                      align="left"
                    >
                      <p style="font-size: 18px">
                        Met vriendelijke groet,
                      </p>

                      <p
                        style="
                          padding-top: 18px;
                          padding-bottom: 12px;
                          font-size: 18px;
                        "
                      >
                        E-Stalls Events
                      </p>
                    </td>
                  </tr>
                </tbody>
              </table>
            </td>
          </tr>

        </table>

        <!--[if (gte mso 9)|(IE)]>
				</td>
				</tr>
				</table>
			<![endif]-->
      </div>
    </center>
  </body>
</html>
