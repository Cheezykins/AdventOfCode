<?php


namespace Cheezykins\AdventOfCode\DayFour;


class GuardPost
{

    /** @var Event[]|array $events */
    protected $events = [];

    /** @var Shift[]|array $shifts */
    protected $shifts = [];

    /** @var Guard[]|array $guards */
    protected $guards = [];

    /**
     * @param string[]|array $events
     * @throws Exceptions\InvalidEventStringException
     */
    public function addEvents(array $events)
    {
        sort($events);
        foreach ($events as $event) {
            $this->events[] = Event::createFromString($event);
        }
        $this->parseEvents();
    }

    protected function parseEvents()
    {
        /** @var Shift|null $shift */
        $shift = null;
        foreach ($this->events as $event) {
            if ($event->startsNewShift()) {
                if ($shift !== null) {
                    $shift->end();
                    $this->shifts[] = $shift;
                }
                $shift = new Shift();
                $guard = $this->getOrCreateGuardById($event->getGuardId());
                $guard->addShift($shift);
            }
            $shift->addEvent($event);
        }
    }

    /**
     * @param int $guardId
     * @return Guard
     */
    protected function getOrCreateGuardById(int $guardId): Guard
    {
        if (!array_key_exists($guardId, $this->guards)) {
            $this->guards[$guardId] = new Guard($guardId);
        }
        return $this->guards[$guardId];
    }

    public function getGuards()
    {
        return $this->guards;
    }

    public function getWorstGuard(): ?Guard
    {
        /** @var Guard|null $worst */
        $worst = null;
        foreach ($this->guards as $guard) {
            if ($worst === null || $guard->getSleepStats()['totalSleepMinutes'] > $worst->getSleepStats()['totalSleepMinutes']) {
                $worst = $guard;
            }
        }
        return $worst;
    }


}