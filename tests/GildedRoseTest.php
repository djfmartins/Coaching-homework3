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

    public function testSellDayHasPassed()
    {
        $itemName = "Random Item";
        $item = new Item($itemName, -3, 5);

        $gildedRose = new GildedRose();
        $result = $gildedRose->endOfDay($item);

        $this->assertEquals(
            new Item($itemName, -4, 3),
            $result
        );
    }

    public function testQualityIsNeverNegative()
    {
        $itemName = "Random Item";
        $item = new Item($itemName, 10, 0);

        $gildedRose = new GildedRose();
        $result = $gildedRose->endOfDay($item);

        $this->assertEquals(
            new Item($itemName, 9, 0),
            $result
        );
    }
}
