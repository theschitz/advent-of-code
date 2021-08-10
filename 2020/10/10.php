<?php
$input = explode("\n", file_get_contents('input.txt'));
#$input = explode("\n", file_get_contents('test-input.txt'));

function number_of_differences($adapters, $preceding_joltage = 0): array
{
    $device_joltage = (int)max($adapters) + 3;
    $diff_count = [1 => 0, 3 => 0];
    sort($adapters);
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
    $diff_count[3]++; // device
    return $diff_count;
}

$diff = number_of_differences($input, $outlet_joltage);
echo "Part 1 ==> " . $diff[1] * $diff[3] . PHP_EOL;
