<?php

function find_row(string $boarding_pass): int {
    $row = 0;
    $c = '';
    for ($i=0; $i < 7; $i++) { 
        $c = $boarding_pass[$i];
        $multiplier = 2 ** (6 - $i);
        $b = $c === 'B' ? 1 : 0;
        $row += $multiplier * $b;
    }
    return $row;
}

function find_column(string $boarding_pass): int {
    $col = 0;
    $c = '';
    $bp = substr($boarding_pass, 7, 10);
    for ($i=0; $i < 3; $i++) {
        $c = $bp[$i];
        $multiplier = 2 ** (2 - $i);
        $b = $c === 'R' ? 1 : 0;
        $col += $multiplier * $b;
    }
    return $col;
}

function find_seat_id(string $boarding_pass): int {
    $row = find_row($boarding_pass);
    $col = find_column($boarding_pass);
    return $row * 8 + $col;
}

// echo "\nSeatID: ". find_seat_id('FBFBBFFRLR')."\n"; //  row 44, column 5, seat ID 357.
// echo "\nSeatID: ". find_seat_id('BFFFBBFRRR')."\n"; // row 70, column 7, seat ID 567.
// echo "\nSeatID: ". find_seat_id('FFFBBBFRRR')."\n"; // row 14, column 7, seat ID 119.
// echo "\nSeatID: ". find_seat_id('BBFFBBFRLL')."\n"; // row 102, column 4, seat ID 820.

$input = explode("\n", file_get_contents('input.txt'));
$seat_ids = [];
foreach ($input as $value) {
    $id = find_seat_id($value);
    array_push($seat_ids, $id);
    array_multisort($seat_ids);
}

// Part 1
echo "Largest id: ". max($seat_ids) ."\n"; // 822

// Part 2
for ($a=0; $a < sizeof($seat_ids); $a++) {
    $nextSid =  $seat_ids[$a] + 1;
    if ($nextSid !== $seat_ids[$a+1]) {
        echo "Your seat: ". $nextSid ."\n"; // 705
        break;
    }
}
?>