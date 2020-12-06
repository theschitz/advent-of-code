<?php
$input = explode("\n", file_get_contents('input.txt'));

$group_answers = [];
$answers_sums = [];
foreach ($input as $values) {
    if ($values === "") {
        array_push($answers_sums, sizeof($group_answers));
        $group_answers = [];
        continue;
    }
    for ($i=0; $i < strlen($values); $i++) {
        $c = $values[$i];
        if (!in_array($c, $group_answers)) {
            array_push($group_answers, $c);
        }
    }
}
array_push($answers_sums, sizeof($group_answers));

echo "Yes answers: ". array_sum($answers_sums) ."\n"; // 6930
?>