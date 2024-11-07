<?php

namespace App;

class AgedBrieUpdater implements ItemUpdaterStrategy
{
    public function update(Item $item): void
    {
        if ($item->getQuality() < GildedRose::MAX_QUALITY) {
            $item->increaseQuality();
        }

        $item->decreaseSellIn();

        if ($item->getSellIn() < 0 && $item->getQuality() < GildedRose::MAX_QUALITY) {
            $item->increaseQuality();
        }
    }
}
