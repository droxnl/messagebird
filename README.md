# MessageBird bridge for laravel 

A quickly built Laravel bridge for the `messagebird/php-rest-api` package.

## Install

``` bash
composer require droxnl/messagebird
```

## Configuration

``` bash
php artisan vendor:publish
```

Set your `api_key` in `config/messagebird.php`

## Usage

### Get Balance

``` php
Messagebird::getBalance();
```

### Create Message

``` php
Messagebird::createMessage($originator, $recipients = [], $body);
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
