<?php


namespace Cheezykins\AdventOfCode\DayThree;


use Cheezykins\AdventOfCode\DayThree\Exceptions\InvalidClaimSpecificationException;

class Claim
{

    protected $id;

    protected $x1;
    protected $y1;
    protected $x2;
    protected $y2;

    public function __construct(int $left, int $top, int $width, int $height, int $id)
    {
        $this->x1 = $left;
        $this->y1 = $top;
        $this->x2 = $this->x1 + $width;
        $this->y2 = $this->y1 + $height;
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getX1(): int
    {
        return $this->x1;
    }

    /**
     * @return int
     */
    public function getY1(): int
    {
        return $this->y1;
    }

    /**
     * @return int
     */
    public function getX2(): int
    {
        return $this->x2;
    }

    /**
     * @return int
     */
    public function getY2(): int
    {
        return $this->y2;
    }

    /**
     * Gets an array of claimed points
     * @return array
     */
    public function getClaimedPoints(): array
    {
        $points = [];
        for ($y = $this->y1; $y < $this->y2; $y++) {
            for ($x = $this->x1; $x < $this->x2; $x++) {
                $points[] = [$x, $y];
            }
        }
        return $points;
    }

    public static function parseFromEntry(string $line): self
    {
        $line = trim($line);
        $matches = [];

        if (!preg_match('/#(\d+) @ (\d+),(\d+): (\d+)x(\d+)/', $line, $matches)) {
            throw new InvalidClaimSpecificationException($line . ' is not a valid claim');
        }

        return new self($matches[2], $matches[3], $matches[4], $matches[5], $matches[1]);
    }

    public function interdicts(Claim $claim): bool
    {
        return $this->x1 < $claim->getX2() && $this->x2 > $claim->getX1()
            && $this->y1 < $claim->getY2() && $this->y2 > $claim->getY1();

    }
}