# KmSchedule - Installation Instructions

## Requirements
**Note:** Other servers should work, I just haven't tested them.
The following is what it's been tested on.
Basically a digitalocean Ubuntu 18.04 droplet

* Apache 2.4.29 
* php 7.2.29-1
* mysql 15.1 Distrib 10.1.44-MariaDB
* node 8.10.0
* npm 8.10.0
* composer 1.10.1
* git 2.17.1

There are many excellent tutorials for installing the above software. Google is your friend.


* Make a directory for your project to live
* `mkdir /var/www/html/kmschedule.com`
* cd into directory
* `cd /var/www/html/kmschedule.com`
* Clone the repository
* `git clone https://github.com/Kolomona/KmSchedule.git /var/www/html/kmschedule.com`
* edit your website.conf file to point it's webroot to the public folder
* `sudo nano /etc/apache2/sites-available/kmschedule.com.conf`
* Set ownership to web user www-data
* `sudo chown -R www-data:www-data public`
* Make sure the DocumentRoot points to the public folder
* `DocumentRoot /var/www/html/kmschedule.com/public/public`
* Make any other edits that makes sense (again Google is your friend)
* enable the site
* `a2ensite kmschedule.com.conf`
* Restart apache
* `sudo systemctl reload apache2`

Now that the site is public begin installing dependencies

* cd into the project root directory
* `cd /var/www/html/kmschedule.com`
* Install Composer Dependencies
* `composer install`
* Install NPM Dependencies
* `npm install`

Database configuration

* log into mysql. There are many ways to do this. I recommend that you create a mysql user that only has access to the kmschedule database (Google it)
* `sudo mysql` or `mysql -u USERNAME -p`
* create a database for your schedules to live
* `CREATE DATABASE kmschedule`
* Exit mysql
* `EXIT;`

The .env file contains site specific configuration unique to your website. There is a sample example file included in the project.

* Make a copy of the .env.example file and simultaneously rename it to .env
* `sudo cp .env.example env.example`
* Edit the .env file to match your website needs
* sudo nano .env
* Edit the APP_name and APP_URL sections
* Examples (**Be sure to change them to match your website**)
* `APP_NAME=KmSchedule`
* `APP_URL=http://kmschedule.com`
* Edit the Database section to **Match your database settings**
* *Example*:
* `DB_CONNECTION=mysql`
* `DB_HOST=127.0.0.1`
* `DB_PORT=3306`
* `DB_DATABASE=laravel`
* `DB_USERNAME=root`
* `DB_PASSWORD=sUP3RsECRETp@SSWORDNo0neWill3verGuess`
* Generate app encryption key
* `php artisan key:generate`

Setup database tables
* Migrate the database
* `php artisan migrate`
* Seed the database (this installs the admin user)
* php artisan db:seed

That should be it. Navigate to your site and login
email is admin@admin.com
password is password.

**Edit the admin user immediately and change the email and password!**






This is a pretty good resource
https://devmarketer.io/learn/setup-laravel-project-cloned-github-com/