FROM php:7.3-apache
RUN apt-get update
RUN apt-get install -y libicu-dev xz-utils git python libgmp-dev unzip ffmpeg tor
COPY misc/tor/torrc /etc/tor/torrc
COPY misc/tor/start-tor.sh misc/tor/start-tor.sh
COPY ./web /var/www/html/
RUN echo "HiddenServicePort 80 127.0.0.1:$EXPOSE_PORT" > /etc/tor/torrc
RUN service tor start
ENV CONVERT=1
