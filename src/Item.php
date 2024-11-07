<?php

namespace App;

final class Item
{
    private const MAX_QUALITY = 50;
    private const MIN_QUALITY = 0;

    private string $name;
    private int $sell_in;
    private int $quality;

    public function __construct(string $name, int $sell_in, int $quality)
    {
        $this->name = $name;
        $this->sell_in = $sell_in;
        $this->quality = $quality;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSellIn(): int
    {
        return $this->sell_in;
    }

    public function getQuality(): int
    {
        return $this->quality;
    }

    public function decreaseSellIn(): void
    {
        $this->sell_in--;
    }

    public function increaseQuality(int $amount = 1): void
    {
        $this->quality = min($this->quality + $amount, self::MAX_QUALITY);
    }

    public function decreaseQuality(int $amount = 1): void
    {
        $this->quality = max($this->quality - $amount, self::MIN_QUALITY);
    }

    public function setQuality(int $value): void
    {
        $this->quality = max(min($value, self::MAX_QUALITY), self::MIN_QUALITY);
    }

    public function __toString(): string
    {
        return "{$this->name}, {$this->sell_in}, {$this->quality}";
    }
}
