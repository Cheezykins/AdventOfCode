<?php


namespace Cheezykins\AdventOfCode\DayOne;


use Cheezykins\AdventOfCode\DayOne\Exceptions\FrequencyOutOfRangeException;

class FrequencyDriftCalibrator
{

    protected $frequency;

    protected $inputs = [];

    public function __construct(int $initializationFrequency = 0)
    {
        $this->frequency = $initializationFrequency;
    }

    /**
     * Add an array of changes
     * @param string[]|array $changes
     * @throws FrequencyOutOfRangeException
     */
    public function inputFrequencyChanges(array $changes): void
    {
        $this->inputs = [];
        foreach ($changes as $change) {
            $frequencyChange = self::normaliseInput($change);
            $this->changeFrequency($frequencyChange);
        }
    }

    protected static function normaliseInput(string $input): int
    {
        $input = trim($input);
        if (!preg_match('/^[+-]\d+$/', $input)) {
            throw new FrequencyOutOfRangeException($input . ' is not a valid frequency change');
        }
        return (int)$input;
    }

    /**
     * @param int|null $startFrequency
     * @return int
     */
    public function findDuplicatedFrequency(?int $startFrequency = null): int
    {
        if ($startFrequency !== null) {
            $this->frequency = $startFrequency;
        }
        $results = [];
        do {
            $results[] = $this->getFrequency();
            $input = array_shift($this->inputs);
            $this->changeFrequency($input);
        } while(!in_array($this->getFrequency(), $results));
        return $this->getFrequency();
    }

    protected function changeFrequency(int $change): void
    {
        $this->inputs[] = $change;
        $this->frequency += $change;
    }

    public function getFrequency(): int
    {
        return $this->frequency;
    }

    public function setFrequency(int $frequency): void
    {
        $this->frequency = $frequency;
    }
}