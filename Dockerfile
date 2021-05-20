FROM php:7.4-apache

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Set our application folder as an environment variable
ENV APP_HOME /var/www/html

# Set working directory
WORKDIR $APP_HOME

# Use the default production configuration
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Copy over project-specific PHP settings
COPY ./docker-config/php/local.ini /usr/local/etc/php/conf.d/local.ini

# Get NodeJS
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash -

# Install all the system dependencies and enable PHP modules 
RUN apt-get update && apt-get install -y \
      libicu-dev \
      libpq-dev \
      libmcrypt-dev \
      libpng-dev \
      libjpeg62-turbo-dev \
      libfreetype6-dev \
      git \
      libzip-dev \
      zip \
      unzip \
      nodejs \
      build-essential \
      gnupg \
      exiftool \
    && rm -r /var/lib/apt/lists/* \
    && docker-php-ext-configure pdo_mysql \
      --with-pdo-mysql=mysqlnd \
    && docker-php-ext-configure gd \
      --enable-gd \
      --with-freetype=/usr/include/ \
      --with-jpeg=/usr/include/ \
    && docker-php-ext-configure exif \
    && docker-php-ext-install \
      intl \
      pcntl \
      pdo_mysql \
      pdo_pgsql \
      pgsql \
      zip \
      opcache \
      gd \
      exif \
    && docker-php-ext-enable exif \
    && pecl install -o -f redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer


# Change uid and gid of apache to docker user uid/gid
RUN usermod -u $uid $user && groupmod -g $uid $user

# Copy existing application directory + permissions
COPY --chown=www-data:www-data . $APP_HOME

# Change the web_root to laravel /var/www/html/public folder
RUN sed -i -e "s/html/html\/public/g" /etc/apache2/sites-enabled/000-default.conf

# Fix the .env file for production.
RUN mv "$APP_HOME/.env.docker" "$APP_HOME/.env"
#RUN gpg --quiet --batch --yes --decrypt --passphrase="$ENV_PASSPHRASE" \
#--output "$HOME/.env" "$HOME/.github/secrets/.env.gpg"

# Enable apache module rewrite
RUN a2enmod rewrite

# Install dependencies
RUN npm install

# Install all PHP dependencies
RUN composer install --no-interaction

# Run artisan commands to set things up properly
RUN php artisan key:generate
RUN php artisan storage:link

# Optimization for production
RUN composer install --optimize-autoloader --no-dev
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache

# Set the maintainer info metadata
LABEL maintainer="Chris McGee <chris@chrismcgee.info>"

# Expose ports
EXPOSE 80
EXPOSE 443
