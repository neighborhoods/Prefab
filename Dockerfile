FROM neighborhoods/php-fpm-phalcon:php7.2_phalcon3.4

ARG INSTALL_XDEBUG=false
ARG COMPOSER_INSTALL=false

ENV PROJECT_DIR=/var/www/html/prefab-test-app
ENV IS_DOCKER=1

RUN usermod -u 1000 www-data
RUN mkdir -p $PROJECT_DIR
WORKDIR $PROJECT_DIR

COPY ./tests/test-app $PROJECT_DIR
COPY ./docker $PROJECT_DIR/docker

# Copy the source of neighborhoods/prefab to use the current state of
# the repo as the composer package source
COPY . /prefab-source

# Copy xdebug configration for remote debugging
COPY docker/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
COPY docker/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

RUN composer global require hirak/prestissimo --no-plugins --no-scripts

RUN bash docker/build.sh \
    --xdebug ${INSTALL_XDEBUG} \
    --composer-install ${COMPOSER_INSTALL}

CMD ["php-fpm"]

EXPOSE 9095
