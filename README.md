# cli-wall
A Cli-oriented Twitter clone

## Requirements
- `PHP 5x` installed on your machine. You can quickly grab a php vagrant machine [here](http://puphpet.com).
- Install [composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)

### Install
- `git clone` this repository locally  
- run `composer install`

## Run
- run `php scripts/twicli.php`.

## Dev notes
- To run test in the home project folder you should run `vendor/bin/phpunit`
- Composer is a standard PHP tool which both handles project dependencies and classes autoloading. This frees you up from having horrible `require_once` around your code. This project doesn't have any external dependency, no frameworks were used. Running `composer install` will generate autoloading files and will install `phpunit` to run all the tests. If you wish not to install PHPUnit, run instead `composer install --no-dev`.
