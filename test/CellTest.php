<?php

namespace Pezia\Gol\Test;

use Pezia\Gol\Cell;

class CellTest extends \PHPUnit_Framework_TestCase {

    private $cell;

    public function setUp() {
        $this->cell = new Cell(0, 0);
    }

    public function testGetNeighbours() {
        $neighbours = $this->cell->getNeighbours();

        $this->assertEquals(array(
            //under
            new Cell(-1, -1),
            new Cell(0, -1),
            new Cell(1, -1),
            //same line
            new Cell(-1, 0),
            new Cell(1, 0),
            //over
            new Cell(-1, 1),
            new Cell(0, 1),
            new Cell(1, 1)), $neighbours);
    }

}
