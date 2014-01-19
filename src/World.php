<?php

namespace Pezia\Gol;

class World {

    /**
     * @var Pezia\Gol\Cell[]
     */
    private $cells = array();

    public function addCell(Cell $cell) {
        if (!$this->isAlive($cell)) {
            $this->cells[] = $cell;
        }
        return $this;
    }

    public function getCells() {
        return $this->cells;
    }

    public function isAlive(Cell $cell) {
        return in_array($cell, $this->cells);
    }

    public function getLivingNeighbourCount(Cell $cell) {
        $neighbourCount = 0;

        foreach ($cell->getNeighbours() as $neighbour) {
            if ($this->isAlive($neighbour)) {
                $neighbourCount++;
            }
        }

        return $neighbourCount;
    }

    public function getPossibleBirthCells() {
        $possibleBirthCells = array();

        foreach ($this->cells as $cell) {
            foreach ($cell->getNeighbours() as $neighbour) {
                if (!$this->isAlive($neighbour)) {
                    $possibleBirthCells[] = $neighbour;
                }
            }
        }

        return $possibleBirthCells;
    }

}
