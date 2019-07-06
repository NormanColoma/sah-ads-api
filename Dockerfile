FROM php:7.2
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer && pecl install mongodb \
    && touch /usr/local/etc/php/php.ini && echo "extension=mongodb.so" > /usr/local/etc/php/php.ini
COPY . /usr/src/

WORKDIR /usr/src/

EXPOSE 8000
RUN composer install
ENTRYPOINT php bin/console server:run

