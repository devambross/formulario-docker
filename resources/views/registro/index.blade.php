<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Formulario de Registro</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            max-width: 600px;
            width: 100%;
            padding: 40px;
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 10px;
            font-size: 28px;
        }

        .subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            color: #555;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .required {
            color: #e74c3c;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="number"] {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        input.error {
            border-color: #e74c3c;
        }

        .error-message {
            color: #e74c3c;
            font-size: 13px;
            margin-top: 5px;
            display: block;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            font-size: 14px;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }

        .alert-error {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }

        .alert ul {
            margin-left: 20px;
            margin-top: 10px;
        }

        .btn-submit {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .btn-submit:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        @media (max-width: 600px) {
            .container {
                padding: 30px 20px;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            h1 {
                font-size: 24px;
            }
        }

        .success-icon {
            text-align: center;
            font-size: 50px;
            margin-bottom: 15px;
        }

        .info-box {
            background-color: #fff3cd;
            border: 1px solid #ffc107;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 25px;
            font-size: 13px;
            line-height: 1.6;
        }

        .info-box strong {
            display: block;
            margin-bottom: 10px;
            color: #856404;
        }

        .info-box ul {
            margin-left: 20px;
            color: #856404;
        }

        .info-box li {
            margin-bottom: 5px;
        }

        select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s ease;
            font-family: inherit;
            background-color: white;
            cursor: pointer;
        }

        select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        select.error {
            border-color: #e74c3c;
        }

        .checkbox-group {
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .checkbox-group input[type="checkbox"] {
            width: 20px;
            height: 20px;
            margin-top: 2px;
            cursor: pointer;
        }

        .checkbox-group label {
            margin-bottom: 0;
            font-weight: 400;
            cursor: pointer;
            flex: 1;
        }

        .checkbox-group a {
            color: #667eea;
            text-decoration: none;
        }

        .checkbox-group a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📋 Solicitud de Inscripción para Sorteo de Bungalows</h1>
        <p class="subtitle">DICIEMBRE 2025 – ENERO 2026</p>

        <div class="info-box">
            <strong>REQUISITOS DE INSCRIPCIÓN:</strong>
            <ul>
                <li>Sólo los asociados Titulares HÁBILES (sin deudas de cuotas de mantenimiento)</li>
                <li>Debe registrarse en una sola fecha. Si se inscribe más de una vez, sólo se considerará la primera</li>
                <li>Es responsabilidad del asociado escribir bien sus datos. No habrá derecho a corregir después de enviar</li>
            </ul>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <div class="success-icon"></div>
                <strong>{{ session('success') }}</strong>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error">
                <strong>Por favor corrija los siguientes errores:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('registro.store') }}" method="POST" id="registroForm">
            @csrf

            <div class="form-group">
                <div class="checkbox-group">
                    <input
                        type="checkbox"
                        id="acepta_terminos"
                        name="acepta_terminos"
                        value="1"
                        {{ old('acepta_terminos') ? 'checked' : '' }}
                        class="@error('acepta_terminos') error @enderror"
                        required
                    >
                    <label for="acepta_terminos">
                        Está de acuerdo con los términos y condiciones - <a href="https://urli.info/1eCjp" target="_blank">Reglamento de Bungalows</a>. Después de enviar el formulario no habrá derecho a corregir algún dato. <span class="required">*</span>
                    </label>
                </div>
                @error('acepta_terminos')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="codigo_socio">Código de Asociado (Solo Titular o Cónyuge) <span class="required">*</span></label>
                <input
                    type="text"
                    id="codigo_socio"
                    name="codigo_socio"
                    value="{{ old('codigo_socio') }}"
                    class="@error('codigo_socio') error @enderror"
                    required
                    placeholder="Ej: 1234"
                >
                @error('codigo_socio')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="nombres">Nombres y Apellidos (Datos del Asociado Titular) <span class="required">*</span></label>
                <input
                    type="text"
                    id="nombres"
                    name="nombres"
                    value="{{ old('nombres') }}"
                    class="@error('nombres') error @enderror"
                    required
                    placeholder="Ej: Juan Carlos Pérez García"
                >
                @error('nombres')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="telefono">Número de Celular <span class="required">*</span></label>
                <input
                    type="tel"
                    id="telefono"
                    name="telefono"
                    value="{{ old('telefono') }}"
                    class="@error('telefono') error @enderror"
                    required
                    placeholder="Ej: 987654321"
                >
                @error('telefono')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="correo">Correo Electrónico <span class="required">*</span></label>
                <input
                    type="email"
                    id="correo"
                    name="correo"
                    value="{{ old('correo') }}"
                    class="@error('correo') error @enderror"
                    required
                    placeholder="ejemplo@correo.com"
                >
                @error('correo')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="fecha_preferencia">Elija su opción de fecha <span class="required">*</span></label>
                <select
                    id="fecha_preferencia"
                    name="fecha_preferencia"
                    class="@error('fecha_preferencia') error @enderror"
                    required
                >
                    <option value="">Seleccione una fecha...</option>
                    <option value="Viernes 12 al lunes 15 Dic" {{ old('fecha_preferencia') == 'Viernes 12 al lunes 15 Dic' ? 'selected' : '' }}>Viernes 12 al lunes 15 Dic</option>
                    <option value="Viernes 19 al lunes 22 Dic" {{ old('fecha_preferencia') == 'Viernes 19 al lunes 22 Dic' ? 'selected' : '' }}>Viernes 19 al lunes 22 Dic</option>
                    <option value="Viernes 26 al lunes 29 Dic" {{ old('fecha_preferencia') == 'Viernes 26 al lunes 29 Dic' ? 'selected' : '' }}>Viernes 26 al lunes 29 Dic</option>
                    <option value="Martes 30 al domingo 04 ene" {{ old('fecha_preferencia') == 'Martes 30 al domingo 04 ene' ? 'selected' : '' }}>Martes 30 al domingo 04 ene</option>
                    <option value="Viernes 09 al lunes 12 ene" {{ old('fecha_preferencia') == 'Viernes 09 al lunes 12 ene' ? 'selected' : '' }}>Viernes 09 al lunes 12 ene</option>
                    <option value="Viernes 16 al lunes 19 ene" {{ old('fecha_preferencia') == 'Viernes 16 al lunes 19 ene' ? 'selected' : '' }}>Viernes 16 al lunes 19 ene</option>
                    <option value="Viernes 23 al lunes 26 ene" {{ old('fecha_preferencia') == 'Viernes 23 al lunes 26 ene' ? 'selected' : '' }}>Viernes 23 al lunes 26 ene</option>
                    <option value="Viernes 30 ene al lunes 02 feb" {{ old('fecha_preferencia') == 'Viernes 30 ene al lunes 02 feb' ? 'selected' : '' }}>Viernes 30 ene al lunes 02 feb</option>
                </select>
                @error('fecha_preferencia')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="tipo_bungalow">¿Qué opción de bungalow prefiere? <span class="required">*</span></label>
                <select
                    id="tipo_bungalow"
                    name="tipo_bungalow"
                    class="@error('tipo_bungalow') error @enderror"
                    required
                >
                    <option value="">Seleccione un tipo...</option>
                    <option value="6_personas" {{ old('tipo_bungalow') == '6_personas' ? 'selected' : '' }}>Bungalow para seis (6) personas</option>
                    <option value="9_personas" {{ old('tipo_bungalow') == '9_personas' ? 'selected' : '' }}>Bungalow para nueve (9) personas</option>
                </select>
                @error('tipo_bungalow')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-submit">
                Enviar Inscripción
            </button>
        </form>
    </div>

    <script>
        // Validación en tiempo real
        document.getElementById('registroForm').addEventListener('submit', function(e) {
            const btn = this.querySelector('.btn-submit');
            btn.disabled = true;
            btn.textContent = 'Procesando...';
        });

        // Remover clase de error al escribir
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('input', function() {
                this.classList.remove('error');
                const errorMsg = this.parentElement.querySelector('.error-message');
                if (errorMsg) {
                    errorMsg.remove();
                }
            });
        });
    </script>
</body>
</html>
