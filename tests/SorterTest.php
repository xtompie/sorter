<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Xtompie\Sorter\Sort;
use Xtompie\Sorter\Sorter;

class SorterTest extends TestCase
{
    public function testCombine()
    {
        // given
        $sorts = [
            Sort::ofKey('city'),
            Sort::ofKey('street', SORT_DESC),
            Sort::of(fn($i) => $i['meta']->priority),
        ];
        $data = [
            ['city' => 'Warszawa', 'street' => 'Lea', 'meta' => (object)['priority' => '5']],
            ['city' => 'Krakow', 'street' => 'Lea', 'meta' => (object)['priority' => '10']],
            ['city' => 'Krakow', 'street' => 'Krolewska', 'meta' => (object)['priority' => '10']],
            ['city' => 'Krakow', 'street' => 'Lea', 'meta' => (object)['priority' => '5']],
        ];

        // when
        $result = (new Sorter())($sorts, $data);

        // then
        $this->assertEquals(
            [
                ['city' => 'Krakow', 'street' => 'Lea', 'meta' => (object)['priority' => '5']],
                ['city' => 'Krakow', 'street' => 'Lea', 'meta' => (object)['priority' => '10']],
                ['city' => 'Krakow', 'street' => 'Krolewska', 'meta' => (object)['priority' => '10']],
                ['city' => 'Warszawa', 'street' => 'Lea', 'meta' => (object)['priority' => '5']],
            ],
            $result
        );
    }
}