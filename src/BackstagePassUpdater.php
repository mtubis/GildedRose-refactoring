<?php

namespace App;

class BackstagePassUpdater implements ItemUpdaterStrategy
{
    public function update(Item $item): void
    {
        if ($item->getQuality() < GildedRose::MAX_QUALITY) {
            $item->increaseQuality();

            if ($item->getSellIn() <= GildedRose::BACKSTAGE_PASS_FIRST_THRESHOLD && $item->getQuality() < GildedRose::MAX_QUALITY) {
                $item->increaseQuality();
            }

            if ($item->getSellIn() <= GildedRose::BACKSTAGE_PASS_SECOND_THRESHOLD && $item->getQuality() < GildedRose::MAX_QUALITY) {
                $item->increaseQuality();
            }
        }

        $item->decreaseSellIn();

        if ($item->getSellIn() < 0) {
            $item->setQuality(GildedRose::MIN_QUALITY);
        }
    }
}
