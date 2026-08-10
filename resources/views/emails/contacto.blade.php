<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Nueva Consulta Web</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border: 1px solid #dddddd; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
        <!-- Header -->
        <div style="background-color: #0f172a; padding: 20px; text-align: center; color: #ffffff;">
            <h2 style="margin: 0; font-size: 20px; tracking-wider: uppercase;">Nueva Consulta de Contacto</h2>
        </div>
        
        <!-- Body -->
        <div style="padding: 20px; line-height: 1.6; color: #333333;">
            <p>Se ha recibido un nuevo mensaje desde el formulario de contacto web:</p>
            
            <table style="width: 100%; border-collapse: collapse; margin-top: 15px;">
                <tr>
                    <td style="padding: 8px; border-bottom: 1px solid #eeeeee; font-weight: bold; width: 150px;">Nombre:</td>
                    <td style="padding: 8px; border-bottom: 1px solid #eeeeee;">{{ $datos['nombre'] }}</td>
                </tr>
                @if(isset($datos['empresa']))
                <tr>
                    <td style="padding: 8px; border-bottom: 1px solid #eeeeee; font-weight: bold;">Empresa:</td>
                    <td style="padding: 8px; border-bottom: 1px solid #eeeeee;">{{ $datos['empresa'] }}</td>
                </tr>
                @endif
                <tr>
                    <td style="padding: 8px; border-bottom: 1px solid #eeeeee; font-weight: bold;">Celular:</td>
                    <td style="padding: 8px; border-bottom: 1px solid #eeeeee;">{{ $datos['telefono'] }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px; border-bottom: 1px solid #eeeeee; font-weight: bold;">Correo:</td>
                    <td style="padding: 8px; border-bottom: 1px solid #eeeeee;">{{ $datos['correo'] }}</td>
                </tr>
                @if(isset($datos['especialista']))
                <tr>
                    <td style="padding: 8px; border-bottom: 1px solid #eeeeee; font-weight: bold;">Especialista:</td>
                    <td style="padding: 8px; border-bottom: 1px solid #eeeeee;">
                        {{ $datos['especialista']->nombre }} ({{ $datos['especialista']->cargo }})
                    </td>
                </tr>
                @endif
                <tr>
                    <td style="padding: 8px; border-bottom: 1px solid #eeeeee; font-weight: bold; vertical-align: top;">Mensaje:</td>
                    <td style="padding: 8px; border-bottom: 1px solid #eeeeee;">{{ $datos['mensaje'] }}</td>
                </tr>
            </table>
        </div>

        <!-- Footer -->
        <div style="background-color: #f8fafc; padding: 15px; text-align: center; font-size: 11px; color: #64748b; border-top: 1px solid #e2e8f0;">
            Este mensaje fue generado automáticamente por el sistema de DELTAPACK.
        </div>
    </div>
</body>
</html>
