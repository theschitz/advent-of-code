<?php
$input = explode("\n", file_get_contents('input.txt'));
$preamble_start = 0;
$preamble_end = 25;

function is_valid_number($preamble_list, $number): bool {
    for ($x=0; $x < sizeof($preamble_list); $x++) { 
        for ($y=1; $y < sizeof($preamble_list); $y++) {
            if (((int)$preamble_list[$x] + (int)$preamble_list[$y]) === $number) {
                return True;
            }
        }
    }
    return False;
}

for ($i=26; $i < sizeof($input); $i++) {
    $p = array_slice($input, $preamble_start, $preamble_end);
    if (!is_valid_number($p, (int)$input[$i])) {
        echo $input[$i] ."\n";
        die();
    }
    $preamble_start += 1;
    $preamble_end += 1;
}
?>