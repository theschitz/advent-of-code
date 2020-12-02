<?php
$input = explode("\n", file_get_contents('input.txt'));

function isValid(int $pos1, int $pos2, string $letter, string $str): bool {
    return ($str[$pos1-1] == $letter || $str[$pos2-1] == $letter) && !($str[$pos1-1] == $letter && $str[$pos2-1] == $letter);
}


$validCount = 0;
foreach ($input as $value) {
    $v = explode(" ", $value);
    (int)$min = explode("-", $v[0])[0];
    (int)$max = explode("-", $v[0])[1];
    $l = trim($v[1], ':'); // remove colon
    $s = $v[2];
    if (isValid($min, $max, $l, $s)) {
        $validCount++;

    }
}
echo "$validCount\n";

?>