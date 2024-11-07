<?php

namespace App\Strategies;

use App\GildedRose;
use App\Item;

class BackstagePassUpdater implements ItemUpdaterStrategy
{
    public function update(Item $item): void
    {
        $item->increaseQuality();

        if ($item->getSellIn() <= GildedRose::BACKSTAGE_PASS_FIRST_THRESHOLD) {
            $item->increaseQuality();
        }

        if ($item->getSellIn() <= GildedRose::BACKSTAGE_PASS_SECOND_THRESHOLD) {
            $item->increaseQuality();
        }

        $item->decreaseSellIn();

        if ($item->getSellIn() < 0) {
            $item->setQuality(0);
        }
    }
}
