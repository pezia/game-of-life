<?php

use \Pezia\Gol\World;
use \Pezia\Gol\Cell;
use \Pezia\Gol\Solver;

$autoloader = require_once __DIR__ . '/vendor/autoload.php';

if ($argc < 2) {
    die('Usage: php ' . basename(__FILE__) . ' <inputfile>' . PHP_EOL);
}

$inputFile = $argv[1];

if (!file_exists($inputFile)) {
    die('Input file not found' . PHP_EOL);
}

$iterationCount = 300;
$squareSize = 5;
$imageWidth = 640;
$imageHeight = 480;
$offsetX = floor($imageWidth / 2);
$offsetY = floor($imageHeight / 2);

//$img = new Imagick();
//$img->newimage($imageWidth, $imageHeight, new ImagickPixel('black'));

$gdImg = imagecreatetruecolor($imageWidth, $imageHeight);
$backgroundColor = imagecolorallocate($gdImg, 255, 255, 255);
$cellColor = imagecolorallocate($gdImg, 0, 0, 0);

imagefill($gdImg, $imageWidth, $imageHeight, $backgroundColor);

$solver = new Solver();

$world = Pezia\Gol\WorldConverter::fromString(file_get_contents($inputFile));

//$draw = new ImagickDraw();
//$draw->setfillcolor(new ImagickPixel('white'));

$generationTimes = array();

for ($i = 0; $i < $iterationCount; $i++) {
//    $frame = new Imagick();
//    $frame->newimage($imageWidth, $imageHeight, new ImagickPixel('black'));
    imagefilledrectangle($gdImg, 0, 0, $imageWidth, $imageHeight, $backgroundColor);

    foreach ($world->getCells() as $cell) {
//        $draw->rectangle($offsetX + $squareSize * $cell->x, $offsetY + $squareSize * $cell->y, $offsetX + $squareSize * ($cell->x + 1), $offsetY + $squareSize * ($cell->y + 1));
        imagefilledrectangle($gdImg, $offsetX + $squareSize * $cell->x, $offsetY + $squareSize * $cell->y, $offsetX + $squareSize * ($cell->x + 1), $offsetY + $squareSize * ($cell->y + 1), $cellColor);
    }
    imagepng($gdImg, __DIR__ . '/images/gol_' . str_pad($i, 3, '0', STR_PAD_LEFT) . '.png');

    //$frame->drawimage($draw);
    //$img->addimage($frame);
    //$frame->writeimages('images/gol_'.  str_pad($i, 3, '0', STR_PAD_LEFT).'.png', true);
    //$frame->destroy();
    $start = microtime(true);
    $world = $solver->getNextWorld($world);
    $generationTimes[] = microtime(true) - $start;
}

echo 'Average generation time: ', array_sum($generationTimes) / count($generationTimes) , PHP_EOL;

//$img->writeimages('images/gol.gif', true);
//$img->destroy();

exec('convert -delay 5 -loop 0 ' . __DIR__ . '/images/gol_*.png output.gif');
