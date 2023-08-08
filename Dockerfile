FROM webdevops/php-apache:8.2

RUN apt update && apt upgrade -y

RUN echo "Done"
