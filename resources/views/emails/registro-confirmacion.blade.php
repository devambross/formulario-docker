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
        <h1>✅ Inscripción Confirmada</h1>
        <p style="margin: 5px 0 0 0;">Sorteo de Bungalows DICIEMBRE 2025 – ENERO 2026</p>
    </div>

    <div class="content">
        <div class="success-icon">🏖️</div>

        <p>Estimado/a <strong>{{ $registro->nombres }}</strong>,</p>

        <p>Su inscripción para el sorteo de bungalows ha sido registrada exitosamente. A continuación, los detalles de su inscripción:</p>

        <div class="info-box">
            <h3 style="margin-top: 0; color: #4CAF50;">Datos de Inscripción</h3>

            <div class="info-row">
                <span class="label">Código de Asociado:</span>
                <span class="value"><strong>{{ $registro->codigo_socio }}</strong></span>
            </div>

            <div class="info-row">
                <span class="label">Nombre Completo:</span>
                <span class="value">{{ $registro->nombres }}</span>
            </div>

            <div class="info-row">
                <span class="label">Correo:</span>
                <span class="value">{{ $registro->correo }}</span>
            </div>

            <div class="info-row">
                <span class="label">Celular:</span>
                <span class="value">{{ $registro->telefono }}</span>
            </div>

            <div class="info-row">
                <span class="label">Fecha Seleccionada:</span>
                <span class="value"><strong>{{ $registro->fecha_preferencia }}</strong></span>
            </div>

            <div class="info-row">
                <span class="label">Tipo de Bungalow:</span>
                <span class="value">{{ $registro->tipo_bungalow == '6_personas' ? 'Bungalow para seis (6) personas' : 'Bungalow para nueve (9) personas' }}</span>
            </div>

            <div class="info-row">
                <span class="label">Fecha de Registro:</span>
                <span class="value">{{ $registro->created_at->format('d/m/Y H:i:s') }}</span>
            </div>
        </div>

        <div style="background-color: #fff3cd; border-left: 4px solid #ffc107; padding: 15px; margin: 20px 0;">
            <p style="margin: 0 0 10px 0; font-weight: bold; color: #856404;">⚠️ IMPORTANTE:</p>
            <ul style="margin: 0; padding-left: 20px; color: #856404; font-size: 14px;">
                <li>Si resulta favorecido, deberá realizar el pago en un máximo de 4 días posteriores al sorteo</li>
                <li>Deberá enviar el voucher al área de alquileres dentro de los días establecidos</li>
                <li>Los datos no pueden ser modificados después del envío</li>
                <li>Solo se considerará válida su primera inscripción</li>
            </ul>
        </div>

        <p><strong>Le informaremos los resultados del sorteo oportunamente.</strong></p>

        <p>Saludos cordiales,<br><strong>Club Rinconada</strong></p>

        <div class="footer">
            <p>Este es un correo automático, por favor no responda a este mensaje.</p>
            <p>Para consultas, comuníquese con el área de alquileres.</p>
            <p>Rinconada Country Club · Copyright &copy; 1956 - {{ date('Y') }} </p>
        </div>
    </div>
</body>
</html>
