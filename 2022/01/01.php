<?php

$input = file_get_contents(__DIR__ . '/input.txt');
// $input = file_get_contents(__DIR__ . '/test-input.txt');

$input = explode(PHP_EOL.PHP_EOL, $input);
$data = array_map(
    function ($i) {
        return array_sum(explode(PHP_EOL, $i));
    },
    $input
);

$result = array_keys($data, max($data))[0] + 1;
echo sprintf(
    "The elf carring the most calories is #%s, carrying %s calories.%s",
    $result, max($data), PHP_EOL
);
rsort($data);
echo sprintf(
    "The top three elves carrying the most calories are carrying %s in total.%s",
    $data[0] + $data[1] + $data[2], PHP_EOL
);
