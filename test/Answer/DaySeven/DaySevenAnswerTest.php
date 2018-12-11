<?php


namespace Cheezykins\AdventOfCode\Test\Answer\DaySeven;


use Cheezykins\AdventOfCode\DaySeven\Sleigh;
use PHPUnit\Framework\TestCase;

class DaySevenAnswerTest extends TestCase
{
    public function testAnswerOne()
    {
        $fixtures = file(__DIR__ . '/fixtures/instructions.txt');
        $s = new Sleigh();
        $s->setInstructions($fixtures);
        $letters = [];

        while (($instruction = $s->getNextInstruction()) !== null) {
            $letters[] = $instruction->getName();
            $instruction->resolve();
        }


        $this->assertEquals('CFGHAEMNBPRDISVWQUZJYTKLOX', implode('', $letters));
    }

    public function testAnswerTwo()
    {
        $fixtures = file(__DIR__ . '/fixtures/instructions.txt');

        $s = new Sleigh(5);
        $s->setInstructions($fixtures);
        $duration = $s->getWorkDuration();
        $this->assertEquals(828, $duration);
    }
}
