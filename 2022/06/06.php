<?php

declare(strict_types=1);

$input = trim(file_get_contents(__DIR__ . '/' . (isset($argv[1]) ? 'test-' : ''). 'input.txt'));

function startOfPacket(string $string, int $lookAhead = 4): int
{
    for ($i=0; $i < strlen($string); $i++) {
        if (count(array_unique(str_split(substr($string, $i, $lookAhead)))) === $lookAhead) {
            return $i + $lookAhead;
        }
    }
    return 0;
}

echo "Part 01: Characters needed to be processed before the first start-of-packet: " . startOfPacket($input) . PHP_EOL; // 1544
echo "Part 02: Characters needed to be processed before the first start-of-message: " . startOfPacket($input, 14) . PHP_EOL; // 2145
