<?php

class GildedRoseTest extends PHPUnit_Framework_TestCase
{

    public function testDefaultItemEndOfDay()
    {
        $item = new Item(GildedRose::ITEM_RANDOM, 5, 5);

        $defaultItem = new DefaultItem($item);
        $result = $defaultItem->endOfDay($item);

        $this->assertEquals(
            new DefaultItem(new Item(GildedRose::ITEM_RANDOM, 4, 4)),
            $result
        );
    }

    public function testSellDayHasPassed()
    {
        $item = new Item(GildedRose::ITEM_RANDOM, -3, 5);

        $defaultItem = new DefaultItem($item);
        $result = $defaultItem->endOfDay($item);

        $this->assertEquals(
            new DefaultItem(new Item(GildedRose::ITEM_RANDOM, -4, 3)),
            $result
        );
    }

    public function testQualityIsNeverNegative()
    {
        $item = new Item(GildedRose::ITEM_RANDOM, 10, 0);

        $defaultItem = new DefaultItem($item);
        $result = $defaultItem->endOfDay($item);

        $this->assertEquals(
            new DefaultItem(new Item(GildedRose::ITEM_RANDOM, 9, 0)),
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

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Sulfuras has always quality 80
     */
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

    public function testSulfurasHasAlwaysQuality80()
    {
        $item = new Item(GildedRose::ITEM_SULFURAS, null, 80);

        $gildedRose = new GildedRose();
        $result = $gildedRose->endOfDay($item);

        $this->assertEquals(
            new Item(GildedRose::ITEM_SULFURAS, null, 80),
            $result
        );
    }

    public function testBackstagePassesIncreasesQuality()
    {
        $item = new Item(GildedRose::ITEM_BACKSTAGE_PASSES, 30, 20);

        $gildedRose = new GildedRose();
        $result = $gildedRose->endOfDay($item);

        $this->assertEquals(
            new Item(GildedRose::ITEM_BACKSTAGE_PASSES, 29, 21),
            $result
        );
    }

    public function testBackstagePassesIncreasesQualityBy2When10DaysOrLess()
    {
        $item = new Item(GildedRose::ITEM_BACKSTAGE_PASSES, 10, 25);

        $gildedRose = new GildedRose();
        $result = $gildedRose->endOfDay($item);

        $this->assertEquals(
            new Item(GildedRose::ITEM_BACKSTAGE_PASSES, 9, 27),
            $result
        );
    }

    public function testBackstagePassesIncreasesQualityBy3When5DaysOrLess()
    {
        $item = new Item(GildedRose::ITEM_BACKSTAGE_PASSES, 5, 14);

        $gildedRose = new GildedRose();
        $result = $gildedRose->endOfDay($item);

        $this->assertEquals(
            new Item(GildedRose::ITEM_BACKSTAGE_PASSES, 4, 17),
            $result
        );
    }

    public function testBackstagePassesQualityGoesTo0AfterConcert()
    {
        $item = new Item(GildedRose::ITEM_BACKSTAGE_PASSES, 0, 14);

        $gildedRose = new GildedRose();
        $result = $gildedRose->endOfDay($item);

        $this->assertEquals(
            new Item(GildedRose::ITEM_BACKSTAGE_PASSES, -1, 0),
            $result
        );
    }
}
