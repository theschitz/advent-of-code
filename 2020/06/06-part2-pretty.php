<?php
$groups = explode("\n\n", file_get_contents('input.txt'));

function filter_by_group_size(array $group_answers, int $group_size): array {
    return array_filter($group_answers, function($k) use ($group_size) { return $k === $group_size; });
}

$answers_sums = [];
foreach ($groups as $group) {
    $group_answers = [];
    $group_members = explode("\n", $group);
    foreach($group_members as $member) {
        foreach (str_split($member) as $c) {
            $group_answers[$c] = array_key_exists($c, $group_answers) ? $group_answers[$c] + 1 : 1;
        }
    }
    $ans = filter_by_group_size($group_answers, sizeof($group_members));
    array_push($answers_sums, sizeof($ans));
}

echo "Yes answers: ". array_sum($answers_sums) ."\n"; // Part 2: 3585
?>