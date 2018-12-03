<?php


namespace Cheezykins\AdventOfCode\DayThree;


class Square
{
    protected $x;
    protected $y;

    protected $claims = [];

    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function addClaim(Claim $claim): void
    {
        $this->claims[] = $claim;
    }

    public function claimCount(): int
    {
        return count($this->claims);
    }
}