<?php

namespace Pezia\Gol\Test;

use Pezia\Gol\WorldConverter;
use Pezia\Gol\Cell;

class WorldConverterTest extends \PHPUnit_Framework_TestCase {

    public function worldConverterDataProvider() {
        return array(
            'empty string' => array('', array()),
            'one cell' => array('x', array(new Cell(0, 0))),
            'two cells' => array('xx', array(new Cell(-1, 0), new Cell(0, 0))),
            'two cells in two lines' => array("x\nx", array(new Cell(0, 0), new Cell(0, -1))),
            'two cells in two lines 2' => array("x\n x", array(new Cell(-1, -1), new Cell(0, 0))),
            'glider' => array(" x\n  x\nxxx", array(
                    new Cell(0, -1),
                    new Cell(1, 0),
                    new Cell(-1, 1), new Cell(0, 1), new Cell(1, 1),
                )),
        );
    }

    /**
     * @dataProvider worldConverterDataProvider
     */
    public function testFromString($input, $worldCells) {
        $world = WorldConverter::fromString($input);
        $cells = $world->getCells();

        foreach ($worldCells as $cell) {
            $this->assertTrue(in_array($cell, $cells));
        }
    }

}
