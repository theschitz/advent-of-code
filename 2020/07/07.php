<?php

$input = explode("\n", file_get_contents('input.txt'));
$answer = 0;

class Bag
{
    public string $color;
    public array $contains;

    public function  __construct(string $color, array $contains) {
        $this->color = $color;
        $this->contains = $contains;
    }
}

function parse_line(string $str) {
    $contains = [];
    $line = explode(' contain ', $str);
    $color = substr($line[0], 0, strpos($line[0],' bags'));
    $content = trim($line[1], '.');
    if ($content === "no other bags") {
        return new Bag('', []);
    }
    $content = explode(', ', $content);
    foreach($content as $c) {
        $number = (int)$c[0];
        $c = substr($c, strpos($c, ' '), strpos($c, ' bag'));
        $c = trim($c);
        $contains[$c] = $number;
    }
    return new Bag($color, $contains);
 }

function bag_parents($bags): array {
    $p = [];
    foreach($bags as $bag) {
        foreach($bag->contains as $key=>$value) {
            if (!array_key_exists($key, $p)) {
                $p[$key] = [];
            }
            array_push($p[$key], $bag->color);
        }
    }
    
    return $p;
}

function can_contain_color($bags, string $color): array {
    $can_contain = [];
    $parents = bag_parents($bags);
    $check_color = [$color];
    while ($check_color) {
        $c = array_pop($check_color);
        if (array_key_exists($c, $parents)) {
            foreach($parents[$c] as $p) {
                if (!in_array($p, $can_contain)) {
                    array_push($can_contain, $p);
                    array_push($check_color, $p);
                }
            }
        }
    }
        return $can_contain;
}

function number_of_bags_inside($bags, $color): int {
    $by_color = [];
    $num_bags = 0;
    foreach($bags as $bag) {
        $by_color[$bag->color] = $bag;
    }
    $check = [[$color, 1]];
    while ($check) {
        $next_color = array_pop($check);
        $multiplier = $next_color[1];
        $next_color = $next_color[0];
        if (array_key_exists($next_color, $by_color)) {
            $bag = $by_color[$next_color];
            foreach($bag->contains as $b=>$c) {
                $num_bags += $multiplier * $c;
                array_push($check, [$b, $multiplier * $c]);
            }
        }
    }
    return $num_bags;
}


$bags = [];
foreach ($input as $value) {
    array_push($bags, parse_line($value));
}
echo 'Answer Part 1: '. sizeof(can_contain_color($bags, 'shiny gold')) ."\n";
echo 'Answer Part 2:'. number_of_bags_inside($bags, 'shiny gold') ."\n";


?>