# Uniplanung

A web application for storing exam dates and grades.
<p align="center">
<img width="100%" src="https://github.com/random-access/uniplanung/blob/master/screenshot.png" alt="Screenshot">
</p>


### Requirements
  - PHP >= 5.5.9
  - OpenSSL PHP Extension
  - PDO PHP Extension
  - Mbstring PHP Extension
  - Tokenizer PHP Extension
  - Web server (Apache, Nginx)
  - Database (e.g. MySQL)

### Usage
* Create a virtual host for your app on your web server, e.g. [Apache](https://httpd.apache.org/docs/current/vhosts/examples.html)
* Create a database, e.g. [mysql](https://www.digitalocean.com/community/tutorials/a-basic-mysql-tutorial), for your application data
* Clone this repository to the same level as your webroot (default folder name: uniplanung)
* Copy the whole content of the *public* folder into your webroot directory
* Change paths in index.html as follows: 

  ```php
  require __DIR__.’/../uniplanung/bootstrap/autoload.php’; 
  $app = require_once __DIR__.’/../uniplanung/bootstrap/app.php’;
  ```

* Make the directories *storage* and *bootstrap/cache* writable to others:

  ```bash
  chmod -R o+w storage bootstrap/cache
  ```
  
* [Install composer](https://getcomposer.org/download/), either locally into the application folder or globally
* Copy *.env.example* to *.env* and fill out the parameters inside *.env*
* Install dependencies, clear caches and generate application key 

  ```php
  php composer install
  php composer dumpautoload -o
  php artisan config:cache
  php artisan route:cache
  php artisan key:generate
  ```
* It might be necessary to load the index.php inside the public folder from command line.

### Official Documentation

This app was built with Laravel, a web application framework using PHP. 
Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).
