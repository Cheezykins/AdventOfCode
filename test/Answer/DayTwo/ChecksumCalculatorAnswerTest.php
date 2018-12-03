<?php


namespace Cheezykins\AdventOfCode\Test\Answer\DayTwo;


use Cheezykins\AdventOfCode\DayTwo\BoxManager;
use PHPUnit\Framework\TestCase;

class ChecksumCalculatorAnswerTest extends TestCase
{
    public function testChecksumCalculatorAnswer()
    {
        $fixtures = file(__DIR__ . '/fixtures/box_ids.txt');

        $c = new BoxManager();
        $c->addBoxes($fixtures);

        $this->assertEquals(7221, $c->calculateChecksum());
    }

    public function testRelatedIdsFound()
    {
        $fixtures = file(__DIR__ . '/fixtures/box_ids.txt');

        $c = new BoxManager();
        $c->addBoxes($fixtures);

        $expected = [
            'mkucdflathzwsvjxrevymbdpoq',
            'mkwcdflathzwsvjxrevymbdpoq'
        ];

        $this->assertEquals($expected, $c->findRelatedIds());
    }

    public function testRelatedIdsCharacters()
    {
        $fixtures = file(__DIR__ . '/fixtures/box_ids.txt');

        $c = new BoxManager();
        $c->addBoxes($fixtures);

        $expected = 'mkcdflathzwsvjxrevymbdpoq';

        [$first, $second] = $c->findRelatedIds();

        $this->assertEquals($expected, $c->computeSimilarities($first, $second));
    }
}