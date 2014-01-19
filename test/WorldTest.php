<?php

namespace Pezia\Gol\Test;

use Pezia\Gol\World;
use Pezia\Gol\Cell;

class WorldTest extends \PHPUnit_Framework_TestCase {

    private $world;

    public function setUp() {
        $this->world = new World();
    }

    public function testEmptyByDefault() {
        $this->assertCount(0, $this->world->getCells());
    }

    public function testAddCellWithOneCell() {
        $this->world->addCell(new Cell(0, 0));

        $this->assertCount(1, $this->world->getCells());
    }

    public function testAddCellWithTwoCells() {
        $this->world->addCell(new Cell(0, 0));
        $this->world->addCell(new Cell(0, 1));

        $this->assertCount(2, $this->world->getCells());
    }

    public function testAddCellDoesNotDuplicate() {
        $this->world->addCell(new Cell(0, 0));
        $this->world->addCell(new Cell(0, 0));

        $this->assertCount(1, $this->world->getCells());
    }

    public function testIsAlive() {
        $this->world->addCell(new Cell(0, 0));

        $this->assertTrue($this->world->isAlive(new Cell(0, 0)));
    }

    public function testGetLivingNeighbourCount() {
        $this->world->addCell(new Cell(0, 0));
        $this->world->addCell(new Cell(0, 1));

        $this->assertEquals(0, $this->world->getLivingNeighbourCount(new Cell(0, -2)));
        $this->assertEquals(1, $this->world->getLivingNeighbourCount(new Cell(0, -1)));
        $this->assertEquals(2, $this->world->getLivingNeighbourCount(new Cell(-1, 0)));
    }

    public function testGetPossibleBirthCells() {
        $this->world->addCell(new Cell(0, 0));
        $this->world->addCell(new Cell(1, 0));

        $possibleBirthCells = $this->world->getPossibleBirthCells();

        /**
         *    ++++
         *    +xx+
         *    ++++
         */
        foreach (
        array(
            //under
            new Cell(-1, -1),
            new Cell(0, -1),
            new Cell(1, -1),
            new Cell(2, -1),
            //same line
            new Cell(-1, 0),
            new Cell(2, 0),
            //over
            new Cell(-1, 1),
            new Cell(0, 1),
            new Cell(1, 1),
            new Cell(2, 1)) as $cell) {
            $this->assertTrue(in_array($cell, $possibleBirthCells));
        }
    }

}
