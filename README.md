# Sorter

PHP array_multisort wrapper with friendly api

## Installation

```bash
composer require xtompie/sorter
```

## Usage

```php
<?php

use Xtompie\Sorter\Sorter;

print_r(
    Sorter::new()
        ->asc(fn($i) => $i['city']->name)
        ->desc('id')
        ->sort([
            ['id' => '1', 'city' => (object)['name' => 'K']],
            ['id' => '2', 'city' => (object)['name' => 'W']],
            ['id' => '3', 'city' => (object)['name' => 'K']],
        ])
);

```