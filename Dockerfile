FROM php:7.0-apache

COPY src/ /var/www/html

# Add config file to site
#COPY config.json /etc/config/config.json

EXPOSE 80
