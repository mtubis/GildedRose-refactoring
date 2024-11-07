<?php

namespace App;

final class GildedRose
{
    private const MAX_QUALITY = 50;
    private const MIN_QUALITY = 0;
    private const LEGENDARY_QUALITY = 80;
    private const BACKSTAGE_PASS_FIRST_THRESHOLD = 10;
    private const BACKSTAGE_PASS_SECOND_THRESHOLD = 5;

    public function updateQuality(Item $item)
    {
        if ($item->name == 'Sulfuras, Hand of Ragnaros') {
            return; // Legendary items do not require an update
        }

        if ($item->name == 'Aged Brie') {
            $this->updateAgedBrieQuality($item);
        } elseif ($item->name == 'Backstage passes to a TAFKAL80ETC concert') {
            $this->updateBackstagePassQuality($item);
        } else {
            $this->updateStandardItemQuality($item);
        }

        $this->updateSellIn($item);

        if ($item->sell_in < 0) {
            $this->applyQualityAfterExpiration($item);
        }
    }

    private function updateAgedBrieQuality(Item $item)
    {
        if ($item->quality < self::MAX_QUALITY) {
            $item->quality += 1;
        }
    }

    private function updateBackstagePassQuality(Item $item)
    {
        if ($item->quality < self::MAX_QUALITY) {
            $item->quality += 1;

            if ($item->sell_in <= self::BACKSTAGE_PASS_FIRST_THRESHOLD && $item->quality < self::MAX_QUALITY) {
                $item->quality += 1;
            }
            if ($item->sell_in <= self::BACKSTAGE_PASS_SECOND_THRESHOLD && $item->quality < self::MAX_QUALITY) {
                $item->quality += 1;
            }
        }
    }

    private function updateStandardItemQuality(Item $item)
    {
        if ($item->quality > self::MIN_QUALITY) {
            $item->quality -= 1;
        }
    }

    private function updateSellIn(Item $item)
    {
        $item->sell_in -= 1;
    }

    private function applyQualityAfterExpiration(Item $item)
    {
        if ($item->name == 'Aged Brie') {
            if ($item->quality < self::MAX_QUALITY) {
                $item->quality += 1;
            }
        } elseif ($item->name == 'Backstage passes to a TAFKAL80ETC concert') {
            $item->quality = self::MIN_QUALITY;
        } else {
            if ($item->quality > self::MIN_QUALITY) {
                $item->quality -= 1;
            }
        }
    }
}
