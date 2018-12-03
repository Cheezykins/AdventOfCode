<?php


namespace Cheezykins\AdventOfCode\Test\Unit\DayThree;


use Cheezykins\AdventOfCode\DayThree\Canvas;
use PHPUnit\Framework\TestCase;

class CanvasTest extends TestCase
{
    public function testOverlappingSquares()
    {
        $canvas = new Canvas();

        $canvas->addClaims([
            '#1 @ 1,3: 4x4',
            '#2 @ 3,1: 4x4',
            '#3 @ 5,5: 2x2',
        ]);



        $this->assertEquals(4, $canvas->calculateOverlappingSquares());


    }

    public function testFreeClaims()
    {
        $canvas = new Canvas();

        $canvas->addClaims([
            '#1 @ 1,3: 4x4',
            '#2 @ 3,1: 4x4',
            '#3 @ 5,5: 2x2',
        ]);

        $this->assertEquals(3, $canvas->calculateFreeClaims());
    }
}