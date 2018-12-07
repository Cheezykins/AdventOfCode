<?php

namespace Cheezykins\AdventOfCode\DayFive;

class Polymer
{
    /** @var string $chain */
    protected $chain;

    public function __construct(string $chain)
    {
        $this->chain = $chain;
    }

    public function optimize(): int
    {
        $letters = range('a', 'z');
        $minimal = strlen($this->chain);

        foreach ($letters as $letter) {
            if (stripos($this->chain, $letter) === false) {
                continue;
            }
            $chain = self::reduce($this->chain, $letter);
            if ($minimal === null || strlen($chain) < $minimal) {
                $minimal = strlen($chain);
                $this->optimal = $chain;
            }
        }
        return $minimal;
    }

    public function activate(): int
    {
        return strlen(self::reduce($this->chain));
    }

    /**
     * @param string $chain
     * @param string|null $removeFirst
     * @return string
     */
    public static function reduce(string $chain, ?string $removeFirst = null): string
    {
        if ($removeFirst !== null) {
            $chain = str_ireplace($removeFirst, '', $chain);
        }

        $chainStack = str_split($chain);
        $outputStack = [];

        foreach ($chainStack as $chainItem) {
            if ($outputStack === []) {
                $outputStack[] = $chainItem;
                continue;
            }
            $last = ord(end($outputStack));
            if (abs($last - ord($chainItem)) === 32) {
                array_pop($outputStack);
            } else {
                array_push($outputStack, $chainItem);
            }
        }

        return implode('', $outputStack);
    }
}
