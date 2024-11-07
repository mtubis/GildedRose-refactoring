<?php

namespace App;

class BackstagePassUpdater implements ItemUpdaterStrategy
{
    public function update(Item $item): void
    {
        if ($item->quality < GildedRose::MAX_QUALITY) {
            $item->quality += 1;

            if ($item->sell_in <= GildedRose::BACKSTAGE_PASS_FIRST_THRESHOLD && $item->quality < GildedRose::MAX_QUALITY) {
                $item->quality += 1;
            }

            if ($item->sell_in <= GildedRose::BACKSTAGE_PASS_SECOND_THRESHOLD && $item->quality < GildedRose::MAX_QUALITY) {
                $item->quality += 1;
            }
        }

        $item->sell_in -= 1;

        if ($item->sell_in < 0) {
            $item->quality = GildedRose::MIN_QUALITY;
        }
    }
}
