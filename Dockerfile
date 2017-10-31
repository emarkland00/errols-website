FROM php:7.0-apache

# install memcached
RUN apt-get -y update && apt-get -y install libz-dev libmemcached-dev
RUN pecl install memcached && echo 'extension = memcached.so' > /usr/local/etc/php/conf.d/memcached.ini

COPY src/ /var/www/html

# Add config file to site
COPY config.json /etc/config/config.json
ENV SITE=/etc/config/config.json

EXPOSE 80
