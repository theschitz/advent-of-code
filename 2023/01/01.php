<?php

$test = ($argv[1] ?? '') === '-t' ? 'test-' : '';

function parseCalibrationValues(string $inputPath, bool $digitsOnly): int
{
    $map = ['one' => 1, 'two' => 2,'three' => 3,'four' => 4,'five' => 5,'six' => 6,'seven' => 7, 'eight' => 8, 'nine' => 9];
    $input = file_get_contents($inputPath);
    $calibrationValues = [];
    $regExp = $digitsOnly ? '/[^\d]/': '/(\d|one|two|three|four|five|six|seven|eight|nine)/';
    foreach (explode(PHP_EOL, $input) as $value) {
        if ($digitsOnly) {
            $digits = str_split(preg_replace($regExp, '', $value));
        } else {
            preg_match_all($regExp, $value, $matches);
            if (!$matches) {
                continue;
            }
            // var_dump($matches);
            $digits = array_map(
                function ($v) use ($map) {
                    return is_numeric($v) ? $v : $map[strtolower($v)];
                },
                $matches[0]
            );
        }
        $first = $digits[0];
        $last = end($digits);
        $calibrationValues[] = $first . $last;
        
    }
    return array_sum($calibrationValues);
}
echo "Part 1: " . parseCalibrationValues( __DIR__ . "/{$test}input.txt", true) , PHP_EOL;
echo "Part 2: " . parseCalibrationValues( __DIR__ . "/{$test}input.txt", false) , PHP_EOL;