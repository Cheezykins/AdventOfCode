<?php


namespace Cheezykins\AdventOfCode\DayFour;


use Carbon\Carbon;
use Cheezykins\AdventOfCode\DayFour\Exceptions\InvalidEventStringException;

class Event
{
    protected static $pattern = '/^\[(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2})\] (.+)$/';

    /** @var Carbon $timestamp */
    protected $timestamp;

    /** @var string $text */
    protected $text;

    public function __construct(Carbon $timestamp, string $eventText)
    {
        $this->timestamp = $timestamp;
        $this->text = $eventText;
    }

    public static function createFromString(string $text): self
    {
        $text = trim($text);
        $matches = [];
        if (!preg_match(static::$pattern, $text, $matches)) {
            throw new InvalidEventStringException("'{$text}' is not a valid event string");
        }

        $date = Carbon::create($matches[1], $matches[2], $matches[3], $matches[4], $matches[5]);
        return new static($date, $matches[6]);
    }

    public function startsNewShift(): bool
    {
        return preg_match('/Guard #\d+ begins shift/', $this->text);
    }

    /**
     * @return int|null
     */
    public function getGuardId(): ?int
    {
        $matches = [];
        if (!preg_match('/Guard #(\d+) begins shift/', $this->text, $matches)) {
            return null;
        }

        return (int)$matches[1];
    }

    public function getTimeStamp(): Carbon
    {
        return $this->timestamp;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getSleepState(): int
    {
        if ($this->text === 'falls asleep') {
            return 0;
        }
        return 1;
    }


}