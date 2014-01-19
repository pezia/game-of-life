<?php

namespace Pezia\Gol;

class Cell {

    public $x;
    public $y;

    public function __construct($x, $y) {
        $this->x = $x;
        $this->y = $y;
    }

    public function getNeighbours() {
        return array(
            //prev line
            new Cell($this->x - 1, $this->y - 1),
            new Cell($this->x, $this->y - 1),
            new Cell($this->x + 1, $this->y - 1),
            //same line
            new Cell($this->x - 1, $this->y),
            new Cell($this->x + 1, $this->y),
            //next line
            new Cell($this->x - 1, $this->y + 1),
            new Cell($this->x, $this->y + 1),
            new Cell($this->x + 1, $this->y + 1),
        );
    }

    public function __toString() {
        return '[' . $this->x . ';' . $this->y . ']';
    }

}
