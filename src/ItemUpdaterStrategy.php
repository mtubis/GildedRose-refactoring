<?php

namespace App;

interface ItemUpdaterStrategy
{
    public function update(Item $item): void;
}
