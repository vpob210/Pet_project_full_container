# Используем базовый образ Ubuntu need to test FROM php:8.1-apache
FROM ubuntu:latest

# Обновляем индексы пакетов и устанавливаем необходимые пакеты
RUN DEBIAN_FRONTEND=noninteractive
RUN apt-get update && \
    apt-get install -y tzdata && \
    apt-get install -y apache2 php libapache2-mod-php php-fpm php-mysql && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

   
RUN apt-get update && apt-get install -y nginx mysql-server

#Nginx
COPY ./nginx/default.conf /etc/nginx/sites-enabled/default
#RUN echo "" > /etc/nginx/sites-enabled/default

#Mysql
---

RUN a2enmod php8.1
RUN rm -rf /var/www/html/*

COPY ./www /var/www/html
COPY ./apache/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY ./apache/ports.conf /etc/apache2/ports.conf

RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

#EXPOSE 8080
EXPOSE 80
EXPOSE 443
#EXPOSE 3306

# Запускаем Apache в foreground режиме
CMD service nginx start && service mysql start \
    && mysql -e "CREATE DATABASE todo_app;" \
    && mysql -e "CREATE USER 'todo_user'@'%' IDENTIFIED BY 'vpob';" \
    && mysql -e "GRANT ALL PRIVILEGES ON todo_app.* TO 'todo_user'@'%';" \
    && mysql -e "FLUSH PRIVILEGES;" \
    && apache2ctl -D FOREGROUND
