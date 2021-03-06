<?php


namespace Cheezykins\AdventOfCode\Test\Unit\DaySeven;


use Cheezykins\AdventOfCode\DaySeven\Sleigh;
use Cheezykins\AdventOfCode\DaySeven\Step;
use PHPUnit\Framework\TestCase;

class SleighTest extends TestCase
{

    protected $fixtures = [
        'Step C must be finished before step A can begin.',
        'Step C must be finished before step F can begin.',
        'Step A must be finished before step B can begin.',
        'Step A must be finished before step D can begin.',
        'Step B must be finished before step E can begin.',
        'Step D must be finished before step E can begin.',
        'Step F must be finished before step E can begin.',
    ];

    protected function setUp()
    {
        parent::setUp();
        Sleigh::$instructions = [];
    }

    public function testStepCanCreateFromString()
    {

        $s = new Sleigh();

        $s->setInstructions($this->fixtures);

        $this->assertCount(6, Sleigh::$instructions);
        $this->assertContainsOnlyInstancesOf(Step::class, Sleigh::$instructions);
    }

    public function testSleighCanArrangeExecutionOrder()
    {
        $s = new Sleigh();
        $s->setInstructions($this->fixtures);
        $letters = [];
        while (($instruction = $s->getNextInstruction()) !== null) {
            $letters[] = $instruction->getName();
            $instruction->resolve();
        }

        $this->assertEquals(['C', 'A', 'B', 'D', 'F', 'E'], $letters);

    }

    public function testSleighCanAssignWorkToWorkers()
    {
        $s = new Sleigh(2);
        $s->setInstructions($this->fixtures, 0);
        $duration = $s->getWorkDuration();
        $this->assertEquals(15, $duration);
    }
}
