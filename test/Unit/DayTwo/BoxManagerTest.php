<?php


namespace Cheezykins\AdventOfCode\Test\Unit\DayTwo;


use Cheezykins\AdventOfCode\DayTwo\BoxManager;
use PHPUnit\Framework\TestCase;

class BoxManagerTest extends TestCase
{
    public function testHashesWorks()
    {
        $ids = [
            'abcdef',
            'bababc',
            'abbcde',
            'abcccd',
            'aabcdd',
            'abcdee',
            'ababab'
        ];

        $manager = new BoxManager();
        $manager->addBoxes($ids);
        $this->assertEquals(12, $manager->calculateChecksum());
    }

    public function testFindRelatedworks()
    {
        $ids = [
            'abcde',
            'fghij',
            'klmno',
            'pqrst',
            'fguij',
            'axcye',
            'wvxyz',
        ];

        $expected = [
            'fghij',
            'fguij'
        ];

        $manager = new BoxManager();
        $manager->addBoxes($ids);
        $results = $manager->findRelatedIds();
        $this->assertEquals($expected, $results);
    }

    public function testCommonCharacterChecks()
    {
        $ids = [
            'abcde',
            'fghij',
            'klmno',
            'pqrst',
            'fguij',
            'axcye',
            'wvxyz',
        ];

        $expected = 'fgij';

        $manager = new BoxManager();
        $manager->addBoxes($ids);
        [$first, $second] = $manager->findRelatedIds();
        $results = $manager->computeSimilarities($first, $second);
        $this->assertEquals($expected, $results);
    }
}