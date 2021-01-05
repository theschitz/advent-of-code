<?php
$input = explode("\n", file_get_contents('test-input.txt'));
$can_carry = [];

foreach ($input as $line) {
    $line = explode(' contain ', $line);
    $color = $line[0];
    $innerBags = explode(',', $line[1]);
    foreach($innerBags as $bag) {
        if (strpos($bag, 'shiny gold bag') > 0) {
            array_push($can_carry, $color);
        }
    }
}
$answer += 1;

echo $answer ."\n";

?>