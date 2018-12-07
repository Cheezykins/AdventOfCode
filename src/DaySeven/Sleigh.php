<?php


namespace Cheezykins\AdventOfCode\DaySeven;


class Sleigh
{
    /** @var Step[]|array $instructions */
    public static $instructions = [];

    public function setInstructions(array $instructionStrings) {
        foreach ($instructionStrings as $instruction) {
            $instruction = trim($instruction);
            Step::createOrUpdateFromString($instruction);
        }
        usort(self::$instructions, function (Step $a, Step $b) {
            return $a->getName() <=> $b->getName();
        });
    }

    public function getExecutionOrder(): array
    {
        $order = [];

    }

    public function getNextInstruction(?Step $previous = null): ?Step
    {
        if ($previous === null) {
            foreach (self::$instructions as $instruction) {
                if ($instruction->getParentCount() === 0) {
                    return $instruction;
                }
            }
        }
    }
}
