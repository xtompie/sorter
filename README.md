# Sorter

Sort multidimensional array by multiple criteria like array values, object properties, any deep value.

## Installation

```bash
composer require xtompie/sorter
```

## Usage

```php
<?php

require 'vendor/autoload.php';

use Xtompie\Sorter\Sort;
use Xtompie\Sorter\Sorter;

print_r(
    (new Sorter())(
        [
            Sort::ofKey('city'),
            Sort::ofKey('street', SORT_DESC),
            Sort::of(fn($i) => $i['meta']->priority),
        ],
        [
            ['city' => 'Warszawa', 'street' => 'Lea', 'meta' => (object)['priority' => '5']],
            ['city' => 'Krakow', 'street' => 'Lea', 'meta' => (object)['priority' => '10']],
            ['city' => 'Krakow', 'street' => 'Krolewska', 'meta' => (object)['priority' => '10']],
            ['city' => 'Krakow', 'street' => 'Lea', 'meta' => (object)['priority' => '5']],
        ],
    )
);

```
