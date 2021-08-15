<?php
#$input = explode("\n", file_get_contents('test-input.txt'));
$input = explode("\n", file_get_contents('input.txt'));
$seat_map = [];
foreach ($input as $l) {
    array_push($seat_map, str_split($l));
}

function is_floor($c): bool
{
    return $c === '.';
}

function is_occupied($c): bool
{
    return $c === '#';
}

function is_empty_seat($c): bool
{
    return $c === 'L';
}

function occupied_adjecent($map, $y, $x): int
{
    $occupied = 0;
    $neighbors = [
        ["y" => -1, "x" => 0],
        ["y" => -1, "x" => -1],
        ["y" => -1, "x" => 1],
        ["y" => 0, "x" => -1],
        ["y" => 0, "x" => 1],
        ["y" => 1, "x" => 1],
        ["y" => 1, "x" => 0],
        ["y" => 1, "x" => -1],
    ];
    foreach ($neighbors as $n) {
        $posY = $y + $n["y"];
        $posX = $x + $n["x"];
        if (isset($map[$posY][$posX])) {
            $occupied += is_occupied($map[$posY][$posX]) ? 1 : 0;
        }
    }
    return $occupied;
}

function step($map)
{
    $new_map = $map;
    for ($y = 0; $y < sizeof($map); $y++) {
        for ($x = 0; $x < sizeof($map[$y]); $x++) {
            if (is_floor($map[$y][$x])) {
                continue;
            }
            $seat = $map[$y][$x];
            if (is_empty_seat($seat) && (occupied_adjecent($map, $y, $x) === 0)) {
                $seat = '#';
            } else if (is_occupied($seat) && (occupied_adjecent($map, $y, $x) >= 4)) {
                $seat = 'L';
            }
            $new_map[$y][$x] = $seat;
        }
    }
    return $new_map;
}

function count_occupied_seats($map)
{
    $occupied_seats = 0;
    foreach ($map as $row) {
        $occupied_seats += count(
            array_filter(
                $row,
                'is_occupied'
            )
        );
    }
    return $occupied_seats;
}

function final_seat_map($map)
{
    $next_seat_map = [];
    while (true) {
        $next_seat_map = step($map);
        if ($next_seat_map === $map) {
            break;
        }
        $map = $next_seat_map;
    }
    return $next_seat_map;
}

$seat_map = final_seat_map($seat_map);
echo "Part 1 ==> " . count_occupied_seats($seat_map) . PHP_EOL;
