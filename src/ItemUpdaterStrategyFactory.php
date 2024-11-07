<?php

namespace App;

class ItemUpdaterStrategyFactory
{
    public function create(Item $item): ItemUpdaterStrategy
    {
        return match ($item->getName()) {
            'Aged Brie' => new AgedBrieUpdater(),
            'Backstage passes to a TAFKAL80ETC concert' => new BackstagePassUpdater(),
            'Sulfuras, Hand of Ragnaros' => new SulfurasUpdater(),
            default => new StandardItemUpdater(),
        };
    }
}
