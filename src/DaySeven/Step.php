<?php


namespace Cheezykins\AdventOfCode\DaySeven;


class Step
{
    protected $name;

    /** @var array|Step[] $requirements */
    protected $requirements = [];

    protected $resolved = false;
    protected $assigned = false;

    protected $duration;
    protected $remaining;

    /** @var Step $next */
    protected $next;

    public function assign(): void
    {
        $this->assigned = true;
    }

    public function isAssigned(): bool
    {
        return $this->assigned;
    }

    public function isResolved(): bool
    {
        return $this->resolved;
    }

    public function resolve(): void
    {
        $this->resolved = true;
    }

    public function __construct(string $name, int $baseDuration = 60)
    {
        $this->name = $name;
        $this->duration = $baseDuration + (ord($name) - 64);
        $this->remaining = $this->duration;
    }

    public function addRequirement(Step $newParent)
    {
        $this->requirements[] = $newParent;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function allRequirementsResolved(): bool
    {
        foreach ($this->requirements as $requirement) {
            if (!$requirement->isResolved()) {
                return false;
            }
        }
        return true;
    }

    public function tick(): int
    {
        return --$this->remaining;
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
     * @param int $baseDuration
     * @throws \Exception
     */
    public static function createOrUpdateFromString(string $string, int $baseDuration = 60): void
    {
        $matches = [];
        if (preg_match_all('/[sS]tep ([A-Z]{1})/', $string, $matches) == 0) {
            throw new \Exception('Invalid step string: ', $string);
        }
        [$requirement, $requirer] = $matches[1];

        Sleigh::$instructions[$requirement] = Sleigh::$instructions[$requirement] ?? new Step($requirement, $baseDuration);
        Sleigh::$instructions[$requirer] = Sleigh::$instructions[$requirer] ?? new Step($requirer, $baseDuration);

        Sleigh::$instructions[$requirer]->addRequirement(Sleigh::$instructions[$requirement]);

    }

    public function __toString()
    {
        return $this->name . ': ' . $this->remaining;
    }


}
