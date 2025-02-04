<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pago Exitoso</title>
    <style type="text/css">
        @media only screen and (min-width: 620px) {
            .u-row {
                width: 600px !important;
            }
            .u-row .u-col {
                vertical-align: top;
            }
            .u-row .u-col-100 {
                width: 600px !important;
            }
        }
        @media (max-width: 620px) {
            .u-row-container {
                max-width: 100% !important;
                padding-left: 0px !important;
                padding-right: 0px !important;
            }
            .u-row .u-col {
                min-width: 320px !important;
                max-width: 100% !important;
                display: block !important;
            }
            .u-row {
                width: 100% !important;
            }
            .u-col {
                width: 100% !important;
            }
            .u-col > div {
                margin: 0 auto;
            }
        }
        body {
            margin: 0;
            padding: 0;
        }
        table, tr, td {
            vertical-align: top;
            border-collapse: collapse;
        }
        p {
            margin: 0;
        }
        .ie-container table, .mso-container table {
            table-layout: fixed;
        }
        * {
            line-height: inherit;
        }
        a[x-apple-data-detectors='true'] {
            color: inherit !important;
            text-decoration: none !important;
        }
        table, td { color: #000000; }
    </style>
</head>
<body class="clean-body u_body" style="margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #535353;color: #000000">
    <table style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #535353;width:100%" cellpadding="0" cellspacing="0">
        <tbody>
            <tr style="vertical-align: top">
                <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                    <div class="u-row-container" style="padding: 0px;background-color: transparent">
                        <div class="u-row" style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
                            <div style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                                <div class="u-col u-col-100" style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                                    <div style="background-color: #268e92;height: 100%;width: 100% !important;">
                                        <div style="box-sizing: border-box; height: 100%; padding: 0px;border-top: 40px solid #e8eae9;border-left: 45px solid #e8eae9;border-right: 45px solid #e8eae9;border-bottom: 10px solid #e8eae9;">
                                            <table style="font-family:arial,helvetica,sans-serif;" role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                                <tbody>
                                                    <tr>
                                                        <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:arial,helvetica,sans-serif;" align="left">
                                                            <h1 style="margin: 0px; color: #ffffff; line-height: 220%; text-align: center; word-wrap: break-word; font-size: 24px; font-weight: 700;">
                                                                Pago
                                                            </h1>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:arial,helvetica,sans-serif;" align="left">
                                                            <p style="margin: 0px; color: #ffffff; line-height: 160%; text-align: center; word-wrap: break-word; font-size: 18px; font-weight: 400;">
                                                                Estimado/a {{ $customerName }},
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:arial,helvetica,sans-serif;" align="left">
                                                            <p style="margin: 0px; color: #ffffff; line-height: 160%; text-align: center; word-wrap: break-word; font-size: 18px; font-weight: 400;">
                                                                Nos complace informarle que su pago ha sido recibido con éxito.
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:arial,helvetica,sans-serif;" align="left">
                                                            <p style="margin: 0px; color: #ffffff; line-height: 160%; text-align: center; word-wrap: break-word; font-size: 18px; font-weight: 400;">
                                                                Detalles del pedido:
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:arial,helvetica,sans-serif;" align="left">
                                                            <ul style="margin: 0px; color: #ffffff; line-height: 160%; text-align: center; word-wrap: break-word; font-size: 18px; font-weight: 400;">
                                                                <li>Número de pedido: {{ $orderNumber }}</li>
                                                                <li>Fecha del pedido: {{ $orderDate }}</li>
                                                                <li>Total: {{ $orderTotal }}</li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:arial,helvetica,sans-serif;" align="left">
                                                            <p style="margin: 0px; color: #ffffff; line-height: 160%; text-align: center; word-wrap: break-word; font-size: 18px; font-weight: 400;">
                                                                Su pedido está siendo procesado y le notificaremos cuando esté listo para el envío.
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:arial,helvetica,sans-serif;" align="left">
                                                            <p style="margin: 0px; color: #ffffff; line-height: 160%; text-align: center; word-wrap: break-word; font-size: 18px; font-weight: 400;">
                                                                Gracias por su compra.
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:arial,helvetica,sans-serif;" align="left">
                                                            <p style="margin: 0px; color: #ffffff; line-height: 160%; text-align: center; word-wrap: break-word; font-size: 18px; font-weight: 400;">
                                                                Saludos cordiales,
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:arial,helvetica,sans-serif;" align="left">
                                                            <p style="margin: 0px; color: #ffffff; line-height: 160%; text-align: center; word-wrap: break-word; font-size: 18px; font-weight: 400;">
                                                                El equipo de Turismo
                                                            </p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>
