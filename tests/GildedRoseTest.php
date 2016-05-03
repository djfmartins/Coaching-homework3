<?php

class GildedRoseTest extends PHPUnit_Framework_TestCase
{

    public function testRandomItemEndOfDay()
    {
        $item = new Item(GildedRose::ITEM_RANDOM, 5, 5);

        $gildedRose = new GildedRose();
        $result = $gildedRose->endOfDay($item);

        $this->assertEquals(
            new Item(GildedRose::ITEM_RANDOM, 4, 4),
            $result
        );
    }

    public function testSellDayHasPassed()
    {
        $item = new Item(GildedRose::ITEM_RANDOM, -3, 5);

        $gildedRose = new GildedRose();
        $result = $gildedRose->endOfDay($item);

        $this->assertEquals(
            new Item(GildedRose::ITEM_RANDOM, -4, 3),
            $result
        );
    }

    public function testQualityIsNeverNegative()
    {
        $item = new Item(GildedRose::ITEM_RANDOM, 10, 0);

        $gildedRose = new GildedRose();
        $result = $gildedRose->endOfDay($item);

        $this->assertEquals(
            new Item(GildedRose::ITEM_RANDOM, 9, 0),
            $result
        );
    }

    public function testAgedBrieIncreasesQualityTheOlderItGets()
    {
        $item = new Item(GildedRose::ITEM_AGED_BRIE, 10, 3);

        $gildedRose = new GildedRose();
        $result = $gildedRose->endOfDay($item);

        $this->assertEquals(
            new Item(GildedRose::ITEM_AGED_BRIE, 9, 4),
            $result
        );
    }

    public function testSulfurasIsLegendary()
    {
        $item = new Item(GildedRose::ITEM_SULFURAS, null, 8);

        $gildedRose = new GildedRose();
        $result = $gildedRose->endOfDay($item);

        $this->assertEquals(
            new Item(GildedRose::ITEM_SULFURAS, null, 8),
            $result
        );
    }

    public function testQualityNeverMoreThan50()
    {
        $item = new Item(GildedRose::ITEM_AGED_BRIE, 6, 50);

        $gildedRose = new GildedRose();
        $result = $gildedRose->endOfDay($item);

        $this->assertEquals(
            new Item(GildedRose::ITEM_AGED_BRIE, 5, 50),
            $result
        );
    }
}
