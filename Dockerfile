FROM php:7.1-apache
MAINTAINER @raulneis <raulneis@gmail.com>

ENV PATH="./vendor/bin:${PATH}"
ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update \
    && apt-get -y --no-install-recommends install \
               build-essential \
               procps \
               cron \
               git \
               gnupg \
               # supervisor \
               libpq-dev \
               libfreetype6-dev \
               libjpeg-dev \
               libmcrypt-dev \
               libpng-dev \
               libxml2-dev \
               nano \
               mysql-client \
               # libxext6 \
               # libmcrypt-dev libreadline-dev \
               # ssh \
               # rsync \
               unzip \
    && apt-get -y autoremove

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN  docker-php-ext-install exif  \
                            gd \
                            intl \
                            bcmath \
                            mcrypt \
                            opcache \
                            pdo \
                            pdo_pgsql \
                            pdo_mysql \
                            xml \
                            zip \
    && docker-php-ext-configure gd \
                                --enable-gd-native-ttf \
                                --with-freetype-dir=/usr/include/freetype2 \
                                --with-png-dir=/usr/include \
                                --with-jpeg-dir=/usr/include \
    && docker-php-ext-install gd

COPY docker/php.ini /usr/local/etc/php/php.ini

WORKDIR /var/www/html
RUN a2enmod rewrite headers
RUN usermod -u 1000 www-data

RUN chown www-data:www-data /var/www -R

EXPOSE 80

ENV APACHE_RUN_USER    www-data
ENV APACHE_RUN_GROUP   www-data
ENV APACHE_PID_FILE    /var/run/apache2.pid
ENV APACHE_RUN_DIR     /var/run/apache2
ENV APACHE_LOCK_DIR    /var/lock/apache2
ENV APACHE_LOG_DIR     /var/log/apache2


COPY docker/start /usr/local/bin/start
RUN chmod +x /usr/local/bin/start

CMD "/usr/sbin/apache2ctl" "-D" "FOREGROUND"
ENTRYPOINT ["/usr/local/bin/start"]
