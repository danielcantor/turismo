<!DOCTYPE html>
<html xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office" lang="es">

<head>
 <meta charset="UTF-8" />
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta name="viewport" content="width=device-width, initial-scale=1.0" />
 <meta name="format-detection" content="telephone=no" />
 <meta name="format-detection" content="date=no" />
 <meta name="format-detection" content="address=no" />
 <meta name="format-detection" content="email=no" />
 <meta name="x-apple-disable-message-reformatting" />
 <title>Confirmación de Reserva</title>
 <style>
 /* Gmail-optimized CSS */
 html, body {
     margin: 0 !important;
     padding: 0 !important;
     width: 100% !important;
     min-height: 100% !important;
 }
 
 * {
     -ms-text-size-adjust: 100%;
     -webkit-text-size-adjust: 100%;
 }
 
 table, td {
     mso-table-lspace: 0pt !important;
     mso-table-rspace: 0pt !important;
     border-collapse: collapse !important;
 }
 
 img {
     border: 0;
     outline: 0;
     line-height: 100%;
     text-decoration: none;
 }
 
 .gmail-container {
     width: 100% !important;
     max-width: 600px !important;
     margin: 0 auto !important;
     background-color: #ffffff !important;
 }
 
 .gmail-header {
     background-color: #13a4ec !important;
     padding: 20px !important;
     text-align: center !important;
 }
 
 .gmail-content {
     background-color: #ffffff !important;
     padding: 30px 20px !important;
 }
 
 .gmail-title {
     font-family: Arial, Helvetica, sans-serif !important;
     font-size: 24px !important;
     font-weight: bold !important;
     color: #ffffff !important;
     margin: 0 !important;
     text-align: center !important;
 }
 
 .gmail-text {
     font-family: Arial, Helvetica, sans-serif !important;
     font-size: 16px !important;
     color: #434343 !important;
     line-height: 1.5 !important;
     margin: 10px 0 !important;
 }
 
 .gmail-bold {
     font-weight: bold !important;
 }
 
 .gmail-separator {
     border-top: 2px solid #D9D9D9 !important;
     margin: 20px 0 !important;
     height: 1px !important;
 }
 
 .passenger-box {
     background-color: #f8f9fa !important;
     border: 1px solid #e9ecef !important;
     border-radius: 8px !important;
     padding: 15px !important;
     margin: 15px 0 !important;
 }
 
 @media (max-width: 600px) {
     .gmail-container {
         width: 100% !important;
         max-width: 100% !important;
     }
     .gmail-content {
         padding: 20px 15px !important;
     }
     .gmail-header {
         padding: 15px !important;
     }
 }
 </style>
 <!--[if mso]>
    <style type="text/css">
        .gmail-text {
            font-family: Arial, Helvetica, sans-serif !important;
        }
    </style>
 <![endif]-->
</head>

