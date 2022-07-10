FROM php:8.1-apache
RUN apt-get update --fix-missing
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && install-php-extensions pdo pdo_mysql pdo_pgsql intl zip
RUN curl -sSk https://getcomposer.org/installer | php -- --disable-tls && mv composer.phar /usr/local/bin/composer
COPY . /var/www/
COPY ./docker/apache.conf /etc/apache2/sites-available/000-default.conf
COPY ./docker/wait-for-it.sh /wait-for-it.sh
RUN chmod +x /wait-for-it.sh
WORKDIR /var/www/
RUN cd /var/www/
RUN composer require symfony/runtime
RUN composer install
ENTRYPOINT ["bash", "./docker/docker.sh"]
EXPOSE 80