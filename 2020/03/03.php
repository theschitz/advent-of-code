<?php

$pattern = [
    ['right' => 1, 'down' => 1],
    ['right' => 3, 'down' => 1],
    ['right' => 5, 'down' => 1],
    ['right' => 7, 'down' => 1],
    ['right' => 1, 'down' => 2]
];

function calculate_path(int $right, int $down): int {
    $input = explode("\n", file_get_contents('input.txt'));
    $trees = 0;
    $pos = $right;
    for ($i=$down; $i < sizeof($input); $i += $down) { 
        if ($pos >= strlen($input[$i])) {
            $ext = $input[$i];
            while ($pos >= strlen($input[$i])) {
                $input[$i] = $input[$i] . $ext;
            }
        }
        if ($input[$i][$pos] == "#") {
            $trees++;
            $input[$i][$pos] = "X";
        } else {
            $input[$i][$pos] = "O";
        }
        $pos += $right;
    }
    return $trees;
}

$answer_pt2 = 1;
foreach($pattern as $p) {
    $trees = calculate_path($p['right'], $p['down']);
    $answer_pt2 *= $trees;
}

echo "Answer Part 1: ". calculate_path(3, 1) ."\n";
echo "Answer Part 2: $answer_pt2\n";
?>