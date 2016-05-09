<?php

class Sulfuras extends DegradableItem
{

    public function endOfDay()
    {
        if ($this->item->quality !== 80) {
            throw new Exception("Sulfuras has always quality 80");
        }

        return new self($this->item);
    }


    public function calculateQualityAtEndOfDay()
    {
        return $this->item->quality;
    }
}
