<?php


namespace Cheezykins\AdventOfCode\Test\Unit\Day11;


use Cheezykins\AdventOfCode\Day11\Cell;
use PHPUnit\Framework\TestCase;

class CellTest extends TestCase
{
    public function testCellCalculates()
    {
        $c = new Cell(3, 5, 8);

        $this->assertEquals(4, $c->getPowerLevel());
    }
}
