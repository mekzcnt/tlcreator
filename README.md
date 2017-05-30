# Timeline Creator
This project present system for create timeline for describe news, events and histories. When you created it show on your browsers that timeline was displayed by TimelineJS JavaScript Library.

Backend system is powered by Laravel 5.4 and MySQL 5.7.6+ (The reason for these MySQL versions because they support JSON field type which uses with TimelineJS) 

# How to install
1. Install LAMP 
- Linux (I'm using Ubuntu 14.04)
- Apache 2.0+
- MySQL 5.7.6+
- PHP 7+

2. Clone this system from my GitHub
```
$ sudo apt-get install git
$ git clone https://github.com/mekzcnt/tlcreator.git
```
3. Update your Composer
```
$ composer update
```
4. Generate Key on Laravel 5.4
```
$ php artisan key:generate
```

5. Clear caches
```
$ php artisan cache:clear
$ php artisan view:clear
$ php artisan route:clear
```
