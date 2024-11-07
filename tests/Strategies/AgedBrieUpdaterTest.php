<?php

namespace Tests\Strategies;

use App\Item;
use App\Strategies\AgedBrieUpdater;
use PHPUnit\Framework\TestCase;

class AgedBrieUpdaterTest extends TestCase
{
    public function testAgedBrieIncreasesQualityBeforeSellInDate()
    {
        $item = new Item('Aged Brie', 10, 10);
        $updater = new AgedBrieUpdater();

        $updater->update($item);

        $this->assertEquals(9, $item->getSellIn());
        $this->assertEquals(11, $item->getQuality());
    }

    public function testAgedBrieIncreasesQualityTwiceAsFastAfterSellInDate()
    {
        $item = new Item('Aged Brie', 0, 10);
        $updater = new AgedBrieUpdater();

        $updater->update($item);

        $this->assertEquals(-1, $item->getSellIn());
        $this->assertEquals(12, $item->getQuality());
    }

    public function testAgedBrieQualityDoesNotExceedMaxQuality()
    {
        $item = new Item('Aged Brie', 10, 50);
        $updater = new AgedBrieUpdater();

        $updater->update($item);

        $this->assertEquals(9, $item->getSellIn());
        $this->assertEquals(50, $item->getQuality());
    }
}
