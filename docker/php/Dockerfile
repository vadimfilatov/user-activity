FROM php:8.1-fpm

RUN docker-php-ext-install mysqli

RUN apt-get update && apt-get install -y vim

RUN apt-get update && apt-get install curl

RUN apt-get update && apt-get install -y supervisor

RUN apt-get update && apt-get -y install cron

ENV LIBRDKAFKA_VERSION v1.6.2
ENV BUILD_DEPS \
        build-essential \
        git \
        libsasl2-dev \
        libssl-dev \
        python-is-python3 \
        zlib1g-dev

RUN apt-get update \
    && apt-get install -y --no-install-recommends ${BUILD_DEPS} \
    && cd /tmp \
    && git clone \
        --branch ${LIBRDKAFKA_VERSION} \
        --depth 1 \
        https://github.com/edenhill/librdkafka.git \
    && cd librdkafka \
    && ./configure \
    && make \
    && make install \
    && pecl install rdkafka \
    && docker-php-ext-enable rdkafka \
    && rm -rf /tmp/librdkafka \
    && apt-get purge \
        -y --auto-remove \
        -o APT::AutoRemove::RecommendsImportant=false \
        ${BUILD_DEPS}

RUN apt-get update \
     && apt-get install -y libzip-dev \
     && docker-php-ext-install zip

RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www

CMD ["php-fpm"]