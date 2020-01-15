FROM nginx:latest

ADD ./docker/nginx.conf /etc/nginx/conf.d/skeleton.conf

CMD ["nginx", "-g", "daemon off;"]