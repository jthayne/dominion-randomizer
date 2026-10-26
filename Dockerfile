FROM webdevops/php-apache-dev:8.5

RUN apt update && apt upgrade -y

# Install composer
COPY --from=composer/composer:2.8.10-bin /composer /usr/local/bin/composer

RUN echo "Copying conf file"
COPY ./docker/php/dev.apache.conf /etc/apache2/sites-available/dominion.conf

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
RUN a2ensite dominion

RUN echo "Done"
