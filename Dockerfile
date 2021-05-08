FROM registry.cn-chengdu.aliyuncs.com/happyceclear/composer-base-image:2.0.7 as composer

FROM registry.cn-chengdu.aliyuncs.com/happyceclear/php_base_image:latest

WORKDIR /www/web/shop

COPY  . /www/web/shop
#COPY . .
COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY error.ini /usr/local/etc/php/conf.d
RUN composer config -g repo.packagist composer https://mirrors.aliyun.com/composer/ \
    && composer install \
    && chmod -R 777 storage \
    && cp .env.example .env \
    && php artisan key:generate
EXPOSE 9000
