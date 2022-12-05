<?php

declare(strict_types=1);

$input = explode(PHP_EOL, file_get_contents(__DIR__ . '/' . (isset($argv[1]) ? 'test-' : ''). 'input.txt'));