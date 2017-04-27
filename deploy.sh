#!/bin/bash
mysql --user=root --password= < ./install.sql
php artisan migrate --seed
