<?php


namespace Cheezykins\AdventOfCode\DayFive;


class Polymer
{
    /** @var string $chain */
    protected $chain;

    /** @var string|null $activated */
    protected $activated;

    /** @var string|null $optimal */
    protected $optimal;

    public function __construct(string $chain)
    {
        $this->chain = $chain;
    }

    public function optimize(): ?int
    {
        $letters = range('a', 'z');
        $minimal = null;

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
        $this->activated = self::reduce($this->chain);
        return strlen($this->activated);
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
