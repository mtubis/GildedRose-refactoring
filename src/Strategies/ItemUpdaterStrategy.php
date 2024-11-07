<?php

namespace App\Strategies;

use App\Item;

interface ItemUpdaterStrategy
{
    public function update(Item $item): void;
}
