<?php

namespace App;

class StandardItemUpdater implements ItemUpdaterStrategy
{
    public function update(Item $item): void
    {
        if ($item->quality > GildedRose::MIN_QUALITY) {
            $item->quality -= 1;
        }

        $item->sell_in -= 1;

        if ($item->sell_in < 0 && $item->quality > GildedRose::MIN_QUALITY) {
            $item->quality -= 1;
        }
    }
}
