<?php

declare(strict_types=1);

$input = explode(PHP_EOL . PHP_EOL, file_get_contents(__DIR__ . '/' . (isset($argv[1]) ? 'test-' : ''). 'input.txt'));
$packetPairs = array_map(
    function ($i): array {
        return array_map(
            function ($p): array {
                return eval("return $p;");
            },
            explode(PHP_EOL, $i)
        );
    },
    $input
);

// print_r($packetPairs[0]);
function isCorrectOrder(array $left, array $right): bool
{
    if (count($right) < count($left)) {
        return false;
    }
    for ($i=0; $i < count($right); $i++) {
        if (!isset($left[$i])) {
            echo "not set left $i" . PHP_EOL;
            return true;
        }
        
        if (!is_array($left[$i]) && is_array($right[$i])) {
            return isCorrectOrder([$left[$i]], $right[$i]);
        }
        if (is_array($left[$i]) && !is_array($right[$i])) {
            return isCorrectOrder($left[$i], [$right[$i]]);
        }
        if (is_array($left[$i]) && is_array($right[$i])) {
            return isCorrectOrder($left[$i], $right[$i]);
        }
        if ($left[$i] > $right[$i]) {
            return false;
        }
    }
    return true;
}
$sum = 0;
$pairNo = 1;
foreach ($packetPairs as $pair) {
    echo "Pair ==$pairNo==" . PHP_EOL;
    $left = (array)$pair[0];
    $right = (array)$pair[1];
    $orderIsCorrect = isCorrectOrder($left, $right);
    $sum += $orderIsCorrect ? $pairNo : 0;
    if ($orderIsCorrect) {
        echo "Correct Pair ==$pairNo== $sum" . PHP_EOL;
    }
    if (!in_array($pairNo, [1, 2, 4, 6]) && $orderIsCorrect) {
        print_r($left);
        print_r($right);
    }
    $pairNo++;
}

echo "Sum: $sum" . PHP_EOL;