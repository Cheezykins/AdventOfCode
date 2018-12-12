<?php


namespace Cheezykins\AdventOfCode\Day11;


class Cell
{

    protected $x;
    protected $y;
    protected $serial;

    protected $rackId;

    protected $powerLevel;

    public function __construct(int $x, int $y, int $serial)
    {
        $this->x = $x;
        $this->y = $y;
        $this->serial = $serial;
        $this->rackId = $x + 10;
    }

    public function getPowerLevel(bool $forceRecalculate = false): int
    {
        if (!$this->powerLevel || $forceRecalculate) {
            $powerLevel = $this->rackId * $this->y;
            $powerLevel += $this->serial;
            $powerLevel *= $this->rackId;
            if (strlen($powerLevel >= 3)) {
                $powerLevel = (int)substr($powerLevel, -3, 1);
            } else {
                $powerLevel = 0;
            }
            $this->powerLevel = $powerLevel - 5;
        }
        return $this->powerLevel;
    }
}
