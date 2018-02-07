FROM navidonskis/nginx-php7.1

ARG DOCUMENTATION_NAME[='*.php']
ARG DOCUMENTATION_EXCLUDES[='']
ARG DOCUMENTATION_DIR[='/var/project']
ARG DOCUMENTATION_THEME[='']
ARG DOCUMENTATION_BUILD_DIR[='/var/www']
ARG DOCUMENTATION_CACHE_DIR[='/tmp']
ARG DOCUMENTATION_GITHUB[=false]
ARG DOCUMENTATION_OPENED_LEVEL[=2]

RUN mkdir /sami

ADD files/sami.config.php /sami/sami.config.php
ADD files/.bash_profile /root/.bash_profile

RUN echo 'source /etc/profile' >> /root/.bashrc
RUN echo 'source /root/.bash_profile' >> /root/.bashrc

RUN cd /sami && curl -O http://get.sensiolabs.org/sami.phar

RUN ls -l /sami

RUN updatedocs

EXPOSE 80

WORKDIR /var/www
