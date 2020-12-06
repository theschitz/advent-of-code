<?php
$input = explode("\n", file_get_contents('input.txt'));

function filter_by_group_size(array $group_answers, int $group_size): array {
    return array_filter($group_answers, function($k) use ($group_size) { return $k === $group_size; });
}

$group_answers = [];
$answers_sums = [];
$group_size = 0;
$group_no = 0;
foreach ($input as $values) {
    if ($values === "") {
        $ans = filter_by_group_size($group_answers, $group_size);
        array_push($answers_sums, sizeof($ans));
        
        $group_answers = [];
        $group_size = 0;
        $group_no += 1;
        continue;
    }
    $group_size += 1;
    for ($i=0; $i < strlen($values); $i++) {
        $c = $values[$i];
        if (array_key_exists($c, $group_answers)) {
            $group_answers[$c] += 1;
        } else {
            $group_answers[$c] = 1;
        }
    }
}
array_push($answers_sums, sizeof(filter_by_group_size($group_answers, $group_size)));

echo "Yes answers: ". array_sum($answers_sums) ."\n"; 
// Part 2: 3585
?>