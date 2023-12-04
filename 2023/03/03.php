<?php

$test = ($argv[1] ?? '') === '-t' ? 'test-' : '';
$inputPath = __DIR__ . "/{$test}input";
$schema = [];
foreach (explode(PHP_EOL, file_get_contents($inputPath)) as $line) {
    $schema[] = str_split($line);
}

$numbers = [];
foreach ($schema as $r => $line) {
    $n = '';
    foreach ($line as $c => $char) {
        $n .= is_numeric($char) ? $char : '';
        if (!empty($n) && !is_numeric($char)) {
            $adjacent = false;
            for ($i=1; $i = strlen($n); $i) { 
            }
            if ($adjacent) {
                $numbers[] = $n;
            }
            $n = '';
        } 
    }
}

echo "Part 1: ", array_sum($numbers);