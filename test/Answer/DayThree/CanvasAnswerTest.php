<?php


namespace Cheezykins\AdventOfCode\Test\Answer\DayThree;


use Cheezykins\AdventOfCode\DayThree\Canvas;
use PHPUnit\Framework\TestCase;

class CanvasAnswerTest extends TestCase
{
    public function testAnswerSectionOne()
    {

        $fixtures = file(__DIR__ . '/fixtures/claims.txt');

        $c = new Canvas();
        $c->addClaims($fixtures);

        $this->assertEquals(105071, $c->calculateOverlappingSquares());
    }

    public function testGetNonOverlappingClaim()
    {
        $fixtures = file(__DIR__ . '/fixtures/claims.txt');

        $c = new Canvas();
        $c->addClaims($fixtures);

        $this->assertEquals(222, $c->calculateFreeClaims());
    }

}