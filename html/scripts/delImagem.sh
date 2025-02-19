#!/bin/bash


#procurando arquivos existentes e deleta

find "$1" \( -name "*.jpg" -o -name "*.png" -o -name "*.jpeg" -o -name "*.gif" -o -name "*.bmp" -o -name "*.svg" \) -exec rm {}  \; 2> /tmp/error.log


exit 0
