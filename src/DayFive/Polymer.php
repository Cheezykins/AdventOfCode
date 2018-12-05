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

    public function determineBestReactant(): ?string
    {

        $fullChain = $this->chain;
        $letters = range('a', 'z');
        $counts = array_fill_keys($letters, null);
        $strings = array_fill_keys($letters, '');

        foreach ($letters as $letter) {
            if (stripos($this->chain, $letter) === false) {
                unset($counts[$letter]);
                unset($strings[$letter]);
                continue;
            }
            $this->chain = str_ireplace($letter, '', $this->chain);
            $this->activate();
            $length = strlen($this->activated);
            $counts[$letter] = $length;
            $strings[$letter] = $this->activated;
            $this->chain = $fullChain;
        }

        if (count($counts) === 0) {
            return null;
        }

        $letter = array_keys($counts, min($counts))[0];
        $this->optimal = $strings[$letter];
        return $letter;
    }

    public function activate(): void
    {
        $chain = $this->chain;
        $comparison = null;
        while ($comparison !== $chain) {
            $comparison = $chain;
            $chain = str_split($chain);
            for ($i = 0; $i < count($chain) - 1; $i++) {

                if (strtoupper($chain[$i]) !== strtoupper($chain[$i + 1]) || $chain[$i] === $chain[$i + 1]) {
                    continue;
                }

                unset($chain[$i]);
                unset($chain[$i + 1]);
                $chain = array_values($chain);
            }
            $chain = implode('', $chain);
        }

        $this->activated = $chain;
    }

    /**
     * @return string
     */
    public function getChain(): string
    {
        return $this->chain;
    }

    /**
     * @return string|null
     */
    public function getActivatedChain(): ?string
    {
        return $this->activated;
    }

    /**
     * @return string|null
     */
    public function getOptimalChain(): ?string
    {
        return $this->optimal;
    }
}
