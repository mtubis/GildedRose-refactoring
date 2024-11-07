<?php

namespace App;

class StandardItemUpdater implements ItemUpdaterStrategy
{
    public function update(Item $item): void
    {
        if ($item->getQuality() > GildedRose::MIN_QUALITY) {
            $item->decreaseQuality();
        }

        $item->decreaseSellIn();

        if ($item->getSellIn() < 0 && $item->getQuality() > GildedRose::MIN_QUALITY) {
            $item->decreaseQuality();
        }
    }
}
