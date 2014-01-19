<?php

use Pezia\Gol\World;
use \Pezia\Gol\Cell;
use \Pezia\Gol\Solver;

$autoloader = require_once __DIR__ . '/vendor/autoload.php';

$squareSize = 5;
$offsetX = 320;
$offsetY = 240;

//$img = new Imagick();
//$img->newimage(640, 480, new ImagickPixel('black'));

$gdImg = imagecreatetruecolor(640, 480);
$backgroundColor = imagecolorallocate($gdImg, 0, 0, 0);
$cellColor = imagecolorallocate($gdImg, 255, 255, 25);

imagefill($gdImg, 640, 480, $backgroundColor);

$solver = new Solver();

$world = new World();
$world->addCell(new Cell(0, 0));
$world->addCell(new Cell(0, 1));
$world->addCell(new Cell(0, 2));
$world->addCell(new Cell(1, 1));

//$draw = new ImagickDraw();
//$draw->setfillcolor(new ImagickPixel('white'));

for ($i = 0; $i < 30; $i++) {
//    $frame = new Imagick();
//    $frame->newimage(640, 480, new ImagickPixel('black'));
    imagefilledrectangle($gdImg, 0, 0, 640, 480, $backgroundColor);

    foreach ($world->getCells() as $cell) {
//        $draw->rectangle($offsetX + $squareSize * $cell->x, $offsetY + $squareSize * $cell->y, $offsetX + $squareSize * ($cell->x + 1), $offsetY + $squareSize * ($cell->y + 1));
        imagefilledrectangle($gdImg, $offsetX + $squareSize * $cell->x, $offsetY + $squareSize * $cell->y, $offsetX + $squareSize * ($cell->x + 1), $offsetY + $squareSize * ($cell->y + 1), $cellColor);
    }
    imagepng($gdImg, 'images/gol_' . str_pad($i, 3, '0', STR_PAD_LEFT) . '.png');

    //$frame->drawimage($draw);
    //$img->addimage($frame);
    //$frame->writeimages('images/gol_'.  str_pad($i, 3, '0', STR_PAD_LEFT).'.png', true);
    //$frame->destroy();
    $world = $solver->getNextWorld($world);
}

//$img->writeimages('images/gol.gif', true);
//$img->destroy();

exec('convert -delay 20 -loop 0 images/gol_*.png output.gif');