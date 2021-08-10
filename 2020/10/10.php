<?php
$input = explode("\n", file_get_contents('input.txt'));
#$input = explode("\n", file_get_contents('test-input.txt'));
array_push($input, 0);
array_push($input, max($input) + 3);
sort($input);

function number_of_differences($adapters, $preceding_joltage = 0): array
{
    $diff_count = [1 => 0, 3 => 0];
    for ($i = 0; $i < sizeof($adapters); $i++) {
        $diff = (int)$adapters[$i] - $preceding_joltage;
        if ($diff === 1) {
            $diff_count[1]++;
        }
        if ($diff === 3) {
            $diff_count[3]++;
        }
        $preceding_joltage = (int)$adapters[$i];
    }
    return $diff_count;
}

function distinct_arrangements($adapters): int
{
    $output = (int)max($adapters);
    $distinct = array_fill(0, $output + 1, null);
    $distinct[0] = 1;
    if (in_array(1, $adapters)) {
        $distinct[1] = 1;
    }
    if (in_array(2, $adapters) && in_array(1, $adapters)) {
        $distinct[2] = 2;
    }

    for ($i = 3; $i < $output + 1; $i++) {
        if (!in_array($i, $adapters)) {
            continue;
        }
        $distinct[$i] = $distinct[$i - 3] + $distinct[$i - 2] + $distinct[$i - 1];
    }
    return $distinct[$output];
}

$diff = number_of_differences($input, $outlet_joltage);
echo "Part 1 ==> " . $diff[1] * $diff[3] . PHP_EOL;
echo "Part 2 ==> " . distinct_arrangements($input) . PHP_EOL;
