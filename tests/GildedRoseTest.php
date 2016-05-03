<?php

namespace Homework3;

class GildedRoseTest extends \PHPUnit_Framework_TestCase
{
    public function testItemQualityDecreasesWhenDayPasses()
    {
        $gildedRose = new GildedRose();

        $startItem = new Item('normal', 20, 50);

        $endItem = $gildedRose->endDay($startItem);

        $this->assertEquals(49, $endItem->quality);
    }

    public function testItemSellInDecreasesWhenDayPasses()
    {
        $gildedRose = new GildedRose();

        $startItem = new Item('normal', 20, 50);

        $endItem = $gildedRose->endDay($startItem);

        $this->assertEquals(19, $endItem->sell_in);
    }

    public function testQualityDegradesTwiceAsFastWhenSellDayPassed()
    {
        $gildedRose = new GildedRose();

        $startItem = new Item('normal', 0, 50);

        $endItem = $gildedRose->endDay($startItem);

        $this->assertEquals(48, $endItem->quality);
    }

    public function testItemQualityIsNeverNegative()
    {
        $gildedRose = new GildedRose();

        $startItem = new Item('normal', 0, 0);

        $endItem = $gildedRose->endDay($startItem);

        $this->assertEquals(0, $endItem->quality);
    }

    public function testAgedBrieIncreasesQuality()
    {
        $gildedRose = new GildedRose();

        $startItem = new Item('Aged Brie', 8, 10);

        $endItem = $gildedRose->endDay($startItem);

        $this->assertEquals(11, $endItem->quality);
    }
}
