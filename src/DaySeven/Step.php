<?php


namespace Cheezykins\AdventOfCode\DaySeven;


class Step
{
    protected $name;

    /** @var array|Step[] $parents */
    protected $parents = [];

    protected $resolved = false;

    /** @var Step $next */
    protected $next;

    public function isResolved(): bool
    {
        return $this->resolved;
    }

    public function resolve(): void
    {
        $this->resolved = true;
    }

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    protected function sortParents()
    {
        usort($this->parents, function (Step $a, Step $b) {
            return $a->getName() <=> $b->getName();
        });
    }

    public function addParent(Step $newParent)
    {
        $this->parents[] = $newParent;
        $this->sortParents();
    }

    public function getParentCount(): int
    {
        return count($this->parents);
    }

    /**
     * @return array|Step[]
     */
    public function getParents(): array
    {
        return $this->parents;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $string
     * @throws \Exception
     */
    public static function createOrUpdateFromString(string $string): void
    {
        $matches = [];
        if (preg_match_all('/[sS]tep ([A-Z]{1})/', $string, $matches) == 0) {
            throw new \Exception('Invalid step string: ', $string);
        }
        [$parent, $child] = $matches[1];

        Sleigh::$instructions[$parent] = Sleigh::$instructions[$parent] ?? new Step($parent);
        Sleigh::$instructions[$child] = Sleigh::$instructions[$child] ?? new Step($child);

        Sleigh::$instructions[$child]->addParent(Sleigh::$instructions[$parent]);
    }


}
