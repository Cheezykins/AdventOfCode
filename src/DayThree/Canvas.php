<?php


namespace Cheezykins\AdventOfCode\DayThree;


class Canvas
{
    /** @var Square[][]|array */
    protected $squares = [];

    /** @var Claim[]|array */
    protected $claims = [];

    /**
     * @param array $claims
     * @throws Exceptions\InvalidClaimSpecificationException
     */
    public function addClaims(array $claims): void
    {
        foreach ($claims as $claimString) {
            $claim = Claim::parseFromEntry($claimString);
            $this->claims[] = $claim;
            foreach ($claim->getClaimedPoints() as [$x, $y]) {
                $this->updateSquare($x, $y);
            }
        }
    }

    protected function updateSquare(int $x, int $y)
    {
        if (!array_key_exists($x, $this->squares)) {
            $this->squares[$x] = [];
        }
        if (!array_key_exists($y, $this->squares[$x])) {
            $this->squares[$x][$y] = new Square($x, $y);
        }
        $this->squares[$x][$y]->addClaim();
    }

    public function calculateOverlappingSquares(): int
    {
        $return = 0;
        foreach ($this->squares as $row) {
            foreach ($row as $square) {
                if ($square->claimCount() > 1) {
                    $return++;
                }
            }
        }
        return $return;
    }

    public function calculateFreeClaims(): int
    {
        foreach ($this->claims as $leftClaim) {
            foreach ($this->claims as $rightClaim) {
                if ($leftClaim->getId() === $rightClaim->getId()) {
                    continue;
                }

                $interdicts = $leftClaim->interdicts($rightClaim);

                if ($interdicts) {
                    continue 2;
                }

            }
            return $leftClaim->getId();
        }
        return 0;
    }
}