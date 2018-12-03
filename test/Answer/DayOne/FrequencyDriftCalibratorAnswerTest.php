<?php


namespace Cheezykins\AdventOfCode\Test\Answer\DayOne;


use Cheezykins\AdventOfCode\DayOne\FrequencyDriftCalibrator;
use PHPUnit\Framework\TestCase;

class FrequencyDriftCalibratorAnswerTest extends TestCase
{
    public function testInputGivesCorrectPartOneAnswer()
    {
        $fixtures = file(__DIR__ . '/fixtures/input_frequencies.txt');

        $calibrator = new FrequencyDriftCalibrator();
        $calibrator->inputFrequencyChanges($fixtures);
        $this->assertEquals(502, $calibrator->getFrequency());
    }

    public function testInputGivesCorrectPartTwoAnswer()
    {
        $fixtures = file(__DIR__ . '/fixtures/input_frequencies.txt');

        $calibrator = new FrequencyDriftCalibrator();
        $calibrator->inputFrequencyChanges($fixtures);
        $this->assertEquals(71961, $calibrator->findDuplicatedFrequency(0));
    }
}