<?php

declare(strict_types=1);

$input = file_get_contents(__DIR__ . '/input.txt');
// $input = file_get_contents(__DIR__ . '/test-input.txt');

$data = explode(PHP_EOL, $input);

$opponent = ['A' => 'rock', 'B' => 'paper', 'C' => 'scissors'];
$response = ['X' => 'rock', 'Y' => 'paper', 'Z' => 'scissors'];
$facit = [
    'rock' => [
        'beatenBy' => 'paper'
    ],
    'paper' => [
        'beatenBy' => 'scissors'
    ],
    'scissors' => [
        'beatenBy' => 'rock'
    ]
];

function score(string $a, string $b): int
{
    global $facit;
    $s = 0;
    $s = array_search($a, ['rock', 'paper', 'scissors']) + 1;
    if ($b === $facit[$a]['beatenBy']) {
        $s += 0;
    } elseif ($a === $b) {
        $s += 3;
    } else {
        $s += 6;
    }
    return $s;
}

$score = 0;
foreach ($data as $round) {
    $selected = explode(' ', $round);
    $opponentSelected = $opponent[$selected[0]];
    $roundScore = 0;
    $mySelection = '';
    switch ($selected[1]) {
    case 'X':
        foreach ($facit as $key => $value) {
            if ($opponentSelected === $value['beatenBy']) {
                $mySelection = $key;
            }
        }
        break;
    case 'Y':
        $mySelection = $opponentSelected;
        break;
    case 'Z':
        $mySelection = $facit[$opponentSelected]['beatenBy'];
        break;
    }
    $score += score($mySelection, $opponentSelected);
}
echo "My score: $score." . PHP_EOL;
