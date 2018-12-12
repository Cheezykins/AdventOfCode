<?php


namespace Cheezykins\AdventOfCode\Test\Unit\Day11;


use Cheezykins\AdventOfCode\Day11\Grid;
use PHPUnit\Framework\TestCase;

class GridTest extends TestCase
{
    public function testGridCellFinding()
    {
        $g = new Grid(300, 300, 18);
        [$x, $y, $level] = $g->getBestCellGroup(3);
        $this->assertEquals(33, $x);
        $this->assertEquals(45, $y);
        $this->assertEquals(29, $level);
    }

    public function testPartTwoAnswer()
    {
        $g = new Grid(300, 300, 18);
        [$x, $y, $level, $size] = $g->getBestCellGroupSize();
        $this->assertEquals(90, $x);
        $this->assertEquals(269, $y);
        $this->assertEquals(113, $level);
        $this->assertEquals(16, $size);

        $g = new Grid(300, 300, 42);
        [$x, $y, $level, $size] = $g->getBestCellGroupSize();
        $this->assertEquals(232, $x);
        $this->assertEquals(251, $y);
        $this->assertEquals(119, $level);
        $this->assertEquals(12, $size);
    }
}
