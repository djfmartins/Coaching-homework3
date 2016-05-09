<?php

class GildedRoseTest extends PHPUnit_Framework_TestCase
{

    public function testDefaultItemEndOfDay()
    {
        $item = new Item(DegradableItem::ITEM_RANDOM, 5, 5);

        $defaultItem = new DefaultItem($item);
        $result = $defaultItem->endOfDay($item);

        $this->assertEquals(
            new DefaultItem(new Item(DegradableItem::ITEM_RANDOM, 4, 4)),
            $result
        );
    }

    public function testSellDayHasPassed()
    {
        $item = new Item(DegradableItem::ITEM_RANDOM, -3, 5);

        $defaultItem = new DefaultItem($item);
        $result = $defaultItem->endOfDay($item);

        $this->assertEquals(
            new DefaultItem(new Item(DegradableItem::ITEM_RANDOM, -4, 3)),
            $result
        );
    }

    public function testQualityIsNeverNegative()
    {
        $item = new Item(DegradableItem::ITEM_RANDOM, 10, 0);

        $defaultItem = new DefaultItem($item);
        $result = $defaultItem->endOfDay($item);

        $this->assertEquals(
            new DefaultItem(new Item(DegradableItem::ITEM_RANDOM, 9, 0)),
            $result
        );
    }

    public function testAgedBrieIncreasesQualityTheOlderItGets()
    {
        $item = new Item(DegradableItem::ITEM_AGED_BRIE, 10, 3);

        $agedBrie = new AgedBrie($item);
        $result = $agedBrie->endOfDay($item);

        $this->assertEquals(
            new AgedBrie(new Item(DegradableItem::ITEM_AGED_BRIE, 9, 4)),
            $result
        );
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Sulfuras has always quality 80
     */
    public function testSulfurasIsLegendary()
    {
        $item = new Item(DegradableItem::ITEM_SULFURAS, null, 8);

        $sulfuras = new Sulfuras($item);
        $result = $sulfuras->endOfDay($item);

        $this->assertEquals(
            new Sulfuras(new Item(DegradableItem::ITEM_SULFURAS, null, 8)),
            $result
        );
    }

    public function testQualityNeverMoreThan50()
    {
        $item = new Item(DegradableItem::ITEM_AGED_BRIE, 6, 50);

        $agedBrie = new AgedBrie($item);
        $result = $agedBrie->endOfDay();

        $this->assertEquals(
            new AgedBrie(new Item(DegradableItem::ITEM_AGED_BRIE, 5, 50)),
            $result
        );
    }

    public function testSulfurasHasAlwaysQuality80()
    {
        $item = new Item(DegradableItem::ITEM_SULFURAS, null, 80);

        $sulfuras = new Sulfuras($item);
        $result = $sulfuras->endOfDay();

        $this->assertEquals(
            new Sulfuras(new Item(DegradableItem::ITEM_SULFURAS, null, 80)),
            $result
        );
    }

    public function testBackstagePassesIncreasesQuality()
    {
        $item = new Item(DegradableItem::ITEM_BACKSTAGE_PASSES, 30, 20);

        $backstagePasses = new BackstagePasses($item);
        $result = $backstagePasses->endOfDay();

        $this->assertEquals(
            new BackstagePasses(new Item(DegradableItem::ITEM_BACKSTAGE_PASSES, 29, 21)),
            $result
        );
    }

    public function testBackstagePassesIncreasesQualityBy2When10DaysOrLess()
    {
        $item = new Item(DegradableItem::ITEM_BACKSTAGE_PASSES, 10, 25);

        $backstagePasses = new BackstagePasses($item);
        $result = $backstagePasses->endOfDay();

        $this->assertEquals(
            new BackstagePasses(new Item(DegradableItem::ITEM_BACKSTAGE_PASSES, 9, 27)),
            $result
        );
    }

    public function testBackstagePassesIncreasesQualityBy3When5DaysOrLess()
    {
        $item = new Item(DegradableItem::ITEM_BACKSTAGE_PASSES, 5, 14);

        $backstagePasses = new BackstagePasses($item);
        $result = $backstagePasses->endOfDay();

        $this->assertEquals(
            new BackstagePasses(new Item(DegradableItem::ITEM_BACKSTAGE_PASSES, 4, 17)),
            $result
        );
    }

    public function testBackstagePassesQualityGoesTo0AfterConcert()
    {
        $item = new Item(DegradableItem::ITEM_BACKSTAGE_PASSES, 0, 14);

        $backstagePasses = new BackstagePasses($item);
        $result = $backstagePasses->endOfDay();

        $this->assertEquals(
            new BackstagePasses(new Item(DegradableItem::ITEM_BACKSTAGE_PASSES, -1, 0)),
            $result
        );
    }



    public function testDefaultItemEndOfDayConjured()
    {
        $item = new Item(DegradableItem::ITEM_RANDOM, 5, 5);

        $defaultItem = new DefaultItem($item, DegradableItem::IS_CONJURED);
        $result = $defaultItem->endOfDay($item);

        $this->assertEquals(
            new DefaultItem(new Item(DegradableItem::ITEM_RANDOM, 4, 3)),
            $result
        );
    }
}
