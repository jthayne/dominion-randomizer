FROM webdevops/php-apache:8.3

RUN apt update && apt upgrade -y

RUN echo "Done"
