<?php
namespace PHPocket\Widgets\Tests;


use PHPocket\Widgets\NumberColor;

class NumberColorTest extends NumberTest
{
    public function testColor()
    {
        $x = new NumberColor(15);
        $this->assertSame('<span class="positive">15</span>', (string) $x);
        $x = new NumberColor(-5);
        $this->assertSame('<span class="negative">-5</span>', (string) $x);
        $x = new NumberColor(0);
        $this->assertSame('<span class="zero">0</span>', (string) $x);
        $x = new NumberColor(0, -1, true);
        $this->assertSame('<span class="positive">0</span>', (string) $x);
    }
}