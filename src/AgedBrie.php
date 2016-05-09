<?php

class AgedBrie extends DegradableItem
{

    public function calculateQualityAtEndOfDay()
    {
        $qualityDecreaseFactor = -1;

        $newQuality = $this->item->quality - (1 * $qualityDecreaseFactor);

        return $newQuality;
    }
}
