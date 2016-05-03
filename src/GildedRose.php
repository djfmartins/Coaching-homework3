<?php

class GildedRose
{

    public function endOfDay(Item $item)
    {
        $sellIn = $item->sell_in;
        $quality = $item->quality;

        $qualityDecreaseFactor = 1;

        if ($sellIn < 0) {
            $qualityDecreaseFactor = 2;
        }

        $newSellIn = $sellIn - 1;
        $newQuality = $quality - (1 * $qualityDecreaseFactor);

        $newQuality = $newQuality < 0 ? 0 : $newQuality;

        return new Item($item->name, $newSellIn, $newQuality);
    }
}
