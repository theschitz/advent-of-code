<?php

$input = explode(PHP_EOL, file_get_contents(__DIR__ . '/' . (isset($argv[1]) ? 'test-' : ''). 'input.txt'));

$input = array_map(function ($i) { return [explode('-', explode(',', $i)[0]), explode('-', explode(',', $i)[1])];}, $input);
$fullyOverlapped = 0;
$overlapped = 0;
foreach ($input as $sections) {
    $a = range($sections[0][0], $sections[0][1]);
    $b = range($sections[1][0], $sections[1][1]);
    $fullyOverlapped += (empty(array_diff($a, $b)) || empty(array_diff($b, $a))) ? 1 : 0;
    $overlapped += count(array_unique(array_merge($a, $b))) < (count($a) + count($b)) ? 1 : 0;
}

echo "Part 01: Fully overlapped assignment pairs: $fullyOverlapped." . PHP_EOL; // 644
echo "Part 02: Overlapping pairs: $overlapped." . PHP_EOL; // 926