<?php

namespace Pezia\Gol;

use Pezia\Gol\World;

class WorldConverter {

    public static function fromString($input) {
        $world = new World();

        $lines = explode("\n", $input);

        $maxLineLength = array_reduce($lines, function (&$result, $item) {
            $result = max($result, strlen($item));
            return $result;
        }, 0);

        $offsetX = floor($maxLineLength / 2);
        $offsetY = floor(count($lines) / 2);

        $lineNumber = 0;

        foreach ($lines as $line) {
            $characterNumber = 0;
            $lineLength = strlen($line);
            for ($characterNumber = 0; $characterNumber < $lineLength; $characterNumber++) {
                if ($line[$characterNumber] === 'x') {
                    $world->addCell(new Cell($characterNumber - $offsetX, $lineNumber - $offsetY));
                }
            }
            $lineNumber++;
        }
        return $world;
    }

}
