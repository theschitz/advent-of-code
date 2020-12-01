<?php

$input_values = array_map('intval', explode("\n", file_get_contents('input.txt')));

for ($a=0; $a < sizeof($input_values); $a++) { 
    for ($b=$a+1; $b < sizeof($input_values); $b++) {
            if ($input_values[$a] + $input_values[$b] === 2020) {
                $answer_part_one = $input_values[$a] * $input_values[$b];
                echo "Answer Part 1: {$answer_part_one}\n";
        }
    }
}

for ($a=0; $a < sizeof($input_values); $a++) { 
    for ($b=$a+1; $b < sizeof($input_values); $b++) {
        for ($c=$b+1; $c < sizeof($input_values); $c++) { 
            if ($input_values[$a] + $input_values[$b] + $input_values[$c] === 2020) {
                $answer_part_two = $input_values[$a] * $input_values[$b] * $input_values[$c];
                echo "Answer Part 2: {$answer_part_two}\n";
            }
        }
    }
}
?>
