<?php

declare(strict_types=1);

$test = ($argv[1] ?? '') === '-t' ? 'test-' : '';
$inputPath = __DIR__ . "/{$test}input";
$input = explode(PHP_EOL, file_get_contents($inputPath));
$scratchCards = [];
foreach ($input as $line) {
    preg_match_all('/(?<id>[0-9]{1,}): (?<ticketNumbers>.*) \| (?<winningNumbers>.*)/', $line, $matches, PREG_SET_ORDER);
    $cardId = $matches[0]['id'];
    $ticketNumbers = preg_split('/\s/', str_replace('  ', ' ', trim($matches[0]["ticketNumbers"])));
    $winningNumbers = preg_split('/\s/', str_replace('  ', ' ', trim($matches[0]["winningNumbers"])));
    unset($matches);
    $cardScore = 0;
    foreach ($ticketNumbers as $number) {
        if (in_array((string)$number, $winningNumbers, true)) {
            $cardScore = $cardScore === 0 ? 1 : $cardScore * 2;
        }
    }
    $scratchCards[(int)$cardId] = [
        'ticketNumbers' => $ticketNumbers,
        'winningNumbers' => $winningNumbers,
        'score' => $cardScore,
    ];
}
echo "Part 1: ", array_sum(array_column($scratchCards, 'score')), PHP_EOL;

