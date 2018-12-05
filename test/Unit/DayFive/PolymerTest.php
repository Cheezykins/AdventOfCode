<?php


namespace Cheezykins\AdventOfCode\Test\Unit\DayFive;


use Cheezykins\AdventOfCode\DayFive\Polymer;
use PHPUnit\Framework\TestCase;

class PolymerTest extends TestCase
{
    public function testReductionOfPolymerOnActivation()
    {
        $p = new Polymer('dabAcCaCBAcCcaDA');

        $p->activate();

        $this->assertEquals('dabCBAcaDA', $p->getActivatedChain());

        $this->assertEquals(10, strlen($p->getActivatedChain()));
    }

    public function testBestReactant()
    {
        $p = new Polymer('dabAcCaCBAcCcaDA');

        $best = $p->determineBestReactant();

        $this->assertEquals('c', $best);
        $this->assertEquals(4, strlen($p->getOptimalChain()));
    }
}
