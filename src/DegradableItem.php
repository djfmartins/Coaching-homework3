<?php

abstract class DegradableItem
{
    const ITEM_RANDOM = "Random Item";
    const ITEM_AGED_BRIE = "Aged Brie";
    const ITEM_SULFURAS = "Sulfuras";
    const ITEM_BACKSTAGE_PASSES = "Backstage passes";

    const IS_CONJURED = true;

    /** @var Item */
    protected $item;

    /** @var bool */
    protected $isConjured;

    /**
     * @param Item $item
     * @param bool $isConjured
     */
    public function __construct(Item $item, $isConjured = false)
    {
        $this->item = $item;
        $this->isConjured = $isConjured;
    }

    /**
     * @return DegradableItem
     */
    public function endOfDay()
    {
        $quality = $this->calculateQualityAtEndOfDay();

        if ($this->isConjured) {
            $quality = $this->applyQualityChangeAgain($quality);
        }

        $quality = $quality < 0 ? 0 : $quality;
        $quality = $quality > 50 ? 50 : $quality;

        $this->item->quality = $quality;
        $this->item->sell_in--;

        return new $this($this->item, $this->isConjured);
    }

    abstract function calculateQualityAtEndOfDay();

    /**
     * @param int $quality
     *
     * @return int
     */
    private function applyQualityChangeAgain($quality)
    {
        $currentQuality = $this->item->quality;
        $changeOfQuality = $currentQuality - $quality;

        return $quality - $changeOfQuality;
    }

    public function getQuality()
    {
        return $this->item->quality;
    }

    public function getSellIn()
    {
        return $this->item->sell_in;
    }

    public function getName()
    {
        return $this->item->name;
    }

    public function isConjured()
    {
        return $this->isConjured;
    }
}
