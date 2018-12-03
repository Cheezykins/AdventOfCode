<?php


namespace Cheezykins\AdventOfCode\Test\Unit\DayTwo;


use Cheezykins\AdventOfCode\DayTwo\Box;
use PHPUnit\Framework\TestCase;

class BoxTest extends TestCase
{
    public function testBoxIdCalculation()
    {
        $box = new Box('abcdef');
        $this->assertEquals(0, $box->getLeftChecksum());
        $this->assertEquals(0, $box->getRightChecksum());

        $box = new Box('bababc');
        $this->assertEquals(1, $box->getLeftChecksum());
        $this->assertEquals(1, $box->getRightChecksum());

        $box = new Box('abbcde');
        $this->assertEquals(1, $box->getLeftChecksum());
        $this->assertEquals(0, $box->getRightChecksum());

        $box = new Box('abcccd');
        $this->assertEquals(0, $box->getLeftChecksum());
        $this->assertEquals(1, $box->getRightChecksum());

        $box = new Box('aabcdd');
        $this->assertEquals(1, $box->getLeftChecksum());
        $this->assertEquals(0, $box->getRightChecksum());

        $box = new Box('abcdee');
        $this->assertEquals(1, $box->getLeftChecksum());
        $this->assertEquals(0, $box->getRightChecksum());

        $box = new Box('ababab');
        $this->assertEquals(0, $box->getLeftChecksum());
        $this->assertEquals(1, $box->getRightChecksum());
    }

    public function testBoxIdDiffs()
    {
        $box = new Box('abcde');
        $result = $box->diff(new Box('axcye'));
        $this->assertEquals(2, $result);

        $box = new Box('fghij');
        $result = $box->diff(new Box('fguij'));
        $this->assertEquals(1, $result);
    }
}