FROM php:7.0-apache

# install memcached
RUN apt-get -y update && apt-get -y install libz-dev libmemcached-dev
RUN pecl install memcached && echo 'extension = memcached.so' > /usr/local/etc/php/conf.d/memcached.ini

COPY src/ /var/www/html

# remove .htaccess file (running this behind nginx reverse-proxy)
RUN rm /var/www/html/.htaccess

# Add config file to site
COPY /etc/config/config.json /etc/config/config.json
COPY config.json /etc/config/config.json
RUN [ -f /etc/config/config.json ] && chmod 400 /etc/config/config.json
ENV SITE=/etc/config/config.json
