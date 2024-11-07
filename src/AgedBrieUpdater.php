<?php

namespace App;

class AgedBrieUpdater implements ItemUpdaterStrategy
{
    public function update(Item $item): void
    {
        $item->increaseQuality();

        $item->decreaseSellIn();

        if ($item->getSellIn() < 0) {
            $item->increaseQuality();
        }
    }
}
