<?php

class GildedRoseTest extends PHPUnit_Framework_TestCase
{

    public function testRandomItemEndOfDay()
    {
        $itemName = "Random Item";
        $item = new Item($itemName, 5, 5);

        $gildedRose = new GildedRose();
        $result = $gildedRose->endOfDay($item);

        $this->assertEquals(
            new Item($itemName, 4, 4),
            $result
        );
    }
}
