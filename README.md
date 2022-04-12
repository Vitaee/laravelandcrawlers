# PHP Crawler Example
php web crawler examples with oop concept to understand logic and syntax of php language.

# Project Setup
- Ensure you have installed the latest version of PHP.
- Go to this link [Composer](https://getcomposer.org/) to set up a composer that we will use to install the various PHP dependencies for the web scraping libraries.
- Run the following two commands to init composer.json file. 
```
composer init -require"php >=8.0" --no-interaction
composer update
```
- In this project we are using ```fabpot/goutte``` and ```masterminds/html5``` run following commands to install this libraries.

```
composer require fabpot/goutte
composer require masterminds/html5
```
- Finally you can run our simple script called ```firstcrawler.php``` with this command.
```
php firstcrawler.php
```