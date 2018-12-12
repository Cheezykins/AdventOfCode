<?php


namespace Cheezykins\AdventOfCode\Day11;


class Grid
{
    /** @var array|Cell[][] $grid */
    protected $grid = [];

    protected $integralGrid = [];

    protected $width;
    protected $height;
    protected $serial;

    public function __construct(int $width, int $height, int $serial)
    {
        $this->width = $width;
        $this->height = $height;
        $this->serial = $serial;
        $this->fillPowerGrid();
    }

    /**
     * Initialise each cell
     */
    protected function fillPowerGrid(): void
    {
        for ($x = 0; $x < $this->width; $x++) {
            for ($y = 0; $y < $this->height; $y++) {
                $this->initialiseCell($x, $y);
            }
        }
    }

    /**
     * Initialise the given cell by setting the power level and integral grid level
     * @param $x
     * @param $y
     */
    protected function initialiseCell($x, $y): void
    {
        $cell = new Cell($x + 1, $y + 1, $this->serial);
        $this->grid[$x][$y] = $cell->getPowerLevel();

        $this->integralGrid[$x][$y] = $cell->getPowerLevel()
            + ($this->integralGrid[$x - 1][$y] ?? 0)
            + ($this->integralGrid[$x][$y - 1] ?? 0)
            - ($this->integralGrid[$x - 1][$y - 1] ?? 0);
    }

    /**
     * Use the integral grid to calculate the sum of power levels for a given cell group coord set
     * @param $x1
     * @param $y1
     * @param $x2
     * @param $y2
     * @return int
     */
    protected function getCellGroupSum($x1, $y1, $x2, $y2): int
    {
        return $this->integralGrid[$x2][$y2]
            - ($this->integralGrid[$x2][$y1] ?? 0)
            - ($this->integralGrid[$x1][$y2] ?? 0)
            + ($this->integralGrid[$x1][$y1] ?? 0);
    }

    /**
     * Itterate through the cell sizes finding the optimum mix of cell size and coordinate
     * @return array
     */
    public function getBestCellGroupSize(): array
    {
        $level = 0;
        $x = 0;
        $y = 0;
        $size = 0;
        for ($i = 1; $i <= $this->width; $i++) {
            [$thisX, $thisY, $thisLevel] = $this->getBestCellGroup($i);
            if ($thisLevel > $level) {
                $level = $thisLevel;
                $x = $thisX;
                $y = $thisY;
                $size = $i;
            }
        }
        return [
            $x,
            $y,
            $level,
            $size
        ];
    }

    /**
     * With a given cell group size find the coordinates of the most powerful group of cells
     * @param int $cellGroupSize
     * @return array
     */
    public function getBestCellGroup(int $cellGroupSize = 3): array
    {
        $level = 0;
        $x = 0;
        $y = 0;
        for ($thisX = 0; $thisX < $this->width - $cellGroupSize; $thisX++) {
            for ($thisY = 0; $thisY < $this->height - $cellGroupSize; $thisY++) {
                $thisLevel = $this->getCellGroupSum($thisX - 1, $thisY -1, $thisX + ($cellGroupSize - 1), $thisY + ($cellGroupSize - 1));
                if ($thisLevel > $level) {
                    $level = $thisLevel;
                    $x = $thisX + 1;
                    $y = $thisY + 1;
                }
            }
        }
        return [
            $x,
            $y,
            $level
        ];
    }
}
