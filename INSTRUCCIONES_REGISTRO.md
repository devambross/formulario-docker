# Configuración del Sistema de Registro

### 📋 Campos del Formulario
- Código de Socio (único)
- Nombres
- Apellidos
- Correo Electrónico (único)
- Teléfono
- Edad

### ✨ Funcionalidades Implementadas

1. **Validación de Datos**
   - Validación en el servidor de todos los campos
   - Prevención de registros duplicados por código de socio o correo
   - Mensajes de error personalizados en español
   - Validación de formato de correo electrónico

2. **Base de Datos**
   - Tabla `registros` con todos los campos requeridos
   - Índices únicos en `codigo_socio` y `correo`
   - Registro automático de fecha y hora

3. **Envío de Correos**
   - Email de confirmación automático
   - Template HTML profesional con los datos del registro
   - Fecha y hora de registro incluidas
   - Mensaje de agradecimiento

4. **Interfaz de Usuario**
   - Diseño moderno y responsivo
   - Validación visual de errores
   - Mensaje de éxito al registrarse
   - Experiencia de usuario optimizada

## 🔧 Configuración Requerida

### 1. Configurar el Envío de Correos

Edita el archivo `.env` y configura uno de estos servicios:

#### Opción A: Gmail (Recomendado para pruebas)

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=tu-correo@gmail.com
MAIL_PASSWORD=tu-app-password-aqui
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="tu-correo@gmail.com"
MAIL_FROM_NAME="Sistema de Registro"
```

**Pasos para obtener App Password de Gmail:**
1. Ve a tu cuenta de Google → Seguridad
2. Activa la verificación en 2 pasos
3. Ve a "Contraseñas de aplicaciones"
4. Genera una contraseña para "Correo"
5. Usa esa contraseña de 16 caracteres en `MAIL_PASSWORD`

#### Opción B: Mailtrap (Recomendado para desarrollo)

Mailtrap captura todos los emails sin enviarlos realmente. Perfecto para pruebas.

```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=tu-username-mailtrap
MAIL_PASSWORD=tu-password-mailtrap
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@tudominio.com"
MAIL_FROM_NAME="Sistema de Registro"
```

**Pasos detallados para configurar Mailtrap:**

1. **Crear cuenta:**
   - Ve a https://mailtrap.io
   - Haz clic en "Sign Up" 
   - Regístrate con Google, GitHub o email
   - Confirma tu cuenta

2. **Obtener credenciales SMTP:**
   - En el dashboard, ve a "My Inbox" o "Email Testing"
   - Haz clic en tu inbox (por defecto "Demo inbox")
   - Ve a la pestaña "SMTP Settings" o "Integration"
   - En el dropdown, selecciona "Laravel 9+"
   - Copia las credenciales mostradas:
     * Host: `sandbox.smtp.mailtrap.io`
     * Port: `2525`
     * Username: (tu código único)
     * Password: (tu contraseña única)

3. **Configurar en Laravel:**
   - Pega las credenciales en tu archivo `.env`
   - Ejecuta: `docker-compose exec app php artisan config:clear`

4. **Probar:**
   - Completa el formulario en http://localhost:8888
   - Ve a Mailtrap y verás el email recibido
   - Haz clic en el email para ver el HTML completo

**Ventajas de Mailtrap:**
- ✅ No envía correos reales (seguro para desarrollo)
- ✅ Ver HTML y texto plano
- ✅ Validar spam score
- ✅ Plan gratuito: 500 emails/mes
- ✅ Compartir emails con el equipo

#### Opción C: Log (Solo para pruebas sin envío real)

```env
MAIL_MAILER=log
```
Los correos se guardarán en `storage/logs/laravel.log`

### 2. Verificar Configuración de Base de Datos

El archivo `.env` ya está configurado con:

```env
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=laravel
```

## 🚀 Cómo Usar

1. **Accede al formulario:**
   - Abre tu navegador en: http://localhost:8888

2. **Completa el formulario** con los datos requeridos

3. **Al enviar:**
   - Se valida que el código de socio y correo no existan
   - Se guarda en la base de datos
   - Se envía correo de confirmación
   - Se muestra mensaje de éxito

## 🧪 Probar el Sistema

```powershell
# Ver logs en tiempo real
docker-compose exec app tail -f storage/logs/laravel.log

