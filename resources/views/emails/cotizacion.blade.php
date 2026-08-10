<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Nueva Solicitud de Cotización</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 20px;">
    <div
        style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border: 1px solid #dddddd; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
        <!-- Header -->
        <div style="background-color: #0f172a; padding: 20px; text-align: center; color: #ffffff;">
            <h2 style="margin: 0; font-size: 20px; tracking-wider: uppercase;">Solicitud de Cotización</h2>
        </div>

        <!-- Body -->
        <div style="padding: 20px; line-height: 1.6; color: #333333;">
            <p>Se ha recibido una nueva solicitud de cotización desde la web corporativa:</p>

            <table style="width: 100%; border-collapse: collapse; margin-top: 15px;">
                <tr>
                    <td style="padding: 8px; border-bottom: 1px solid #eeeeee; font-weight: bold; width: 150px;">
                        Producto:</td>
                    <td style="padding: 8px; border-bottom: 1px solid #eeeeee;">{{ $datos['producto'] }}</td>
                </tr>
                @if (isset($datos['precio']))
                    <tr>
                        <td style="padding: 8px; border-bottom: 1px solid #eeeeee; font-weight: bold;">Precio Ref:</td>
                        <td style="padding: 8px; border-bottom: 1px solid #eeeeee;">US$
                            {{ number_format($datos['precio'], 2) }}</td>
                    </tr>
                @endif
                @if (isset($datos['categoria']))
                    <tr>
                        <td style="padding: 8px; border-bottom: 1px solid #eeeeee; font-weight: bold;">Categoría:</td>
                        <td style="padding: 8px; border-bottom: 1px solid #eeeeee;">{{ $datos['categoria'] }}</td>
                    </tr>
                @endif
                <tr>
                    <td style="padding: 8px; border-bottom: 1px solid #eeeeee; font-weight: bold; font-size: 14px; color: #f97316;"
                        colspan="2"><br>DATOS DEL INTERESADO</td>
                </tr>
                <tr>
                    <td style="padding: 8px; border-bottom: 1px solid #eeeeee; font-weight: bold;">Nombre:</td>
                    <td style="padding: 8px; border-bottom: 1px solid #eeeeee;">{{ $datos['nombre'] }}</td>
                </tr>
                @if (isset($datos['empresa']))
                    <tr>
                        <td style="padding: 8px; border-bottom: 1px solid #eeeeee; font-weight: bold;">Empresa:</td>
                        <td style="padding: 8px; border-bottom: 1px solid #eeeeee;">{{ $datos['empresa'] }}</td>
                    </tr>
                @endif
                <tr>
                    <td style="padding: 8px; border-bottom: 1px solid #eeeeee; font-weight: bold;">Correo:</td>
                    <td style="padding: 8px; border-bottom: 1px solid #eeeeee;">{{ $datos['correo'] }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px; border-bottom: 1px solid #eeeeee; font-weight: bold;">Celular:</td>
                    <td style="padding: 8px; border-bottom: 1px solid #eeeeee;">{{ $datos['telefono'] }}</td>
                </tr>
                @if (isset($datos['ciudad']))
                    <tr>
                        <td style="padding: 8px; border-bottom: 1px solid #eeeeee; font-weight: bold;">Ciudad:</td>
                        <td style="padding: 8px; border-bottom: 1px solid #eeeeee;">{{ $datos['ciudad'] }}</td>
                    </tr>
                @endif
                @if (isset($datos['mensaje']))
                    <tr>
                        <td
                            style="padding: 8px; border-bottom: 1px solid #eeeeee; font-weight: bold; vertical-align: top;">
                            Mensaje:</td>
                        <td style="padding: 8px; border-bottom: 1px solid #eeeeee;">{{ $datos['mensaje'] }}</td>
                    </tr>
                @endif
            </table>
        </div>

        <!-- Footer -->
        <div
            style="background-color: #f8fafc; padding: 15px; text-align: center; font-size: 11px; color: #64748b; border-top: 1px solid #e2e8f0;">
            Este mensaje fue generado automáticamente por el sistema de IMPORTACIONES DELTA PERU S.A.C.
        </div>
    </div>
</body>

</html>
