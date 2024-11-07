<?php

namespace App;

class StandardItemUpdater implements ItemUpdaterStrategy
{
    public function update(Item $item): void
    {
        $item->decreaseQuality();

        $item->decreaseSellIn();

        if ($item->getSellIn() < 0) {
            $item->decreaseQuality();
        }
    }
}
