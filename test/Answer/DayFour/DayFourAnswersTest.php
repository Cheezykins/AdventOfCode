<?php


namespace Cheezykins\AdventOfCode\Test\Answer\DayFour;


use Cheezykins\AdventOfCode\DayFour\Guard;
use Cheezykins\AdventOfCode\DayFour\GuardPost;
use PHPUnit\Framework\TestCase;

class DayFourAnswersTest extends TestCase
{
    public function testPartOne()
    {
        $fixtures = file(__DIR__ . '/fixtures/events.txt');

        $controller = new GuardPost();

        $controller->addEvents($fixtures);
        $worstGuard = $controller->getWorstGuard();
        $stats = $worstGuard->getSleepStats();

        $this->assertEquals(3457, $worstGuard->getId());
        $this->assertEquals(504, $stats['totalSleepMinutes']);
        $this->assertEquals(40, $stats['highestMinuteAsleep']);


    }

    public function testPartTwo()
    {
        $fixtures = file(__DIR__ . '/fixtures/events.txt');

        $controller = new GuardPost();

        $controller->addEvents($fixtures);

        /** @var Guard|null $most */
        $most = null;

        $guards = $controller->getGuards();

        foreach ($guards as $guard) {
            if ($most === null || $guard->getSleepStats()['numberOfTimes'] > $most->getSleepStats()['numberOfTimes']) {
                $most = $guard;
            }
        }

        $this->assertEquals(47, $most->getSleepStats()['highestMinuteAsleep']);
        $this->assertEquals(1901, $most->getId());
    }
}