<?php


namespace Cheezykins\AdventOfCode\Test\Unit\DayThree;


use Cheezykins\AdventOfCode\DayThree\Claim;
use PHPUnit\Framework\TestCase;

class ClaimTest extends TestCase
{
    public function testParsingOfClaims()
    {
        $claim = Claim::parseFromEntry("#123 @ 3,2: 5x4\r\n");

        $this->assertInstanceOf(Claim::class, $claim);
        $this->assertEquals(123, $claim->getId());
        $this->assertEquals(3, $claim->getX1());
        $this->assertEquals(2, $claim->getY1());
        $this->assertEquals(8, $claim->getX2());
        $this->assertEquals(6, $claim->getY2());
    }

    public function testReturnsPoints()
    {
        $claim = Claim::parseFromEntry("#123 @ 3,2: 5x4\r\n");

        $points = $claim->getClaimedPoints();

        $this->assertInternalType('array', $points);
        foreach ($points as $row) {
            $this->assertInternalType('array', $row);
            $this->assertContainsOnly('integer', $row);
        }

    }
}