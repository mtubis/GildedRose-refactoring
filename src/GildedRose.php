<?php

namespace App;

final class GildedRose
{
    private const MAX_QUALITY = 50;
    private const MIN_QUALITY = 0;
    private const LEGENDARY_QUALITY = 80;
    private const BACKSTAGE_PASS_FIRST_THRESHOLD = 10;
    private const BACKSTAGE_PASS_SECOND_THRESHOLD = 5;

    public function updateQuality($item)
    {
        if ($item->name != 'Aged Brie' and $item->name != 'Backstage passes to a TAFKAL80ETC concert') {
            if ($item->quality > self::MIN_QUALITY) {
                if ($item->name != 'Sulfuras, Hand of Ragnaros') {
                    $item->quality -= 1;
                } else {
                    $item->quality = self::LEGENDARY_QUALITY;
                }
            }
        } else {
            if ($item->quality < self::MAX_QUALITY) {
                $item->quality = $item->quality + 1;
                if ($item->name == 'Backstage passes to a TAFKAL80ETC concert') {
                    if ($item->sell_in <= self::BACKSTAGE_PASS_FIRST_THRESHOLD) {
                        if ($item->quality < self::MAX_QUALITY) {
                            $item->quality += 1;
                        }
                    }
                    if ($item->sell_in <= self::BACKSTAGE_PASS_SECOND_THRESHOLD) {
                        if ($item->quality < self::MAX_QUALITY) {
                            $item->quality += 1;
                        }
                    }
                }
            }
        }

        if ($item->name != 'Sulfuras, Hand of Ragnaros') {
            $item->sell_in -= 1;
        }

        if ($item->sell_in < 0) {
            if ($item->name != 'Aged Brie') {
                if ($item->name != 'Backstage passes to a TAFKAL80ETC concert') {
                    if ($item->quality > self::MIN_QUALITY) {
                        if ($item->name != 'Sulfuras, Hand of Ragnaros') {
                            $item->quality -= 1;
                        }
                    }
                } else {
                    $item->quality = self::MIN_QUALITY;
                }
            } else {
                if ($item->quality < self::MAX_QUALITY) {
                    $item->quality += 1;
                }
            }
        }
    }

}