# syntax=docker/dockerfile:1
FROM ubuntu:latest
ARG DEBIAN_FRONTEND=noninteractive

# ====[ DEPENDENCIES ]====
# Settings for tzdata - https://serverfault.com/questions/949991/how-to-install-tzdata-on-a-ubuntu-docker-image
ENV TZ=Europe/Rome
RUN apt update
# Install Web Server: Apache
RUN apt install apache2 -y
# Install PHP and PHP Support for Apache, and other extensions (php-mysql)
RUN apt install php libapache2-mod-php php-bcmath php-curl php-imagick php-intl php-json php-mbstring php-mysql php-xml php-zip -y
# Install database MySQL - NO-THREE TIER ARCHITECTURE
#RUN apt install mysql-server -y
# Install PhpMyAdmin


# ====[ SET UP WORDPRESS ]====
RUN mkdir -p /srv/wordpress
#COPY ./ftws /srv/wordpress
COPY wordpress-vhost.conf /etc/apache2/sites-available/wordpress.conf

RUN a2ensite wordpress
RUN chown -R www-data:www-data /srv/wordpress

RUN a2dissite 000-default

# ====[ RUN SERVICES ]====
# Run Apache Web Server - https://stackoverflow.com/questions/49764989/cannot-start-apache-automatically-with-docker
CMD ["/usr/sbin/apachectl", "-D", "FOREGROUND"]


