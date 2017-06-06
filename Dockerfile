FROM php:5-apache
RUN apt-get update && apt-get install -y \
    unzip \
    --no-install-recommends && rm -r /var/lib/apt/lists/*
ADD https://github.com/j84/99ko/archive/master.zip /tmp/master.zip
RUN unzip /tmp/master.zip -d /tmp/ \
    && mv /tmp/99ko-master/* /var/www/html/ \
    && rm -rf /tmp/master.zip /tmp/99ko-master
COPY config/php.ini /usr/local/etc/php/
RUN mkdir /var/www/html/data
RUN chown -R www-data:www-data /var/www/html
VOLUME ["/var/www/html/data", "/var/www/html/plugin", "/var/www/html/theme"]
