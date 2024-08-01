FROM richarvey/nginx-php-fpm:3.1.6

# Install Composer
COPY --from=composer:2.1 /usr/bin/composer /usr/bin/composer

COPY . .

# Install PHP dependencies
RUN composer install

# Run Laravel artisan commands
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

RUN php artisan migrate --force

# Image config
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Laravel config
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

CMD ["/start.sh"]
