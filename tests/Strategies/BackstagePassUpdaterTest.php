<?php

namespace Tests\Strategies;

use App\Item;
use App\Strategies\BackstagePassUpdater;
use PHPUnit\Framework\TestCase;

class BackstagePassUpdaterTest extends TestCase
{
    public function testBackstagePassIncreasesQualityNormally()
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 15, 10);
        $updater = new BackstagePassUpdater();

        $updater->update($item);

        $this->assertEquals(14, $item->getSellIn());
        $this->assertEquals(11, $item->getQuality());
    }

    public function testBackstagePassIncreasesQualityBy2When10DaysOrLess()
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 10, 10);
        $updater = new BackstagePassUpdater();

        $updater->update($item);

        $this->assertEquals(9, $item->getSellIn());
        $this->assertEquals(12, $item->getQuality());
    }

    public function testBackstagePassIncreasesQualityBy3When5DaysOrLess()
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 5, 10);
        $updater = new BackstagePassUpdater();

        $updater->update($item);

        $this->assertEquals(4, $item->getSellIn());
        $this->assertEquals(13, $item->getQuality());
    }

    public function testBackstagePassQualityDropsToZeroAfterSellInDate()
    {
        $item = new Item('Backstage passes to a TAFKAL80ETC concert', 0, 10);
        $updater = new BackstagePassUpdater();

        $updater->update($item);

        $this->assertEquals(-1, $item->getSellIn());
        $this->assertEquals(0, $item->getQuality());
    }
}
