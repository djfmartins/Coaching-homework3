<?php

class GildedRose
{
    /**
     * @param Item $startItem
     * @return Item
     */
    public function endDay(Item $startItem)
    {
        $qualityMultiplier = $startItem->name === "Aged Brie" ? 1 : -1;

        $newSellIn = $startItem->sell_in - 1;
        $newQuality = $startItem->quality + $qualityMultiplier;

        if ($startItem->sell_in == 0) {
            $newQuality += $qualityMultiplier;
        }

        if ($newQuality < 0) {
            $newQuality = 0;
        }

        return new Item($startItem->name, $newSellIn, $newQuality);
    }
}
