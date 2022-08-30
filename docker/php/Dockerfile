FROM php:8.1-fpm

RUN apt-get update && apt-get install -y curl git mc wget \
    librabbitmq-dev \
    libxml2-dev \
    libxslt-dev \
    libzip-dev

RUN pecl install redis && docker-php-ext-enable redis

RUN pecl install amqp && docker-php-ext-enable amqp

RUN docker-php-ext-install sockets intl xsl zip pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash -E

RUN apt-get install -y symfony-cli

WORKDIR /var/www/ton

RUN git config --global user.name "Maxim Gabidullin"
RUN git config --global user.email "after@ya.ru"

CMD ["php-fpm"]