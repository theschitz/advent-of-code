<?php

function is_valid_property($key, $value): bool {
    $ok = false;
    switch ($key) {
        case 'byr':
            $byr = (int)$value;
            $ok = (($byr >=1920) && ($byr <= 2002));
        break;
        case 'iyr':
            $ok = ((int)$value >= 2010) && ((int)$value <= 2020);
        break;
        case 'eyr':
            $ok = (((int)$value >= 2020) && ((int)$value <= 2030));
        break;
        case 'hgt':
            if (strpos($value, 'cm') > 0) {
                $h = (int)substr($value, 0, strpos($value, 'cm'));
                $ok = (($h >= 150) && ($h <= 193));
            } elseif (strpos($value, 'in') > 0) {
                $h = (int)substr($value, 0, strpos($value, 'in'));
                $ok = (($h >= 59) && ($h <= 76));
            }
        break;
        case 'hcl':
            $ok =(bool)preg_match('/#[a-f0-9]{6}$/i', $value);
        break;
        case 'ecl':
            $valid_ecl = ['amb','blu','brn','gry','grn','hzl', 'oth'];
            $ok = in_array($value, $valid_ecl);
        break;
        case 'pid':
            $ok= (bool)preg_match("/^[0-9]{9}$/i", $value);
        break;
        case 'cid':
            $ok = true;
        break;
        default:
            return false;
    }
    return $ok;
}

function is_valid_passport(array $pport): bool {
    $valid_keys = ['byr', 'iyr', 'eyr', 'hgt', 'hcl', 'ecl', 'pid'];//, 'cid'];
    foreach($valid_keys as $key) {
        if (!array_key_exists($key, $pport)) {
                return false;
        }
        if (!is_valid_property($key, $pport[$key])) {
            return false;
        }
    }    
    return true;
}

function validate_passports($input): int {
    $raw_passports = [];
    $passport = [];
    
    foreach($input as $line)
    {
        if ($line === "") {
            array_push($raw_passports, $passport);
            $passport = [];
            continue;
        }
        
        $props = explode(" ", $line);
        foreach($props as $p) {
            $kvp = explode(":", $p);
            $key = $kvp[0];
            $value = $kvp[1];
            $passport[$key] = $value;
        }
    }
    array_push($raw_passports, $passport);
    
    $valid_passports = 0;
    foreach($raw_passports as $pass) {
        if (is_valid_passport($pass)) {
            $valid_passports += 1;
        }
    }
    echo "Valid passports: ". $valid_passports ."\n"; 
    return $valid_passports;
}

validate_passports(explode("\n", file_get_contents('test-input.txt'))); // 2
validate_passports(explode("\n", file_get_contents('valid-input.txt'))); // 4
validate_passports(explode("\n", file_get_contents('invalid-input.txt'))); // 0
validate_passports(explode("\n", file_get_contents('input.txt'))); // 111
?>