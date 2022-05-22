<?php

declare(strict_types=1);

namespace Xtompie\Sorter;

class Sorter
{
    /**
     * @param array $data
     * @param Sort[] $sorts
     * @return array
     */
    public function __invoke(array $sorts, array $data): array
    {
        if (!$data) {
            return [];
        }

        $index = [];
        foreach ($data as $data_index => $item) {
            foreach ($sorts as $sort_index => $sort) {
                $index[$sort_index][$data_index] = ($sort->take())($item, $data_index);
            }
        }

        $args = [];
        foreach ($sorts as $sort_index => $sort) {
            $args[] = $index[$sort_index];
            $args[] = $sort->order();
            $args[] = $sort->falgs();
        }
        $args[] = &$data;

        call_user_func_array('array_multisort', $args);

        return $data;
    }
}
