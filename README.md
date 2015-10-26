# upperscore
General functions for PHP

## Installation

```sh
$ composer require pisc/upperscore
```

## How to use:

PHP version >= 5.6

```php
use function pisc\upperscore\arrayFlatten;

$flat = arrayFlatten([ 'cow', [ 'bear', ['bunny', 'santa' ], 'rabbit' ]]);
```

PHP version < 5.6

```php
use pisc\upperscore as u;

$flat = u\arrayFlatten([ 'cow', [ 'bear', ['bunny', 'santa' ], 'rabbit' ]]);
```

## Run tests
```sh
$ ./phpunit.sh
```
