#!/usr/bin/env bash

a2dismod mpm_event
sed -i "s/Listen 8080/Listen ${PORT:-8080}/g" /etc/apache2/ports.conf
apache2-foreground "$@"