# Limpiar caché si hay cambios
docker-compose exec app php artisan config:clear
docker-compose exec app php artisan cache:clear

# Ver registros en la base de datos
docker-compose exec app php artisan tinker
# Luego ejecutar: App\Models\Registro::all()
```

## 🔄 Cómo Funciona el Sistema

### Flujo Completo del Proceso:

1. **Usuario accede** → http://localhost:8888
2. **Completa formulario** con todos los datos
3. **Envía el formulario** → POST a `/registro`
4. **Laravel valida:**
   - Verifica formato de datos
   - Chequea que `codigo_socio` no exista
   - Chequea que `correo` no exista
5. **Si es válido:**
   - Guarda en tabla `registros`
   - Envía email de confirmación
   - Muestra mensaje de éxito
6. **Si hay errores:**
   - Muestra mensajes específicos
   - Mantiene los datos ingresados

## 🗄️ Acceder a la Base de Datos

### Opción 1: PhpMyAdmin (MÁS FÁCIL - Interfaz Web)

**URL:** http://localhost:8081

**Credenciales:**
- Servidor: `db`
- Usuario: `laravel`
- Contraseña: `laravel`

**Pasos:**
1. Abre http://localhost:8081 en tu navegador
2. Ingresa las credenciales
3. Haz clic en la base de datos `laravel`
4. Haz clic en la tabla `registros`
5. ¡Verás todos los registros!

### Opción 2: Línea de Comandos (MySQL CLI)

```powershell
# Conectarse al contenedor MySQL
docker-compose exec db mysql -u laravel -p laravel

# Contraseña: laravel

# Ejecutar consultas:
SELECT * FROM registros;
SELECT COUNT(*) FROM registros;
SELECT * FROM registros ORDER BY created_at DESC LIMIT 5;
```

### Opción 3: Artisan Tinker (Desde Laravel)

```powershell
docker-compose exec app php artisan tinker

# Ver todos los registros
App\Models\Registro::all();

# Buscar por correo
App\Models\Registro::where('correo', 'ejemplo@correo.com')->first();

# Contar registros
App\Models\Registro::count();

# Ver últimos 5
App\Models\Registro::latest()->take(5)->get();
```

### Opción 4: MySQL Workbench / DBeaver / Otros Clientes

**Configuración:**
- Host: `localhost`
- Puerto: `3307`
- Usuario: `laravel`
- Contraseña: `laravel`
- Base de datos: `laravel`

## 📊 Estructura de la Tabla `registros`

```
registros
├── id                (int, autoincremental, primary key)
├── codigo_socio      (string, único, índice)
├── nombres           (string)
├── apellidos         (string)
├── correo            (string, único, índice)
├── telefono          (string)
├── edad              (integer)
├── fecha_registro    (timestamp, automático)
├── created_at        (timestamp)
└── updated_at        (timestamp)
```

## 🔍 Consultas SQL Útiles

```sql
-- Ver todos los registros
SELECT * FROM registros;

-- Ver solo nombres y correos
SELECT nombres, apellidos, correo FROM registros;

-- Buscar por código de socio
SELECT * FROM registros WHERE codigo_socio = 'SOC-12345';

-- Ver registros de hoy
SELECT * FROM registros WHERE DATE(created_at) = CURDATE();

-- Contar total de registros
SELECT COUNT(*) as total FROM registros;

-- Ver los 10 más recientes
SELECT * FROM registros ORDER BY created_at DESC LIMIT 10;

-- Edad promedio de registrados
SELECT AVG(edad) as edad_promedio FROM registros;

-- Eliminar un registro específico (CUIDADO)
DELETE FROM registros WHERE id = 1;

