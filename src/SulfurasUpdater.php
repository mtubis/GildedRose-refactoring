<?php

namespace App;

class SulfurasUpdater implements ItemUpdaterStrategy
{
    public function update(Item $item): void
    {
        // "Sulfuras" doesn't change quality or sell_in, so the method is empty
    }
}
