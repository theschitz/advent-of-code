<?php

$input = file_get_contents(__DIR__ . '/input.txt');
// $input = file_get_contents(__DIR__ . '/test-input.txt');

$data = explode(PHP_EOL, $input);

$opponent = ['A' => 'rock', 'B' => 'paper', 'C' => 'scissors'];
$response = ['X' => 'rock', 'Y' => 'paper', 'Z' => 'scissors'];


function score(string $a, string $b): int
{
    $s = 0;
    $s = array_search($a, ['rock', 'paper', 'scissors']) + 1;
    $facit = [
        'rock' => [
            'beatenBy' => ['paper']
        ],
        'paper' => [
            'beatenBy' => ['scissors']
        ],
        'scissors' => [
            'beatenBy' => ['rock']
        ]
    ];
    if (in_array($b, $facit[$a]['beatenBy'])) {
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
    $myResponse = $response[$selected[1]];
    $score += score($myResponse, $opponentSelected);
}
echo "My score: $score." . PHP_EOL;