-- Vaciar toda la tabla (¡MUCHO CUIDADO!)
TRUNCATE TABLE registros;
```

## 🔍 Estructura de Archivos Creados

```
app/
├── Http/Controllers/
│   └── RegistroController.php        # Controlador principal
├── Mail/
│   └── RegistroConfirmacion.php      # Clase de correo
└── Models/
    └── Registro.php                   # Modelo de datos

database/migrations/
└── 2025_11_13_154944_create_registros_table.php

resources/views/
├── registro/
│   └── index.blade.php               # Formulario de registro
└── emails/
    └── registro-confirmacion.blade.php   # Template de email

routes/
└── web.php                            # Rutas configuradas
```

## 📝 Comandos Útiles

```powershell
# Ver todos los registros
docker-compose exec app php artisan tinker
>>> App\Models\Registro::all();

# Limpiar todos los registros (cuidado en producción)
>>> App\Models\Registro::truncate();

# Probar envío de correo manualmente
docker-compose exec app php artisan tinker
>>> $registro = App\Models\Registro::first();
>>> Mail::to('test@test.com')->send(new App\Mail\RegistroConfirmacion($registro));
```

## 🐛 Solución de Problemas

### Error: "Table 'laravel.sessions' doesn't exist"
```powershell
docker-compose exec app php artisan migrate
docker-compose exec app php artisan config:clear
```

### Los correos no se envían con Mailtrap
```powershell
# Verificar configuración
docker-compose exec app php artisan config:show mail

# Limpiar caché
docker-compose exec app php artisan config:clear

# Ver logs
docker-compose exec app tail -f storage/logs/laravel.log
```

### Error de conexión SMTP
- Verifica que `MAIL_HOST` sea exactamente: `sandbox.smtp.mailtrap.io`
- Puerto debe ser `2525`
- Revisa username y password sin espacios extras

### El formulario no muestra errores
```powershell
# Limpiar caché de vistas
docker-compose exec app php artisan view:clear
docker-compose exec app php artisan config:clear
```

### Error: "Connection refused" en base de datos
- Verifica que los contenedores estén corriendo: `docker-compose ps`
- Reinicia los contenedores: `docker-compose restart`

## 🔐 Credenciales del Sistema

### Base de Datos MySQL
- **Host:** `db` (interno) / `localhost:3307` (externo)
- **Base de datos:** `laravel`
- **Usuario:** `laravel`
- **Contraseña:** `laravel`
- **Root password:** `root`

### PhpMyAdmin
- **URL:** http://localhost:8081
- **Usuario:** `laravel` o `root`
- **Contraseña:** `laravel` o `root`

### Aplicación
- **URL:** http://localhost:8888
- **Puerto Nginx:** 8888
- **Puerto MySQL:** 3307 (externo)

## ⚠️ Importante

1. **Configura el correo** antes de probar el sistema completamente
2. Para producción, usa un servicio SMTP confiable (no Mailtrap)
3. Los correos con `MAIL_MAILER=log` solo se guardan en logs, no se envían
4. Revisa `storage/logs/laravel.log` para depurar errores
5. Mailtrap es solo para desarrollo, no para producción
6. Haz backups regulares de la base de datos en producción

## 📚 Recursos Adicionales

- **Laravel Docs:** https://laravel.com/docs
- **Mailtrap:** https://mailtrap.io
- **MySQL Docs:** https://dev.mysql.com/doc/
- **PhpMyAdmin:** https://www.phpmyadmin.net/

## 🎉 ¡Sistema Listo!

El sistema está completamente funcional:
1. ✅ Formulario de registro con validación
2. ✅ Base de datos MySQL configurada
3. ✅ Prevención de duplicados
4. ✅ Email de confirmación
5. ✅ PhpMyAdmin para administración

**Próximos pasos:**
1. Configura las credenciales de correo en `.env`
2. Prueba el formulario en http://localhost:8888
3. Verifica los registros en http://localhost:8081
