FROM php:7.4-fpm

# Instala dependencias del sistema
RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libgd-dev \
    curl \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl gd

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia los archivos del proyecto
WORKDIR /var/www/html
COPY . .

# Da permisos adecuados (opcional si usas usuario específico)
RUN chown -R www-data:www-data /var/www/html

# Exponer el puerto (si aplica)
EXPOSE 9000

CMD ["php-fpm"]
