#!/bin/sh

rm -r /var/www/html/*
cp -r * /var/www/html
chmod a+w /var/www/html/uploads
mysql < db.sql

