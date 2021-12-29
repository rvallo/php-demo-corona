FROM ubuntu:20.04

EXPOSE 80

RUN \
    apt-get update && \
    DEBIAN_FRONTEND=noninteractive apt-get install -y apache2 php7.2 php-mysql php-curl libapache2-mod-php ca-certificates wget && \
    rm -rf /var/lib/apt/lists/* /var/www/html/index.html

CMD /usr/sbin/apache2ctl -D FOREGROUND