<body style="margin: 0; padding: 0; width: 100%; background-color: #13a4ec; font-family: Arial, Helvetica, sans-serif;">
 <div style="display:none;font-size:1px;color:#fefefe;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;">Confirmación de tu reserva</div>
 
 <!-- Outer table for Gmail compatibility -->
 <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse; background-color: #13a4ec;">
  <tr>
   <td align="center" style="padding: 20px 10px;">
    
    <!-- Main container -->
    <table border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse; max-width: 600px; width: 100%; background-color: #ffffff; border-radius: 8px;">
     
     <!-- Header -->
     <tr>
      <td align="center" style="background-color: #13a4ec; padding: 30px 20px; border-radius: 8px 8px 0 0;">
       <h1 style="margin: 0; font-family: Arial, Helvetica, sans-serif; font-size: 24px; font-weight: bold; color: #ffffff; text-align: center;">
        CONFIRMACIÓN DE RESERVA
       </h1>
      </td>
     </tr>
     
     <!-- Main content -->
     <tr>
      <td style="padding: 30px 40px; background-color: #ffffff;">
       
       <!-- Order info -->
       <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
        <tr>
         <td style="padding-bottom: 20px;">
          <p style="margin: 0 0 10px 0; font-family: Arial, Helvetica, sans-serif; font-size: 18px; color: #434343; font-weight: 500;">
           Pedido nro #{{ $orderCode }}
          </p>
          <p style="margin: 0 0 15px 0; font-family: Arial, Helvetica, sans-serif; font-size: 18px; color: #434343;">
           {{ $name }}, felicidades acá está el resumen de tu reserva
          </p>
          <p style="margin: 0 0 5px 0; font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: #434343;">
           <strong>Fecha de la reserva:</strong> {{ $orderDate ?? date('d-m-Y') }}
          </p>
          <p style="margin: 0; font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: #434343;">
           <strong>Total:</strong> ${{ $totalPrice ?? '0' }}
          </p>
         </td>
        </tr>
       </table>
       
       <!-- Separator -->
       <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
        <tr>
         <td style="border-top: 2px solid #D9D9D9; padding: 20px 0;"></td>
        </tr>
       </table>
       
       <!-- Product info -->
       <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
        <tr>
         <td width="50%" style="padding-right: 20px; vertical-align: top;">
          <p style="margin: 0; font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: #434343; font-weight: bold;">
           Información del producto:
          </p>
         </td>
         <td width="50%" style="vertical-align: top;">
          <p style="margin: 0; font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: #434343;">
           {{ $productInfo['name'] ?? 'N/A' }}
          </p>
         </td>
        </tr>
       </table>
       
       <!-- Separator -->
       <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
        <tr>
         <td style="border-top: 2px solid #D9D9D9; padding: 20px 0;"></td>
        </tr>
       </table>
       
       <!-- Billing info -->
       <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
        <tr>
         <td width="50%" style="padding-right: 20px; vertical-align: top;">
          <p style="margin: 0 0 10px 0; font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: #434343; font-weight: bold;">
           Datos de facturación:
          </p>
         </td>
         <td width="50%" style="vertical-align: top;">
          <p style="margin: 0 0 5px 0; font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: #434343;">
           {{ $billingInfo['payment_method'] ?? 'Tarjeta de crédito' }}
          </p>
          <p style="margin: 0 0 5px 0; font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: #434343;">
           {{ $billingInfo['name'] ?? 'N/A' }}
          </p>
          <p style="margin: 0 0 5px 0; font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: #434343;">
           {{ $billingInfo['dni'] ?? 'N/A' }}
          </p>
          <p style="margin: 0 0 5px 0; font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: #434343;">
           {{ $billingInfo['phone'] ?? 'N/A' }}
          </p>
          <p style="margin: 0; font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: #434343;">
           {{ $billingInfo['email'] ?? 'N/A' }}
          </p>
         </td>
        </tr>
       </table>
       
       <!-- Separator -->
       <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
        <tr>
         <td style="border-top: 2px solid #D9D9D9; padding: 30px 0 20px 0;"></td>
        </tr>
       </table>
       
       <!-- Passengers title -->
       <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
        <tr>
         <td align="center" style="padding-bottom: 20px;">
          <h2 style="margin: 0; font-family: Arial, Helvetica, sans-serif; font-size: 18px; color: #434343; font-weight: 500; text-align: center;">
           Información de los pasajeros:
          </h2>
         </td>
        </tr>
       </table>
       
       <!-- Passengers info -->
       @if(is_array($passengers) && count($passengers) > 0)
        @foreach ($passengers as $index => $passenger)
         <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse; margin-bottom: 20px;">
          <tr>
           <td style="background-color: #f8f9fa; border: 1px solid #e9ecef; border-radius: 8px; padding: 15px;">
            <p style="margin: 0 0 10px 0; font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: #434343; font-weight: bold;">
             Pasajero #{{ $index + 1 }}
            </p>
            <p style="margin: 0 0 5px 0; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #434343;">
             <strong>Nombre:</strong> {{ $passenger['nombre'] ?? 'N/A' }} {{ $passenger['apellido'] ?? '' }}
            </p>
            <p style="margin: 0 0 5px 0; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #434343;">
             <strong>Email:</strong> {{ $passenger['email'] ?? 'N/A' }}
            </p>
            <p style="margin: 0 0 5px 0; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #434343;">
             <strong>Documento:</strong> {{ $passenger['documento'] ?? 'N/A' }}
            </p>
            <p style="margin: 0 0 5px 0; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #434343;">
             <strong>Teléfono:</strong> {{ $passenger['celular'] ?? 'N/A' }}
            </p>
            <p style="margin: 0 0 5px 0; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #434343;">
             <strong>Fecha nacimiento:</strong> {{ $passenger['nacimiento'] ?? 'N/A' }}
            </p>
            <p style="margin: 0; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #434343;">
             <strong>Tipo de dieta:</strong> 
             @php
                 $dietas = [
                     0 => 'Normal',
                     1 => 'Vegetariano',
                     2 => 'Celiaco',
                     3 => 'Diabético',
                     4 => 'Hipertenso'
                 ];
                 $dietaTexto = isset($passenger['dieta']['tipo']) ? ($dietas[$passenger['dieta']['tipo']] ?? 'Normal') : 'Normal';
             @endphp
             {{ $dietaTexto }}
            </p>
           </td>
          </tr>
         </table>
        @endforeach
       @else
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
         <tr>
          <td align="center" style="padding: 15px;">
           <p style="margin: 0; font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: #434343;">
            No hay información de pasajeros disponible.
           </p>
          </td>
         </tr>
        </table>
       @endif
       
       <!-- Footer -->
       <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
        <tr>
         <td style="border-top: 2px solid #D9D9D9; padding: 30px 0 20px 0; text-align: center;">
          <p style="margin: 0 0 10px 0; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #666666;">
           ¡Gracias por confiar en nosotros!
          </p>
          <p style="margin: 0; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #666666;">
           Para cualquier consulta, contáctanos
          </p>
         </td>
        </tr>
       </table>
       
      </td>
     </tr>
     
    </table>
    
   </td>
  </tr>
 </table>
 
</body>

</html>
