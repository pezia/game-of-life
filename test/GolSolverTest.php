<?php

namespace Pezia\Gol\Test;

use Pezia\Gol\Solver;
use Pezia\Gol\World;
use Pezia\Gol\Cell;

class GolSolverTest extends \PHPUnit_Framework_TestCase {

    private $solver;
    private $world;

    public function setUp() {
        $this->solver = new Solver();
        $this->world = new World();
    }

    public function testLonelyCellDies() {
        $this->addCellsToWorld($this->world, array(
            array('x' => 0, 'y' => 0),
        ));

        $nextWorld = $this->solver->getNextWorld($this->world);

        $this->assertFalse($nextWorld->isAlive(new Cell(0, 0)));
    }

    public function testTwoNeighbourCellsDie() {
        $this->addCellsToWorld($this->world, array(
            array('x' => 0, 'y' => 0),
            array('x' => 0, 'y' => 1),
        ));

        $nextWorld = $this->solver->getNextWorld($this->world);

        $this->assertFalse($nextWorld->isAlive(new Cell(0, 0)));
        $this->assertFalse($nextWorld->isAlive(new Cell(0, 1)));
    }

    public function testCellWithTwoNeighboursLiveOn() {
        $this->addCellsToWorld($this->world, array(
            array('x' => 0, 'y' => -1),
            array('x' => 0, 'y' => 0),
            array('x' => 0, 'y' => 1),
        ));

        $nextWorld = $this->solver->getNextWorld($this->world);

        $this->assertTrue($nextWorld->isAlive(new Cell(0, 0)));
        $this->assertFalse($nextWorld->isAlive(new Cell(0, 1)));
    }

    public function testCellWithThreeNeighboursLiveOn() {
        $this->addCellsToWorld($this->world, array(
            array('x' => 0, 'y' => -1),
            array('x' => 0, 'y' => 0),
            array('x' => 0, 'y' => 1),
            array('x' => 1, 'y' => 0),
        ));

        $nextWorld = $this->solver->getNextWorld($this->world);

        $this->assertTrue($nextWorld->isAlive(new Cell(0, 0)));
    }

    public function testCellWithFourNeighboursDie() {
        $this->addCellsToWorld($this->world, array(
            array('x' => 0, 'y' => -1),
            array('x' => 0, 'y' => 0),
            array('x' => 0, 'y' => 1),
            array('x' => 1, 'y' => 0),
            array('x' => -1, 'y' => 0),
        ));

        $nextWorld = $this->solver->getNextWorld($this->world);

        $this->assertFalse($nextWorld->isAlive(new Cell(0, 0)));
    }

    public function testDeadCellWithThreeNeighboursGetAlive() {
        $this->addCellsToWorld($this->world, array(
            array('x' => -1, 'y' => 0),
            array('x' => 0, 'y' => 0),
            array('x' => 1, 'y' => 0),
        ));

        $nextWorld = $this->solver->getNextWorld($this->world);

        $this->assertTrue($nextWorld->isAlive(new Cell(0, 1)));
    }

    private function addCellsToWorld(World $world, array $cells) {
        foreach ($cells as $cell) {
            $world->addCell(new Cell($cell['x'], $cell['y']));
        }
    }

}
