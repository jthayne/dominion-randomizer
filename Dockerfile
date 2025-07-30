FROM webdevops/php-apache-dev:8.4

RUN apt update && apt upgrade -y

RUN echo "Copying conf file"
COPY ./docker/php/dev.apache.conf /etc/apache2/sites-available/dominion.conf

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
RUN a2ensite dominion

RUN echo "Done"
