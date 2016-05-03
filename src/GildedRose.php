<?php

class GildedRose
{

    const ITEM_RANDOM = "Random Item";
    const ITEM_AGED_BRIE = "Aged Brie";
    const ITEM_SULFURAS = "Sulfuras";
    const ITEM_BACKSTAGE_PASSES = "Backstage passes";

    public function endOfDay(Item $item)
    {
        $sellIn = $item->sell_in;
        $quality = $item->quality;
        $itemName = $item->name;

        if ($itemName === self::ITEM_SULFURAS) {
            if ($quality !== 80) {
                throw new Exception("Sulfuras has always quality 80");
            }

            return new Item($item->name, $sellIn, $quality);
        }

        $qualityDecreaseFactor = 1;

        if ($itemName === self::ITEM_AGED_BRIE) {
            $qualityDecreaseFactor = -1;
        } elseif ($itemName === self::ITEM_BACKSTAGE_PASSES) {
            $qualityDecreaseFactor = -1;

            if ($sellIn <= 5) {
                $qualityDecreaseFactor = -3;
            } elseif ($sellIn <= 10) {
                $qualityDecreaseFactor = -2;
            }

        } elseif ($sellIn < 0) {
            $qualityDecreaseFactor = 2;
        }

        $newSellIn = $sellIn - 1;
        $newQuality = $quality - (1 * $qualityDecreaseFactor);

        if ($itemName === self::ITEM_BACKSTAGE_PASSES and $newSellIn < 0) {
            $newQuality = 0;
        }

        $newQuality = $newQuality < 0 ? 0 : $newQuality;
        $newQuality = $newQuality > 50 ? 50 : $newQuality;

        return new Item($item->name, $newSellIn, $newQuality);
    }
}
