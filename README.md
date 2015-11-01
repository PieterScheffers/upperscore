[![Latest Stable Version](https://img.shields.io/packagist/v/pisc/upperscore.svg?style=flat-square)](https://packagist.org/packages/pisc/upperscore)
[![Build Status](https://travis-ci.org/PieterScheffers/upperscore.svg?branch=master)](https://travis-ci.org/PieterScheffers/upperscore)

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
