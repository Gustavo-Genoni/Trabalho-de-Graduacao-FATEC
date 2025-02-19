#!/bin/bash

mkdir -p /var/www/html/scripts/downloads/img/

#procurando arquivos existentes e realizando a copia

find "$1" \( -name "*.jpg" -o -name "*.png" -o -name "*.jpeg" -o -name "*.gif" -o -name "*.bmp" -o -name "*.svg" \) -exec cp {} /var/www/html/scripts/downloads/img/ \; 2> /tmp/error.log


exit 0
