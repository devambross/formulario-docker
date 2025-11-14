# Usar imagen oficial de PHP con FPM
FROM php:8.2-fpm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nginx

# Limpiar caché
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar extensiones de PHP necesarias para Laravel
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos de configuración de nginx
COPY nginx.conf /etc/nginx/sites-available/default

# Crear usuario para la aplicación Laravel
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copiar archivos de la aplicación
COPY --chown=www:www . /var/www/html

# Cambiar al usuario www
USER www

# Exponer puerto 8000
EXPOSE 8000

# Iniciar PHP-FPM y Nginx
CMD ["php-fpm"]
