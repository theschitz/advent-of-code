<?php

declare(strict_types=1);

$input = explode(PHP_EOL, file_get_contents(__DIR__ . '/' . (isset($argv[1]) ? 'test-' : ''). 'input.txt'));
class Direction
{
    public const RIGHT  = 'R';
    public const LEFT   = 'L';
    public const UP     = 'U';
    public const DOWN   = 'D';
}
class Motion
{
    public string $direction;
    public int $steps;

    public function __construct(string $movement)
    {
        $this->direction = explode(' ', $movement)[0];
        $this->steps = (int)explode(' ', $movement)[1];
    }

    /**
     * @param string[] $input
     * 
     * @return Motion[]
     */
    public static function fromArray(array $input): array
    {
        return array_map(function ($m): Motion { return new self($m); }, $input);
    }
}

class RopeEnd
{
    public int $col;
    public int $row;
    public array $positions = [];

    public function __construct(int $x, int $y)
    {
        $this->col = $x;
        $this->row = $y;
    }

    public function isTouching(RopeEnd $re): bool
    {
        return abs($this->col - $re->col) < 2 && abs($this->row - $re->row) < 2;
    }

    public function move(Motion $motion, RopeEnd $tail): void
    {
        switch ($motion->direction) {
            case Direction::RIGHT:
                $this->col += $motion->steps;
                $tail->moveCol($motion->steps);
                break;
            case Direction::LEFT:
                $this->col -= $motion->steps;
                break;
            case Direction::UP:
                $this->row -= $motion->steps;
                break;
            case Direction::DOWN:
                $this->row += $motion->steps;
                break;
        }
        $this->positions[$this->toString()] = isset($this->positions[$this->toString()]) ? $this->positions[$this->toString()] + 1 : 0;
    }

    public function moveCol(int $steps): void
    {
        $this->col = $steps - 1;
        $this->positions[$this->toString()] = isset($this->positions[$this->toString()]) ? $this->positions[$this->toString()] + 1 : 1;
    }

    public function toString(): string
    {
        return "Row: $this->row. Col: $this->col";
    }
}


$diagram = [['s']];
$positions = [];
$head = new RopeEnd(0, 0);
$tail = new RopeEnd(0, 0);
$tailCount = 0;
foreach (Motion::fromArray($input) as $motion) {
    $head->move($motion, $tail);
}

var_dump($head->positions);
echo "Tail movements " . PHP_EOL;