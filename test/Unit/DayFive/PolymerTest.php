<?php


namespace Cheezykins\AdventOfCode\Test\Unit\DayFive;


use Cheezykins\AdventOfCode\DayFive\Polymer;
use PHPUnit\Framework\TestCase;

class PolymerTest extends TestCase
{
    public function testReductionOfPolymerOnActivation()
    {
        $p = new Polymer('dabAcCaCBAcCcaDA');

        $size = $p->activate();

        $this->assertEquals(10, $size);
    }

    public function testBestReactant()
    {
        $p = new Polymer('dabAcCaCBAcCcaDA');

        $size = $p->optimize();

        $this->assertEquals(4, $size);
    }
}
