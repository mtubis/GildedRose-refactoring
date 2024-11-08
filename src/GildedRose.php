<?php

namespace App;

use App\Strategies\ItemUpdaterStrategyFactory;

final class GildedRose
{
    public const BACKSTAGE_PASS_FIRST_THRESHOLD = 10;
    public const BACKSTAGE_PASS_SECOND_THRESHOLD = 5;

    private ItemUpdaterStrategyFactory $strategyFactory;

    public function __construct(ItemUpdaterStrategyFactory $strategyFactory)
    {
        $this->strategyFactory = $strategyFactory;
    }

    public function updateQuality(Item $item): void
    {
        $strategy = $this->strategyFactory->create($item);
        $strategy->update($item);
    }
}
