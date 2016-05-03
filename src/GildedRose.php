<?php

class GildedRose
{

    public function endOfDay(Item $item)
    {
        $newSellIn = $item->sell_in;
        $newQuality = $item->quality;

        $newSellIn = $newSellIn - 1;
        $newQuality = $newQuality - 1;

        return new Item($item->name, $newSellIn, $newQuality);
    }
}
