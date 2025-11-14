<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Registro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f9f9f9;
            padding: 30px;
            border: 1px solid #ddd;
            border-top: none;
        }
        .info-box {
            background-color: white;
            padding: 20px;
            margin: 20px 0;
            border-left: 4px solid #4CAF50;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .info-row {
            margin: 10px 0;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .label {
            font-weight: bold;
            color: #555;
            display: inline-block;
            width: 150px;
        }
        .value {
            color: #333;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #4CAF50;
            color: #777;
            font-size: 14px;
        }
        .success-icon {
            font-size: 50px;
            text-align: center;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>¡Registro Exitoso!</h1>
    </div>

    <div class="content">
        <div class="success-icon"></div>

        <p>Estimado/a <strong>{{ $registro->nombres }} {{ $registro->apellidos }}</strong>,</p>

        <p>Le confirmamos que su registro ha sido completado exitosamente. A continuación encontrará los detalles de su registro:</p>

        <div class="info-box">
            <h3 style="margin-top: 0; color: #4CAF50;">Datos Registrados</h3>

            <div class="info-row">
                <span class="label">Código de Socio:</span>
                <span class="value">{{ $registro->codigo_socio }}</span>
            </div>

            <div class="info-row">
                <span class="label">Nombres:</span>
                <span class="value">{{ $registro->nombres }}</span>
            </div>

            <div class="info-row">
                <span class="label">Apellidos:</span>
                <span class="value">{{ $registro->apellidos }}</span>
            </div>

            <div class="info-row">
                <span class="label">Correo:</span>
                <span class="value">{{ $registro->correo }}</span>
            </div>

            <div class="info-row">
                <span class="label">Teléfono:</span>
                <span class="value">{{ $registro->telefono }}</span>
            </div>

            <div class="info-row">
                <span class="label">Edad:</span>
                <span class="value">{{ $registro->edad }} años</span>
            </div>

            <div class="info-row">
                <span class="label">Fecha de Registro:</span>
                <span class="value">{{ $registro->created_at->format('d/m/Y H:i:s') }}</span>
            </div>
        </div>

        <p><strong>¡Gracias por registrarse!</strong></p>

        <p>Si tiene alguna pregunta o necesita asistencia, no dude en contactarnos.</p>

        <div class="footer">
            <p>Este es un correo automático, por favor no responda a este mensaje.</p>
            <p>Rinconada Country Club · Copyright &copy; 1956 - {{ date('Y') }} </p>
        </div>
    </div>
</body>
</html>
