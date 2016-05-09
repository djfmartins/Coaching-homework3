<?php

class BackstagePasses extends DegradableItem
{

    public function calculateQualityAtEndOfDay()
    {
        $qualityDecreaseFactor = -1;

        if ($this->item->sell_in <= 5) {
            $qualityDecreaseFactor = -3;
        } elseif ($this->item->sell_in <= 10) {
            $qualityDecreaseFactor = -2;
        }

        $newQuality = $this->item->quality - (1 * $qualityDecreaseFactor);

        if ($this->item->sell_in - 1 < 0) {
            $newQuality = 0;
        }
        
        return $newQuality;
    }
}
