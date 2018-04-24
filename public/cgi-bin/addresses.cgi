#!/bin/bash

sudo arp-scan -l | awk -F'\t' '$2 ~ /([0-9a-f][0-9a-f]:){5}/ {print $1, $2, $3}' > /var/www/RovEverywhere/storage/addresses.txt

