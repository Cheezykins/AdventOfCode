<?php


namespace Cheezykins\AdventOfCode\DayFour;


class Guard
{
    protected $id;

    /** @var Shift[]|array */
    protected $shifts = [];

    protected $sleepStats = [];

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function addShift(Shift $shift)
    {
        $this->shifts[] = $shift;
    }

    /**
     * @return Shift[]|array
     */
    public function getShifts(): array
    {
        return $this->shifts;
    }

    public function getSleepStats()
    {
        if ($this->sleepStats === []) {
            $sleepMinutes = [];
            $total = 0;
            foreach ($this->shifts as $shift) {
                foreach ($shift->getSleepTimeline() as $minute => $status) {
                    if ($status === 1) {
                        continue;
                    }
                    if (!array_key_exists($minute, $sleepMinutes)) {
                        $sleepMinutes[$minute] = 0;
                    }
                    $sleepMinutes[$minute]++;
                    $total++;
                }
            }
            if ($sleepMinutes === []) {
                $maxMinute = null;
                $count = null;
            } else {
                $count = max($sleepMinutes);
                $maxMinutes = array_keys($sleepMinutes, $count);
                $maxMinute = array_pop($maxMinutes);
            }
            $this->sleepStats = [
                'totalSleepMinutes' => $total,
                'highestMinuteAsleep' => $maxMinute,
                'numberOfTimes' => $count
            ];
        }
        return $this->sleepStats;
    }

}