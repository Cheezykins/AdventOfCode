<?php


namespace Cheezykins\AdventOfCode\DayTwo;


class BoxManager
{
    /** @var Box[]|array */
    protected $boxes = [];

    /**
     * Add a list of boxes by ID
     * @param array $boxIds
     */
    public function addBoxes(array $boxIds): void
    {
        foreach ($boxIds as $boxId) {
            $this->boxes[] = new Box(trim($boxId));
        }
    }

    public function calculateChecksum(): int
    {
        $left = 0;
        $right = 0;

        foreach ($this->boxes as $box) {
            $left += $box->getLeftChecksum();
            $right += $box->getRightChecksum();
        }

        return $left * $right;
    }

    /**
     * Return an array of related box IDs
     * @return string[]|array
     */
    public function findRelatedIds(): array
    {
        $related = [];
        foreach ($this->boxes as $leftBox) {
            foreach ($this->boxes as $rightBox) {
                if ($leftBox->getId() === $rightBox->getId()) {
                    continue;
                }

                if ($leftBox->diff($rightBox) === 1) {
                    $related[] = $leftBox->getId();
                    $related[] = $rightBox->getId();
                }
            }
        }
        return array_unique($related);
    }

    public function computeSimilarities(string $master, string $comparison): string
    {
        $masterCharacters = str_split($master);
        $comparisonCharacters = str_split($comparison);
        $common = array_intersect($masterCharacters, $comparisonCharacters);
        return implode('', $common);
    }
}