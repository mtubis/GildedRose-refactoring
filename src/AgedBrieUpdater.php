<?php

namespace App;

class AgedBrieUpdater implements ItemUpdaterStrategy
{
    public function update(Item $item): void
    {
        if ($item->quality < GildedRose::MAX_QUALITY) {
            $item->quality += 1;
        }

        $item->sell_in -= 1;

        if ($item->sell_in < 0 && $item->quality < GildedRose::MAX_QUALITY) {
            $item->quality += 1;
        }
    }
}
