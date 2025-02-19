#!/bin/bash

#script que copia documentos!


#criando o diretório
mkdir -p /var/www/html/scripts/downloads/docs/

#realizando a cópia
touch /tmp/error.log
find "$1" \( -name "*.pdf" -o -name "*.txt" -o -name "*.doc" -o -name "*.docx" -o -name "*.xls" -o -name "*.xlsx" -o -name "*.rtf" -o -name "*.odt" -o -name "*.ods" -o -name "*.ppt" -o -name "*.pptx" -o -name "*.odp" \) -exec cp {} /var/www/html/scripts/downloads/docs/ \; 2> /tmp/error.log
