<?php


namespace Cheezykins\AdventOfCode\Test\Unit\DayFour;


use Cheezykins\AdventOfCode\DayFour\Guard;
use Cheezykins\AdventOfCode\DayFour\GuardPost;
use Cheezykins\AdventOfCode\DayFour\Shift;
use PHPUnit\Framework\TestCase;

class GuardPostTest extends TestCase
{
    public function testShiftControllerWorks()
    {

        $dataset = [
            '[1518-11-01 00:00] Guard #10 begins shift',
            '[1518-11-01 00:05] falls asleep',
            '[1518-11-01 00:25] wakes up',
            '[1518-11-01 00:30] falls asleep',
            '[1518-11-01 00:55] wakes up',
            '[1518-11-01 23:58] Guard #99 begins shift',
            '[1518-11-02 00:40] falls asleep',
            '[1518-11-02 00:50] wakes up',
            '[1518-11-03 00:05] Guard #10 begins shift',
            '[1518-11-03 00:24] falls asleep',
            '[1518-11-03 00:29] wakes up',
            '[1518-11-04 00:02] Guard #99 begins shift',
            '[1518-11-04 00:36] falls asleep',
            '[1518-11-04 00:46] wakes up',
            '[1518-11-05 00:03] Guard #99 begins shift',
            '[1518-11-05 00:45] falls asleep',
            '[1518-11-05 00:55] wakes up',
        ];

        $controller = new GuardPost();

        $controller->addEvents($dataset);


        $guards = $controller->getGuards();

        $this->assertInternalType('array', $guards);
        $this->assertCount(2, $guards);
        $this->assertContainsOnlyInstancesOf(Guard::class, $guards);

        $this->assertEquals(10, $guards[10]->getId());
        $this->assertInternalType('array', $guards[10]->getShifts());
        $this->assertCount(2, $guards[10]->getShifts());
        $this->assertContainsOnlyInstancesOf(Shift::class, $guards[10]->getShifts());

        $this->assertEquals(99, $guards[99]->getId());
        $this->assertInternalType('array', $guards[99]->getShifts());
        $this->assertCount(3, $guards[99]->getShifts());
        $this->assertContainsOnlyInstancesOf(Shift::class, $guards[99]->getShifts());

        $guard = $controller->getWorstGuard();
        $this->assertInstanceOf(Guard::class, $guard);
        $this->assertEquals(10, $guard->getId());
    }
}