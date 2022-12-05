<?php

declare(strict_types=1);

$input = explode(PHP_EOL . PHP_EOL, file_get_contents(__DIR__ . '/' . (isset($argv[1]) ? 'test-' : ''). 'input.txt'));

function parseStacks(array $stacks)
{
    array_pop($stacks);
    $result = [];
    foreach ($stacks as $s) {
        for ($i=0; $i < strlen($stacks[0]) / 4; $i++) {
            if (trim(substr($s, $i * 4, 3))) {
                $result[$i + 1][] = trim(substr($s, $i * 4, 3));
            }
        }
    }
    return $result;
}

function parseInstructions(array $instructions)
{
    $result = [];
    foreach ($instructions as $inst) {
        $result[] = [
            'move' => (int)trim(substr($inst, 4, strpos($inst, 'from') - 4)),
            'from' => (int)trim(substr($inst, strpos($inst, 'from') + 5, strpos($inst, 'to') - strpos($inst, 'from') - 5)),
            'to' => (int)trim(substr($inst, strpos($inst, 'to') + 2)),
        ];
    }
    return $result;
}

function crateMover(string $crateMoverModel, array $input): string
{
    $stacks = parseStacks(explode(PHP_EOL, $input[0]));
    $instructions = parseInstructions(explode(PHP_EOL, $input[1]));
    foreach ($instructions as $inst) {
        if ($crateMoverModel === "9001") {
            $crates = array_slice($stacks[$inst['from']], 0, $inst['move']);
            $stacks[$inst['to']] = array_merge($crates, $stacks[$inst['to']]);
            for ($i=0; $i < $inst['move']; $i++) {
                unset($stacks[$inst['from']][0]);
                $stacks[$inst['from']] = array_Values($stacks[$inst['from']]);
            }
        } else {
            for ($i=0; $i < $inst['move']; $i++) {
                $stacks[$inst['to']] = array_merge([$stacks[$inst['from']][0]], $stacks[$inst['to']]);
                unset($stacks[$inst['from']][0]);
                $stacks[$inst['from']] = array_Values($stacks[$inst['from']]);
            }
        }
    }
    $combination = '';
    for ($i=0; $i < count($stacks); $i++) {
        $combination .= $stacks[$i+1][0];
    }
    return str_replace(['[', ']'], '', $combination);
}

echo "Part 1: " . crateMover("9000", $input) . PHP_EOL; // BWNCQRMDB
echo "Part 2: " . crateMover("9001", $input) . PHP_EOL; // NHWZCBNBF
