<?php

declare(strict_types=1);

class Position
{
    public int $row;
    public int $col;

    public function __construct(int $row, int $col)
    {
        $this->row = $row;
        $this->col =  $col;
    }
}

$input = explode(PHP_EOL, file_get_contents(__DIR__ . '/' . (isset($argv[1]) ? 'test-' : ''). 'input.txt'));
$map = [];
$currentPos = new Position(0, 0);
$goalPos = new Position(0, 0);

$row = 0;
foreach ($input as $i) {
    $map[] = array_map(
        function ($n) {
            return in_array($n, ['S', 'E']) ? $n: ord($n);
        },
        str_split($i)
    );
    $currentPos = strpos($i, 'S') > -1 ? new Position($row, strpos($i, 'S')) : $currentPos;
    $goalPos = strpos($i, 'E') > -1 ? new Position($row, strpos($i, 'E')) : $goalPos;
    $row++;
}

/**
 * @return Generator<Position>
 */
function neighbors(int $x, int $y): Generator
{
    global $map;
    foreach ([[1,0],[-1, 0], [0, 1], [0, -1]] as $adj) {
        $xx = $adj[0];
        $yy = $adj[1];

        if (!(in_array($xx, range(0, count($map))) && in_array($yy, range(0, count($map[0]))))) {
            continue;
        }

        if ($map[$xx][$yy] <= $map[$x][$y]) {
            yield new Position($xx, $yy);
        }
    }
}


$visited = array_map(
    function ($m) {
        return array_map(
            function ($r) {
                return false;
            },
            $m
        );
    },
    $map
);

$heap = [[0, $currentPos->row, $currentPos->col]];
$steps = 0;
while (true) {
    // steps, i, j = heappop($heap)

    if ($visited[$i, $j]) {
        continue;
    }
    $visited[$i, $j] = true;
    if ((new Position($i, $j)) == $goalPos) {
        echo ">>> $steps";
        break;
    }
    foreach ($variable as $key => $value) {
        # code...
    }
}

