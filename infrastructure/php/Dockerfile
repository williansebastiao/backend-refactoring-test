FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip


COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN groupadd -g 1000 upd8 && \
    useradd -u 1000 -g upd8 -m -s /bin/bash upd8

WORKDIR /var/www

COPY . /var/www

RUN chown -R upd8:upd8 /var/www

USER upd8

EXPOSE 9000
CMD ["php-fpm"]
