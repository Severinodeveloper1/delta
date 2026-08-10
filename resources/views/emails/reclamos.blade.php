<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Nuevo Reclamo - Libro de Reclamaciones</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 20px;">
    <div style="max-width: 650px; margin: 0 auto; background-color: #ffffff; border: 1px solid #dddddd; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
        <!-- Header -->
        <div style="background-color: #dc2626; padding: 20px; text-align: center; color: #ffffff;">
            <h2 style="margin: 0; font-size: 20px; tracking-wider: uppercase;">Hoja de Reclamación Virtual</h2>
        </div>
        
        <!-- Body -->
        <div style="padding: 20px; line-height: 1.6; color: #333333;">
            <p>Se ha registrado un nuevo reclamo/queja en la plataforma web:</p>
            
            <h4 style="color: #dc2626; border-bottom: 2px solid #eeeeee; padding-bottom: 5px;">1. Datos del Consumidor</h4>
            <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                <tr>
                    <td style="padding: 6px 0; font-weight: bold; width: 150px;">Nombre:</td>
                    <td>{{ $reclamo['nombre'] }}</td>
                </tr>
                <tr>
                    <td style="padding: 6px 0; font-weight: bold;">Documento:</td>
                    <td>{{ $reclamo['tipo_doc'] }} - {{ $reclamo['nro_doc'] }}</td>
                </tr>
                <tr>
                    <td style="padding: 6px 0; font-weight: bold;">Celular:</td>
                    <td>{{ $reclamo['telefono'] }}</td>
                </tr>
                <tr>
                    <td style="padding: 6px 0; font-weight: bold;">Correo:</td>
                    <td>{{ $reclamo['correo'] }}</td>
                </tr>
                <tr>
                    <td style="padding: 6px 0; font-weight: bold;">Domicilio:</td>
                    <td>{{ $reclamo['domicilio'] }}</td>
                </tr>
            </table>

            <h4 style="color: #dc2626; border-bottom: 2px solid #eeeeee; padding-bottom: 5px;">2. Bien Contratado</h4>
            <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                <tr>
                    <td style="padding: 6px 0; font-weight: bold; width: 150px;">Tipo de Bien:</td>
                    <td>{{ $reclamo['tipo_bien'] }}</td>
                </tr>
                <tr>
                    <td style="padding: 6px 0; font-weight: bold;">Descripción del Bien:</td>
                    <td>{{ $reclamo['descripcion_bien'] }}</td>
                </tr>
                @if(isset($reclamo['monto']))
                <tr>
                    <td style="padding: 6px 0; font-weight: bold;">Monto Reclamado:</td>
                    <td>{{ $reclamo['monto'] }}</td>
                </tr>
                @endif
            </table>

            <h4 style="color: #dc2626; border-bottom: 2px solid #eeeeee; padding-bottom: 5px;">3. Detalle de Reclamación</h4>
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="padding: 6px 0; font-weight: bold; width: 150px;">Tipo de Registro:</td>
                    <td><strong>{{ $reclamo['tipo_solicitud'] }}</strong></td>
                </tr>
                <tr>
                    <td style="padding: 6px 0; font-weight: bold; vertical-align: top;">Detalle del Suceso:</td>
                    <td style="padding: 6px 0;">{{ $reclamo['detalle_reclamo'] }}</td>
                </tr>
                <tr>
                    <td style="padding: 6px 0; font-weight: bold; vertical-align: top;">Pedido del Cliente:</td>
                    <td style="padding: 6px 0;">{{ $reclamo['pedido_consumidor'] }}</td>
                </tr>
            </table>
        </div>

        <!-- Footer -->
        <div style="background-color: #f8fafc; padding: 15px; text-align: center; font-size: 11px; color: #64748b; border-top: 1px solid #e2e8f0;">
            Este mensaje fue generado automáticamente por el Libro de Reclamaciones de DELTAPACK.
        </div>
    </div>
</body>
</html>
