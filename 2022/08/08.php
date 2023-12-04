<?php

declare(strict_types=1);

$grid = array_map(function ($line) { return str_split($line); }, explode(PHP_EOL, file_get_contents(__DIR__ . '/' . (isset($argv[1]) ? 'test-' : ''). 'input.txt')));
$edges = (count($grid) -1) * 4;
$visibleTrees = 0;
// var_dump($grid);

function visibleSides(int $posX, int $posY, $grid): int
{
    $length = (int)$grid[$posX][$posY];
    $visibleSides = 4;
    for ($y=0; $y < count($grid[0]); $y++) {
        if ($y === $posY) {
            continue;
        }
        if ($grid[$posX][$y] > $length) {
            $visibleSides -= 1;
            break;
        }
    }
    for ($y=$posY; $y < count($grid[0]); $y++) {
        if ($y === $posY) {
            continue;
        }
        if ($grid[$posX][$y] > $length) {
            $visibleSides -= 1;
            break;
        }
    }
    for ($x=0; $x < count($grid[0]); $x++) {
        if ($x === $posX) {
            continue;
        }
        if ($grid[$x][$posY] > $length) {
            $visibleSides -= 1;
        }
    }
    for ($x=$posX; $x < count($grid[0]); $x++) {
        if ($x === $posX) {
            continue;
        }
        if ($grid[$x][$posY] > $length) {
            $visibleSides -= 1;
        }
    }
    return $visibleSides;
}

for ($x=0; $x < count($grid); $x++) { 
    for ($y=0; $y < count($grid[0]); $y++) {
        // echo "X: $x Y: $y" . PHP_EOL;
        $visibleTrees += visibleSides($x, $y, $grid) === 4 ? 1 : 0;
    }
}

$visibleTrees = $visibleTrees + $edges;

echo "Part 1: No of trees visible: $visibleTrees." , PHP_EOL;