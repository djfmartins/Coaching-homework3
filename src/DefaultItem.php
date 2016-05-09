<?php

class DefaultItem extends DegradableItem
{

    public function calculateQualityAtEndOfDay()
    {
        $qualityDecreaseFactor = 1;

        if ($this->item->sell_in < 0) {
            $qualityDecreaseFactor = 2;
        }

        $newQuality = $this->item->quality - (1 * $qualityDecreaseFactor);
        
        return $newQuality;
    }

}
