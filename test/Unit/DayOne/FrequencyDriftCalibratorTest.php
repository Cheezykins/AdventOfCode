<?php


namespace Cheezykins\AdventOfCode\Test\Unit\DayOne;


use Cheezykins\AdventOfCode\DayOne\FrequencyDriftCalibrator;
use PHPUnit\Framework\TestCase;

class FrequencyDriftCalibratorTest extends TestCase
{
    public function testInitialisationFrequencyIsSetFromConstructor()
    {
        $calibrator = new FrequencyDriftCalibrator();
        $this->assertEquals(0, $calibrator->getFrequency());

        $calibrator = new FrequencyDriftCalibrator(10);
        $this->assertEquals(10, $calibrator->getFrequency());
    }

    public function testSetBaseFrequencySetsTheFrequency()
    {
        $calibrator = new FrequencyDriftCalibrator();
        $this->assertEquals(0, $calibrator->getFrequency());
        $calibrator->setFrequency(10);
        $this->assertEquals(10, $calibrator->getFrequency());
    }

    public function testAddIncrementIncrementsFrequency()
    {
        $calibrator = new FrequencyDriftCalibrator();
        $calibrator->inputFrequencyChanges([
            '+1'
        ]);
        $this->assertEquals(1, $calibrator->getFrequency());
    }

    public function testMinusDecrementsFreqency()
    {
        $calibrator = new FrequencyDriftCalibrator();
        $calibrator->inputFrequencyChanges([
            '-1'
        ]);
        $this->assertEquals(-1, $calibrator->getFrequency());
    }

    public function testCombinationWorks()
    {
        $calibrator = new FrequencyDriftCalibrator();
        $calibrator->inputFrequencyChanges([
            '-5',
            '+2',
            '+3',
            '+10',
            '-5'
        ]);
        $this->assertEquals(5, $calibrator->getFrequency());
    }

    public function testDuplicatedFrequencyDetected()
    {
        $calibrator = new FrequencyDriftCalibrator();
        $calibrator->inputFrequencyChanges([
            '+1',
            '-1'
        ]);
        $this->assertEquals(0, $calibrator->findDuplicatedFrequency());
        $calibrator->inputFrequencyChanges([
            '+3',
            '+3',
            '+4',
            '-2',
            '-4'
        ]);
        $this->assertEquals(10, $calibrator->findDuplicatedFrequency(0));
        $calibrator->inputFrequencyChanges([
            '-6',
            '+3',
            '+8',
            '+5',
            '-6'
        ]);
        $this->assertEquals(5, $calibrator->findDuplicatedFrequency(0));
        $calibrator->inputFrequencyChanges([
            '+7', '+7', '-2', '-7', '-4'
        ]);
        $this->assertEquals(14, $calibrator->findDuplicatedFrequency(0));
    }

    public function testDuplicatedFrequencyDetectionCanOverrideStartFrequency()
    {
        $calibrator = new FrequencyDriftCalibrator();
        $calibrator->inputFrequencyChanges([
            '+1',
            '-1',
        ]);
        $this->assertEquals(10, $calibrator->findDuplicatedFrequency(10));
    }

}