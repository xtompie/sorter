# Sorter

Sort multidimensional array by multiple criteria like columns, keys, any deep value

## Installation

```bash
composer require xtompie/sorter
```

## Usage

```php
<?php

require 'vendor/autoload.php';

use Xtompie\Sorter\Sorter;

print_r(
    Sorter::new()
        ->asc("city")
        ->asc("street")
        ->asc(fn($i) => $i['meta']->priority)
        ->desc(fn($i, $k) => $k)
        ->sort([
            'a' => ['city' => 'Warszawa', 'street' => 'Lea', 'meta' => (object)['priority' => '5']],
            'b' => ['city' => 'Krakow', 'street' => 'Lea', 'meta' => (object)['priority' => '10']],
            'c' => ['city' => 'Krakow', 'street' => 'Krolewska', 'meta' => (object)['priority' => '10']],
            'd' => ['city' => 'Krakow', 'street' => 'Lea', 'meta' => (object)['priority' => '10']],
        ])
);
```
