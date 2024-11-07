<?php

namespace Tests\Strategies;

use App\Item;
use App\Strategies\SulfurasUpdater;
use PHPUnit\Framework\TestCase;

class SulfurasUpdaterTest extends TestCase
{
    public function testSulfurasQualityDoesNotChange()
    {
        $item = new Item('Sulfuras, Hand of Ragnaros', 10, 80);
        $updater = new SulfurasUpdater();

        $updater->update($item);

        $this->assertEquals(10, $item->getSellIn());
        $this->assertEquals(80, $item->getQuality());
    }

    public function testSulfurasSellInDoesNotChange()
    {
        $item = new Item('Sulfuras, Hand of Ragnaros', -1, 80);
        $updater = new SulfurasUpdater();

        $updater->update($item);

        $this->assertEquals(-1, $item->getSellIn());
        $this->assertEquals(80, $item->getQuality());
    }
}
