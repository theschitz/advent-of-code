<?php

$test = ($argv[1] ?? '') === '-t' ? 'test-' : '';
$inputPath = __DIR__ . "/{$test}input.txt";
$input = explode(PHP_EOL, file_get_contents($inputPath));

function parseGames(array $data)
{
    $maxCubes = [
        'red' => 12,
        'green' => 13,
        'blue' => 14
    ];
    $id = 1;
    $games = [];
    foreach ($data as $g) {
        $game = [
            'id' => $id,
            'valid' => false,
            'sets' => [],
            'minSet' => ['red' => 0, 'green' => 0, 'blue' => 0]
        ];
        $g = trim(substr($g, strpos($g, ':') +1));
        foreach (explode(';', $g) as $set) {
            foreach (explode(',', $set) as $cubes) {
                $cubes = explode(' ', trim($cubes));
                $number = $cubes[0];
                $color = $cubes[1];
                $game['sets'][] = [
                    $color => (int) $number,
                    'valid' => (int)$number <= $maxCubes[$color],
                ];
                $game['minSet'][$color] = $game['minSet'][$color] < $number
                    ? $number
                    : $game['minSet'][$color];
            }
        }
        $id++;
        $games[] = $game;
    }
    echo "Part 1: ", array_sum(
        array_column(
            array_filter(
                $games,
                function ($g) {
                    return count(
                        array_filter(
                            $g['sets'],
                            function ($s) {
                                return $s['valid'] === true;
                            }
                        )
                    ) === count($g['sets']);
                }
            ),
            'id'
        )
    ), PHP_EOL;
    array_walk(
        $games,
        function (&$g) {
            $g['power'] = array_product(array_values($g['minSet']));
        }
    );
    echo "Part 2: ", array_sum(array_column($games, 'power')), PHP_EOL; 
}

parseGames($input);