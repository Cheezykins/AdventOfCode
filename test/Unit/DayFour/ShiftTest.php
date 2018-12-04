<?php


namespace Cheezykins\AdventOfCode\Test\Unit\DayFour;


use Cheezykins\AdventOfCode\DayFour\Event;
use Cheezykins\AdventOfCode\DayFour\Shift;
use PHPUnit\Framework\TestCase;

class ShiftTest extends TestCase
{

    protected $testData = [
        '[1518-11-01 00:00] Guard #10 begins shift',
        '[1518-11-01 00:05] falls asleep',
        '[1518-11-01 00:25] wakes up',
        '[1518-11-01 00:30] falls asleep',
        '[1518-11-01 00:55] wakes up',
    ];

    public function testShiftSetsParameters()
    {
        $shift = new Shift();
        foreach ($this->testData as $testDatum) {
            $shift->addEvent(Event::createFromString($testDatum));
        }
        $shift->end();

        $minutes = $shift->getSleepTimeline();

        $this->assertCount(59, $minutes);
        $this->assertEquals(1, $minutes[0]);
        $this->assertEquals(0, $minutes[5]);
    }
}