<?php


namespace Cheezykins\AdventOfCode\DayThree;


class Square
{
    protected $x;
    protected $y;

    protected $claims = 0;

    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function addClaim(): void
    {
        $this->claims ++;
    }

    public function claimCount(): int
    {
        return $this->claims;
    }
}