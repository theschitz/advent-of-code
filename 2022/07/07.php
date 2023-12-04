<?php

declare(strict_types=1);

$input = explode(PHP_EOL, file_get_contents(__DIR__ . '/' . (isset($argv[1]) ? 'test-' : ''). 'input.txt'));

function parseCommands(int $pos, array $input, $max = 100000): int
{
    $sum = 0;
    for ($i=$pos; $i < count($input); $i++) {
        $cmd = explode(' ', $input[$i]);
        // var_dump($cmd);
        if ($cmd[1] == 'ls') {
            continue;
        }
        if (is_numeric($cmd[0])) {
            $sum += (int)$cmd[0];
        }
        if ($cmd[1] === 'cd') {
            return parseCommands($pos, $input);
            // $sum += $innerSum <= $max ? $innerSum : 0;
            // return $innerSum;
        }
        if (isset($cmd[2]) && $cmd[2] === '..') {
            return $sum;
        }
    }
    return $sum;
}
$pos = 1;
$result = parseCommands($pos, $input);
var_dump($result);
echo "Part 1: Sum of file sizes: ". $result . PHP_EOL;