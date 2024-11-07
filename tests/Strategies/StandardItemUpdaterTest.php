<?php

namespace Tests\Strategies;

use App\Item;
use App\Strategies\StandardItemUpdater;
use PHPUnit\Framework\TestCase;

class StandardItemUpdaterTest extends TestCase
{
    public function testStandardItemDecreasesQualityBeforeSellInDate()
    {
        $item = new Item('Elixir of the Mongoose', 10, 10);
        $updater = new StandardItemUpdater();

        $updater->update($item);

        $this->assertEquals(9, $item->getSellIn());
        $this->assertEquals(9, $item->getQuality());
    }

    public function testStandardItemDecreasesQualityTwiceAsFastAfterSellInDate()
    {
        $item = new Item('Elixir of the Mongoose', 0, 10);
        $updater = new StandardItemUpdater();

        $updater->update($item);

        $this->assertEquals(-1, $item->getSellIn());
        $this->assertEquals(8, $item->getQuality());
    }

    public function testStandardItemQualityDoesNotGoBelowZero()
    {
        $item = new Item('Elixir of the Mongoose', 10, 0);
        $updater = new StandardItemUpdater();

        $updater->update($item);

        $this->assertEquals(9, $item->getSellIn());
        $this->assertEquals(0, $item->getQuality());
    }
}
