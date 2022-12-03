<?php

$input = file_get_contents(__DIR__ . '/test-input.txt');
$input = file_get_contents(__DIR__ . '/input.txt');
$input = explode(PHP_EOL, $input);

$sumOfPriorities = 0;

foreach ($input as $sack) {
    $commonItems = array_unique(
        array_intersect(
            str_split(substr($sack, 0, strlen($sack) / 2)),
            str_split(substr($sack, strlen($sack) / 2))
        )
    );
    array_walk($commonItems, function ($i) {global $sumOfPriorities; $sumOfPriorities += ord($i) - (ctype_upper($i) ? 38 : 96);});
}
echo "Part 1: Sum of priorities: $sumOfPriorities." . PHP_EOL; //7795

$sumOfPriorities = 0;
foreach (array_chunk($input, 3) as $team ) {
    $badge = array_values(array_unique(array_intersect(str_split($team[0]), str_split($team[1]), str_split($team[2]))))[0];
    $sumOfPriorities += ord($badge) - (ctype_upper($badge) ? 38 : 96);
    
}

echo "Part 2: $sumOfPriorities." . PHP_EOL; //2703