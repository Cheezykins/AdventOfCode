<?php


namespace Cheezykins\AdventOfCode\DaySeven;


class Sleigh
{
    /** @var Step[]|array $instructions */
    public static $instructions = [];

    /**
     * @var array|Step[]
     */
    protected $workers = [];

    protected $workerCount = 1;

    public function __construct(int $workers = 1)
    {
        $this->workerCount = $workers;
    }

    public function setInstructions(array $instructionStrings, int $baseDuration = 60)
    {
        foreach ($instructionStrings as $instruction) {
            $instruction = trim($instruction);
            Step::createOrUpdateFromString($instruction, $baseDuration);
        }
        ksort(self::$instructions);
    }

    public function getNextInstruction(): ?Step
    {
        foreach (self::$instructions as $instruction) {
            if (!$instruction->isAssigned() && !$instruction->isResolved() && $instruction->allRequirementsResolved()) {
                return $instruction;
            }
        }
        return null;
    }

    protected function assignWorkers(): int
    {
        $workersAssigned = 0;
        for ($i = 0; $i < $this->workerCount; $i++) {
            if (!isset($this->workers[$i])) {
                $this->workers[$i] = $this->getNextInstruction();
                if ($this->workers[$i] !== null) {
                    $workersAssigned += 1;
                    $this->workers[$i]->assign();
                }
            } else {
                $workersAssigned += 1;
            }
        }
        return $workersAssigned;
    }


    protected function doWork(): int
    {
        $workersAssigned = 0;
        for ($i = 0; $i < $this->workerCount; $i++) {
            if ($this->workers[$i] !== null) {
                $workersAssigned ++;
                if ($this->workers[$i]->tick() === 0) {
                    $this->workers[$i]->resolve();
                    unset($this->workers[$i]);
                }
            }
        }
        return $workersAssigned;
    }

    public function getWorkDuration(): int
    {
        $seconds = 0;
        while ($this->assignWorkers() !== 0) {
            $this->doWork();
            $seconds ++;
        }
        return $seconds;
    }


}
