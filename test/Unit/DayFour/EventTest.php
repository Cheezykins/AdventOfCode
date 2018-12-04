<?php


namespace Cheezykins\AdventOfCode\Test\Unit\DayFour;


use Carbon\Carbon;
use Cheezykins\AdventOfCode\DayFour\Event;
use PHPUnit\Framework\TestCase;

class EventTest extends TestCase
{
    public function testParsingEventStrings()
    {
        $string = '[1518-11-01 00:00] Guard #10 begins shift';

        $event = Event::createFromString($string);

        $this->assertInstanceOf(Event::class, $event);
        $this->assertEquals(Carbon::create(1518, 11, 01, 00, 00), $event->getTimeStamp());
        $this->assertEquals('Guard #10 begins shift', $event->getText());
        $this->assertTrue($event->startsNewShift());
        $this->assertEquals(10, $event->getGuardId());
        $this->assertEquals(1, $event->getSleepState());
    }

    public function testParsingNonShiftStrings()
    {
        $string = '[1518-11-01 00:25] wakes up';

        $event = Event::createFromString($string);

        $this->assertInstanceOf(Event::class, $event);
        $this->assertEquals(Carbon::create(1518, 11, 01, 00, 25), $event->getTimeStamp());
        $this->assertEquals('wakes up', $event->getText());
        $this->assertFalse($event->startsNewShift());
        $this->assertNull($event->getGuardId());
        $this->assertEquals(1, $event->getSleepState());
    }

    public function testParsingSleepStrings()
    {
        $string = '[1518-11-01 00:30] falls asleep';

        $event = Event::createFromString($string);

        $this->assertInstanceOf(Event::class, $event);
        $this->assertEquals(Carbon::create(1518, 11, 01, 00, 30), $event->getTimeStamp());
        $this->assertEquals('falls asleep', $event->getText());
        $this->assertFalse($event->startsNewShift());
        $this->assertNull($event->getGuardId());
        $this->assertEquals(0, $event->getSleepState());
    }
}
