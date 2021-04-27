<?php

require 'vendor/autoload.php';

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