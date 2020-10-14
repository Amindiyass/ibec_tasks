!!Neccessary!!
You have to add this lines of code to crontab-e 

* * * * * ( /usr/bin/wget php /var/www/ibec_task/artisan schedule:run 1>> /dev/null 2>&1 )
* * * * * ( sleep 10 ; php /var/www/ibec_task/artisan yard:sheep_add 1>> /dev/null 2>&1 )
* * * * * ( sleep 20 ; php /var/www/ibec_task/artisan yard:sheep_add 1>> /dev/null 2>&1 )
* * * * * ( sleep 30 ; php /var/www/ibec_task/artisan yard:sheep_add 1>> /dev/null 2>&1 )
* * * * * ( sleep 40 ; php /var/www/ibec_task/artisan yard:sheep_add 1>> /dev/null 2>&1 )
* * * * * ( sleep 50 ; php /var/www/ibec_task/artisan yard:sheep_add 1>> /dev/null 2>&1 )
* * * * * ( sleep 60 ; php /var/www/ibec_task/artisan yard:sheep_add 1>> /dev/null 2>&1 )
