<?php


namespace Cheezykins\AdventOfCode\DayFour;


use Carbon\Carbon;
use Cheezykins\AdventOfCode\DayFour\Exceptions\InvalidShiftStateException;

class Shift
{
    /** @var Carbon|null $startTime */
    protected $startTime;
    /** @var Carbon|null $endTime */
    protected $endTime;

    /** @var Event[]|array $events */
    protected $events = [];

    /** @var string[]|array $minutes */
    protected $minutes = [];

    /** @var bool $ended */
    protected $ended;
    /** @var bool $started */
    protected $started;

    public function __construct()
    {
        $this->started = false;
        $this->ended = false;
    }

    protected function start(Carbon $startTime)
    {
        $this->startTime = $startTime->copy()->startOfDay();

        if ($startTime->hour !== 00) {
            $this->startTime = $startTime->copy()->addDay()->startOfDay();
        }

        $this->endTime = Carbon::create($this->startTime->year, $this->startTime->month, $this->startTime->day, 0, 59);
        $this->started = true;
    }

    public function addEvent(Event $event)
    {
        if (!$this->started && !$event->startsNewShift()) {
            throw new InvalidShiftStateException('You cannot add non-start tasks to an unstarted shift');
        } elseif (!$this->started) {
            $this->start($event->getTimeStamp());
        }
        $this->events[] = $event;
    }

    public function end()
    {
        $this->ended = true;
        $this->calculateSleepTimeline();
    }

    protected function calculateSleepTimeline()
    {
        $pointer = $this->startTime->clone();
        $state = 1;
        while ($pointer < $this->endTime) {
            foreach ($this->events as $event) {
                if ($event->getTimeStamp()->equalTo($pointer)) {
                    $state = $event->getSleepState();
                    break;
                }
            }
            $this->minutes[] = $state;
            $pointer->addMinute();
        }
    }

    /**
     * @return int[]|array
     */
    public function getSleepTimeline(): array
    {
        return $this->minutes;
    }
}