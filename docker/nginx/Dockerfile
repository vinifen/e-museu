FROM nginx:1.29.1-alpine3.22-perl AS web

WORKDIR /var/www

COPY default.conf /etc/nginx/conf.d/default.conf
COPY --from=app /var/www/public ./public