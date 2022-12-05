<?php

$input = explode(PHP_EOL . PHP_EOL, file_get_contents(__DIR__ . '/' . (isset($argv[1]) ? 'test-' : ''). 'input.txt'));

$noOfColumns = 0;

function parseStacks()
{
    global $input;
    global $noOfColumns;
    $stacks = explode(PHP_EOL, $input[0]);
    $noOfColumns = strlen($stacks[0]) / 4;
    array_pop($stacks);
    $result = [];
    foreach ($stacks as $s) {
        for ($i=0; $i < $noOfColumns; $i++) {
            $startPos = $i * 4;
            $crate = trim(substr($s, $startPos, 3));
            if ($crate) {
                $result[$i + 1][] = trim(substr($s, $startPos, 3));
            }
        }
    }
    return $result;
}

function parseInstructions()
{
    global $input;
    $instructions = explode(PHP_EOL, $input[1]);
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

$stacks = parseStacks();
$instructions = parseInstructions();

function crateMover9000()
{
    global $instructions;
    global $stacks;
    foreach ($instructions as $inst) {
        for ($i=0; $i < $inst['move']; $i++) {
            $stacks[$inst['to']] = array_merge([$stacks[$inst['from']][0]], $stacks[$inst['to']]);
            unset($stacks[$inst['from']][0]);
            $stacks[$inst['from']] = array_Values($stacks[$inst['from']]);
        }
    }
}
crateMover9000();
$combination = '';
for ($i=0; $i < $noOfColumns ; $i++) {
    $combination .= $stacks[$i+1][0];
}
$combination = str_replace(['[', ']'], '', $combination);
echo "Part 1: $combination" . PHP_EOL; // BWNCQRMDB
