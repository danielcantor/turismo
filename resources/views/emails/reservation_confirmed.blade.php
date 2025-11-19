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
           Reserva nro #{{ $orderCode }}
          </p>
          <p style="margin: 0 0 15px 0; font-family: Arial, Helvetica, sans-serif; font-size: 18px; color: #434343;">
           {{ $name }}, felicidades acá está el resumen de tu reserva
          </p>
          <p style="margin: 0; font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: #434343;">
           Fecha de la reserva: {{ $orderDate ?? date('d/m/Y') }}
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
       
       <!-- Service Details -->
       <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
        <tr>
         <td style="padding-bottom: 15px;">
          <h2 style="margin: 0; font-family: Arial, Helvetica, sans-serif; font-size: 18px; color: #434343; font-weight: bold; text-align: left;">
           DETALLES DEL SERVICIO CONTRATADO
          </h2>
         </td>
        </tr>
       </table>
       
       <!-- Service Details Table -->
       <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse; border: 1px solid #D9D9D9;">
        <tr style="background-color: #f8f9fa;">
         <td style="padding: 10px; border: 1px solid #D9D9D9; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #434343; font-weight: bold;">
          Destino
         </td>
         <td style="padding: 10px; border: 1px solid #D9D9D9; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #434343; font-weight: bold;">
          Fecha
         </td>
         <td style="padding: 10px; border: 1px solid #D9D9D9; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #434343; font-weight: bold;">
          Cantidad
         </td>
         <td style="padding: 10px; border: 1px solid #D9D9D9; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #434343; font-weight: bold;">
          Precio unitario
         </td>
         <td style="padding: 10px; border: 1px solid #D9D9D9; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #434343; font-weight: bold;">
          Total
         </td>
        </tr>
        <tr>
         <td style="padding: 10px; border: 1px solid #D9D9D9; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #434343;">
          {{ $productInfo['name'] ?? 'N/A' }}
          @if(isset($productInfo['days']) && isset($productInfo['nights']))
          <br><span style="font-size: 12px; color: #666666;">({{ $productInfo['days'] }} Días {{ $productInfo['nights'] }} Noche{{ $productInfo['nights'] > 1 ? 's' : '' }})</span>
          @endif
         </td>
         <td style="padding: 10px; border: 1px solid #D9D9D9; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #434343;">
          @if(isset($productInfo['departureDate']))
           {{ \Carbon\Carbon::parse($productInfo['departureDate'])->format('d/m/Y') }}
          @else
           N/A
          @endif
         </td>
         <td style="padding: 10px; border: 1px solid #D9D9D9; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #434343;">
          {{ $productInfo['quantity'] ?? 1 }}
         </td>
         <td style="padding: 10px; border: 1px solid #D9D9D9; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #434343;">
          ${{ number_format($productInfo['price'] ?? 0, 0, ',', '.') }}
         </td>
         <td style="padding: 10px; border: 1px solid #D9D9D9; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #434343; font-weight: bold;">
          ${{ number_format(($productInfo['price'] ?? 0) * ($productInfo['quantity'] ?? 1), 0, ',', '.') }}
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
         <td style="padding-bottom: 15px;">
          <h2 style="margin: 0; font-family: Arial, Helvetica, sans-serif; font-size: 18px; color: #434343; font-weight: bold; text-align: left;">
           DATOS DE FACTURACIÓN
          </h2>
         </td>
        </tr>
        <tr>
         <td>
          <p style="margin: 0; font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: #434343;">
           <strong>Reserva N°:</strong> {{ $orderCode }}&nbsp;&nbsp;&nbsp;&nbsp;<strong>Fecha de emisión:</strong> {{ $orderDate ?? date('d/m/Y') }}
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
       
       <!-- Payment Methods Section -->
       <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
        <tr>
         <td style="border-top: 2px solid #D9D9D9; padding: 30px 0 20px 0;">
          <h2 style="margin: 0 0 20px 0; font-family: Arial, Helvetica, sans-serif; font-size: 18px; color: #434343; font-weight: bold; text-align: center;">
           MÉTODOS DE PAGO
          </h2>
          
          <!-- Bank Transfer -->
          <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse; margin-bottom: 20px;">
           <tr>
            <td style="background-color: #f8f9fa; border: 1px solid #e9ecef; border-radius: 8px; padding: 20px;">
             <p style="margin: 0 0 10px 0; font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: #434343; font-weight: bold;">
              TRANSFERENCIA BANCARIA
             </p>
             <p style="margin: 0 0 5px 0; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #434343;">
              <strong>Titular de la cuenta:</strong> Garske Cynthia Edith
             </p>
             <p style="margin: 0 0 5px 0; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #434343;">
              <strong>Banco:</strong> Santander
             </p>
             <p style="margin: 0 0 5px 0; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #434343;">
              <strong>Número de cuenta:</strong> Cuentas en Pesos 088-017532/0
             </p>
             <p style="margin: 0 0 5px 0; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #434343;">
              <strong>Número de CBU:</strong> 0720088588000001753204
             </p>
             <p style="margin: 0; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #434343;">
              <strong>Alias:</strong> salidas.turismo.cyn
             </p>
            </td>
           </tr>
          </table>
          
          <!-- Credit Card -->
          <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse; margin-bottom: 20px;">
           <tr>
            <td style="background-color: #f8f9fa; border: 1px solid #e9ecef; border-radius: 8px; padding: 20px;">
             <p style="margin: 0 0 10px 0; font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: #434343; font-weight: bold;">
              TARJETA DE CRÉDITO
             </p>
             <p style="margin: 0; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #434343;">
              Solicitar link de pago (sumar el gasto de gestión 9% + el interés que adicione la entidad bancaria)
             </p>
            </td>
           </tr>
          </table>
          
         </td>
        </tr>
       </table>
       
       <!-- Important Notice -->
       <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
        <tr>
         <td style="padding: 20px 0;">
          <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
           <tr>
            <td style="background-color: #fff3cd; border: 2px solid #ffc107; border-radius: 8px; padding: 20px;">
             <p style="margin: 0 0 10px 0; font-family: Arial, Helvetica, sans-serif; font-size: 16px; color: #856404; font-weight: bold;">
              IMPORTANTE:
             </p>
             <p style="margin: 0 0 10px 0; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #856404; line-height: 1.6;">
              NOS ESTAREMOS COMUNICANDO DENTRO DE LAS 48 HS PARA CONFIRMARLE LA RESERVA, DE NO RECIBIR CONFIRMACIÓN DENTRO DE ESE PLAZO LE PEDIMOS TENGA A BIEN COMUNICARSE CON NOSOTROS AL SIGUIENTE WHATSAPP 1134138037.
             </p>
             <p style="margin: 0; font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #856404; font-weight: bold;">
              MUCHAS GRACIAS POR ELEGIRNOS!!!
             </p>
            </td>
           </tr>
          </table>
         </td>
        </tr>
       </table>
       
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
