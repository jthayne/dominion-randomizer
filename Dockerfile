FROM webdevops/php-apache-dev:8.3

RUN apt update && apt upgrade -y

RUN echo "Done"
