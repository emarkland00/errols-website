FROM php:7.0-apache

# install php-memcached client
RUN apt-get -y update && apt-get -y install libz-dev libmemcached-dev
RUN pecl install memcached && echo 'extension = memcached.so' > /usr/local/etc/php/conf.d/memcached.ini

# copy site
COPY src/ /var/www/html
# remove .htaccess file (running this behind nginx reverse-proxy)
RUN rm /var/www/html/.htaccess

# Add config file (comment out whole block to run without config)
COPY config.json /etc/config/config.json
RUN chmod 400 /etc/config/config.json
RUN chown www-data:www-data /etc/config/config.json
ENV SITE=/etc/config/config.json
