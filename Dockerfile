FROM navidonskis/nginx-php7.1

ARG DOCUMENTATION_NAME[='*.php']
ARG DOCUMENTATION_EXCLUDES[='']
ARG DOCUMENTATION_DIR[='/var/project']
ARG DOCUMENTATION_THEME[='']
ARG DOCUMENTATION_BUILD_DIR[='/var/www']
ARG DOCUMENTATION_CACHE_DIR[='/tmp']
ARG DOCUMENTATION_GITHUB[='']
ARG DOCUMENTATION_OPENED_LEVEL[=2]

RUN mkdir /sami

ADD files/composer.json /sami/composer.json
ADD files/composer.lock /sami/composer.lock
ADD files/sami.config.php /sami/sami.config.php

RUN cd /sami && curl -O http://get.sensiolabs.org/sami.phar

RUN ls -l /sami

RUN composer install -d /sami

RUN php /sami/sami.phar update /sami/sami.config.php -v

EXPOSE 80

WORKDIR /var/www
