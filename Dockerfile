FROM php:5.6-apache
RUN apt-get update
RUN apt-get install -y libicu-dev xz-utils git python libgmp-dev unzip ffmpeg tor
COPY misc/tor/torrc /etc/tor/torrc
COPY misc/tor/start-tor.sh misc/tor/start-tor.sh
COPY ./web /var/www/html/
RUN echo "HiddenServicePort 80 127.0.0.1:$EXPOSE_PORT" > /etc/tor/torrc
CMD service tor start
