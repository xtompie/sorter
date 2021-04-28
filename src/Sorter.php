<?php

namespace Xtompie\Sorter;

use Closure;

class Sorter
{
    public static function new(): static
    {
        return new static([]);
    }

    public function asc(string|Closure $field, $flags = SORT_REGULAR): static
    {
        return $this->merge($field, SORT_ASC, $flags);
    }

    public function desc(string|Closure $field, $flags = SORT_REGULAR): static
    {
        return $this->merge($field, SORT_DESC, $flags);
    }

    public function sort(array $data): array
    {
        $index = [];
        foreach ($data as $key => $value) {
            foreach ($this->sortings as $offset => $sorting) {
                $index[$offset][$key] = ($sorting[0])($value, $key);
            }
        }

        $args = [];
        foreach ($this->sortings as $offset => $sorting) {
            $args[] = $index[$offset];
            $args[] = $sorting[1]; // SORT_ASC|SORT_DESC
            $args[] = $sorting[2]; // flags SORT_...
        }
        $args[] = &$data;

        call_user_func_array('array_multisort', $args);     
        
        return $data;
    }

    protected function __construct(
        protected array $sortings
    ) {}

    protected function merge(string|Closure $value, $order, $flags): static
    {
        $add = [
            is_string($value) ? fn($item) => $item[$value] : $value,
            $order,
            $flags
        ];

        return new static(array_merge($this->sortings, [$add]));
    }

}