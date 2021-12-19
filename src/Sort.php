<?php

declare(strict_types=1);

namespace Xtompie\Sorter;

class Sort
{
    public static function of(callable $take, int $order = SORT_ASC, int $flags = SORT_REGULAR): static
    {
        return new static($take, $order, $flags);
    }

    public static function ofKey(string $key, int $order = SORT_ASC, int $flags = SORT_REGULAR): static
    {
        return static::of(fn(array $item) => $item[$key], $order, $flags);
    }

    public static function ofIndex(int $index, int $order = SORT_ASC, int $flags = SORT_REGULAR): static
    {
        return static::of(fn(array $item) => $item[$index], $order, $flags);
    }

    public static function ofProperty(string $property, int $order = SORT_ASC, int $flags = SORT_REGULAR): static
    {
        return static::of(fn(object $item) => $item->$property, $order, $flags);
    }

    public static function ofMethod(string $method, int $order = SORT_ASC, int $flags = SORT_REGULAR): static
    {
        return static::of(fn(object $item) => $item->$method(), $order, $flags);
    }

    public function __construct(
        protected $take,
        protected int $order,
        protected int $flags,
    ) {}

    public function take(): callable
    {
        return $this->take;
    }

    public function withTake(callable $take): static
    {
        $new = clone $this;
        $new->take = $take;
        return $new;
    }

    /**
     * @return int SORT_ASC or SORT_DESC
     * @see https://www.php.net/manual/en/function.array-multisort.php
     */
    public function order(): int
    {
        return $this->order;
    }

    public function withOrder(int $order): static
    {
        $new = clone $this;
        $new->order = $order;
        return $new;
    }

    public function withOrderAsc(): static
    {
        return $this->withOrder(SORT_ASC);
    }

    public function withOrderDesc(): static
    {
        return $this->withOrder(SORT_DESC);
    }

    /**
     * @return int SORT_REGULAR, SORT_FLAG_CASE, ...
     * @see https://www.php.net/manual/en/function.array-multisort.php
     */
    public function falgs(): int
    {
        return $this->flags;
    }

    public function withFlags(int $flags): static
    {
        $new = clone $this;
        $new->flags = $flags;
        return $new;
    }
}
