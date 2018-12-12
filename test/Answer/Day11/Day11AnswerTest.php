<?php


namespace Cheezykins\AdventOfCode\Test\Answer\Day11;


use Cheezykins\AdventOfCode\Day11\Grid;
use PHPUnit\Framework\TestCase;

class Day11AnswerTest extends TestCase
{
    public function testPartOneAnswer()
    {
        $g = new Grid(300, 300, 4455);
        [$x, $y] = $g->getBestCellGroup();
        $this->assertEquals(21, $x);
        $this->assertEquals(54, $y);
    }

    public function testPartTwoAnswer()
    {
        $g = new Grid(300, 300, 4455);
        [$x, $y, $level, $size] = $g->getBestCellGroupSize();
        $this->assertEquals(236, $x);
        $this->assertEquals(268, $y);
        $this->assertEquals(74, $level);
        $this->assertEquals(11, $size);
    }
}
