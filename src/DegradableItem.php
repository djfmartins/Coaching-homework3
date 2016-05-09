<?php

abstract class DegradableItem
{
    const ITEM_RANDOM = "Random Item";
    const ITEM_AGED_BRIE = "Aged Brie";
    const ITEM_SULFURAS = "Sulfuras";
    const ITEM_BACKSTAGE_PASSES = "Backstage passes";
    
    /** @var Item */
    protected $item;

    /**
     * @param Item $item
     */
    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    /**
     * @return DegradableItem
     */
    public function endOfDay()
    {
        $quality = $this->calculateQualityAtEndOfDay();

        $quality = $quality < 0 ? 0 : $quality;
        $quality = $quality > 50 ? 50 : $quality;

        $this->item->quality = $quality;
        $this->item->sell_in--;

        return new $this($this->item);
    }

    abstract function calculateQualityAtEndOfDay();
}
