<?php

namespace App;

final class GildedRose
{
    public const LEGENDARY_QUALITY = 80;
    public const BACKSTAGE_PASS_FIRST_THRESHOLD = 10;
    public const BACKSTAGE_PASS_SECOND_THRESHOLD = 5;

    public function updateQuality(Item $item): void
    {
        $strategy = $this->getStrategyForItem($item);
        $strategy->update($item);
    }

    private function getStrategyForItem(Item $item): ItemUpdaterStrategy
    {
        return match ($item->getName()) {
            'Aged Brie' => new AgedBrieUpdater(),
            'Backstage passes to a TAFKAL80ETC concert' => new BackstagePassUpdater(),
            'Sulfuras, Hand of Ragnaros' => new SulfurasUpdater(),
            default => new StandardItemUpdater(),
        };
    }
}
