<?php

class GildedRose
{

    const ITEM_RANDOM = "Random Item";
    const ITEM_AGED_BRIE = "Aged Brie";
    const ITEM_SULFURAS = "Sulfuras";

    public function endOfDay(Item $item)
    {
        $sellIn = $item->sell_in;
        $quality = $item->quality;
        $itemName = $item->name;

        if ($itemName === self::ITEM_SULFURAS) {
            return new Item($item->name, $sellIn, $quality);
        }

        $qualityDecreaseFactor = 1;

        if ($itemName === self::ITEM_AGED_BRIE) {
            $qualityDecreaseFactor = -1;
        } elseif ($sellIn < 0) {
            $qualityDecreaseFactor = 2;
        }

        $newSellIn = $sellIn - 1;
        $newQuality = $quality - (1 * $qualityDecreaseFactor);

        $newQuality = $newQuality < 0 ? 0 : $newQuality;

        return new Item($item->name, $newSellIn, $newQuality);
    }
}
