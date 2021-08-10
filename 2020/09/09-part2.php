<?php
$input = explode("\n", file_get_contents('input.txt'));
$preamble_start = 0;
$preamble_end = 25;

function is_valid_number(array $preamble_list, int $number): bool
{
    for ($x = 0; $x < sizeof($preamble_list); $x++) {
        for ($y = 1; $y < sizeof($preamble_list); $y++) {
            if (((int)$preamble_list[$x] + (int)$preamble_list[$y]) === $number) {
                return True;
            }
        }
    }
    return False;
}

function find_sequence(array $preamble_list, int $number): array
{
    for ($i = 0; $i < sizeof($preamble_list); $i++) {
        $j = $i;
        $total = (int)$preamble_list[$i];
        for ($j = $i + 1; $j < sizeof($preamble_list); $j++) {
            if ((int)$preamble_list[$j] === $number) {
                break;
            }
            $total += (int)$preamble_list[$j];

            if ($total > $number) {
                break;
            }
            if ($total === $number) {
                $seq = array_slice($preamble_list, $i, $j - $i + 1);
                return [max($seq), min($seq)];
            }
        }
    }
    throw new Exception("No sequence found", 1);
}

for ($i = 26; $i < sizeof($input); $i++) {
    $p = array_slice($input, $preamble_start, $preamble_end);
    if (!is_valid_number($p, (int)$input[$i])) {
        echo "[*] Part 1 => " . $input[$i] . PHP_EOL;
        $sequence = find_sequence(array_slice($input, 0, $i + 1), (int)$input[$i]);
        echo "[*] Part 2 => " . ($sequence[0] + $sequence[1]) . PHP_EOL;
        die();
    }
    $preamble_start += 1;
    $preamble_end += 1;
}
