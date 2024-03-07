# MessageBird bridge for laravel 

A quickly built Laravel bridge for the `messagebird/php-rest-api` package.

## Install

``` bash
composer require droxnl/messagebird
```

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
