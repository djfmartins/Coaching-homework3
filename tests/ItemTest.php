<?php

class ItemTest extends \PHPUnit_Framework_TestCase
{
    public function testEquals()
    {
        $item1 = new Item('whatever', 20, 50);
        $item2 = new Item('whatever', 20, 50);

        $this->assertEquals($item1, $item2);
    }
}
