<?php


namespace Cheezykins\AdventOfCode\DayTwo;


class Box
{
    protected $id;

    protected $hashCounts;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    protected function determineHashCounts(): void
    {
        if ($this->hashCounts === null) {
            $this->hashCounts = [];

            $letters = str_split($this->id);
            foreach ($letters as $letter) {
                if (!array_key_exists($letter, $this->hashCounts)) {
                    $this->hashCounts[$letter] = 0;
                }
                $this->hashCounts[$letter]++;
            }
        }
    }

    public function getLeftChecksum(): int {
        $this->determineHashCounts();
        return in_array(2, $this->hashCounts) ? 1 : 0;
    }

    public function getRightChecksum(): int {
        $this->determineHashCounts();
        return in_array(3, $this->hashCounts) ? 1 : 0;
    }

    /**
     * Return the integer diff between two box IDs
     * @param Box $box
     * @return int
     */
    public function diff(Box $box): int
    {
        return strlen($this->id) - similar_text($this->id, $box->id);
    }

    public function getId(): string
    {
        return $this->id;
    }
}