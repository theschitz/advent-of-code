<?php

function parse(): array {
    $input = explode("\n", file_get_contents('input.txt'));
    $instructions = [];
    foreach($input as $i) {
        $i = explode(' ', $i);
        array_push($instructions, [$i[0], $i[1]]);
    }
    return $instructions;
}

class Program {
    public array $executed;
    public int $op_pos;
    public int $acc;
    public array $instructions;

    public function __construct(array $instructions) {
        $this->instructions = $instructions;
        $this->op_pos = 0;
        $this->acc = 0;
        $this->executed = [];
    }

    public function does_terminate(): bool {
        $exec = [];
        while(!in_array($this->op_pos, $exec)) {
            if ($this->op_pos === sizeof($this->instructions)) {
                return true;
            }
            array_push($exec, $this->op_pos);
            $this->execute_one();
        }
        return false;
    }

    public function run_until_repeat() {
        while (!in_array($this->op_pos, $this->executed)) {
            $this->execute_one();
        }
    }

    public function execute_one() {
        $op_code = $this->instructions[$this->op_pos][0];
        $op_arg = $this->instructions[$this->op_pos][1];
        array_push($this->executed, $this->op_pos);
        switch ($op_code) {
            case 'acc':
                $this->acc += (int)$op_arg;
                $this->op_pos += 1;
                break;
            case 'jmp':
                $this->op_pos += (int)$op_arg;
                break;
            case 'nop':
                $this->op_pos += 1;
                break;
            default:
                break;
        }
    }
}

function find_terminator($instructions): int {
    for ($i=0; $i < sizeof($instructions); $i++) { 
        $inst = $instructions;
        $op = $inst[$i][0];
        $arg = $inst[$i][1];
        if($op === 'nop') {
            $inst[$i] = ['jmp', $arg];
        } elseif ($op === 'jmp') {
            $inst[$i] = ['nop', $arg];
        } else {
            continue;
        }

        $prog = new Program($inst);
        if ($prog->does_terminate()) {
            return $prog->acc;
        }
    }
}

$program = new Program(parse());
$program->run_until_repeat();
echo "Part 1: $program->acc\n";
echo "Part 2: ". find_terminator(parse()) ."\n";

?>