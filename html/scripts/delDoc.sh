#!/bin/bash

#script que copia documentos!


#verifica se o arquivo existe e o apaga

find "$1" \( -name "*.pdf" -o -name "*.txt" -o -name "*.doc" -o -name "*.docx" -o -name "*.xls" -o -name "*.xlsx" -o -name "*.rtf" -o -name "*.odt" -o -name "*.ods" -o -name "*.ppt" -o -name "*.pptx" -o -name "*.odp" \) -exec rm {}  \; 2> /tmp/error.log
