<?php

namespace Pezia\Gol;

class Solver {

    /**
     * Get the world with the next generation
     *
     * @param \Pezia\Gol\World $world
     * @return \Pezia\Gol\World
     */
    public function getNextWorld(World $world) {
        $newWorld = new World();

        foreach ($world->getCells() as $cell) {
            if (in_array($world->getLivingNeighbourCount($cell), array(2, 3))) {
                $newWorld->addCell($cell);
            }
        }

        foreach ($world->getPossibleBirthCells() as $cell) {
            if ($world->getLivingNeighbourCount($cell) === 3) {
                $newWorld->addCell($cell);
            }
        }

        return $newWorld;
    }

}
