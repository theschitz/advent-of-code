<?php
$input = explode("\n", file_get_contents('input.txt'));

function is_valid(int $min_occurence, int $max_occurence, string $letter, string $str): bool {
    (int)$ocurrences = preg_match_all("/$letter/m", $str);
    return ($ocurrences >= $min_occurence) && ($ocurrences <= $max_occurence);
}


$valid_count = 0;
foreach ($input as $value) {
    $v = explode(" ", $value);
    (int)$min = explode("-", $v[0])[0];
    (int)$max = explode("-", $v[0])[1];
    $l = trim($v[1], ':'); // remove colon
    $s = $v[2];
    if (is_valid($min, $max, $l, $s)) {
        $valid_count++;

    }
}
echo "$valid_count\n";

?>