<?php

class BoardingCard
{
    public int $row;
    public int $col;

    public function __construct(string $code) {
        $row_part = substr($code, 0, 7);
        $row_part = str_replace('B', '1', $row_part);
        $row_part = str_replace('F', '0', $row_part);
        $this->row = bindec($row_part);

        $col_part = substr($code, 7, 10);
        $col_part = str_replace('R', '1', $col_part);
        $col_part = str_replace('L', '0', $col_part);
        $this->col = bindec($col_part);
    }

    public function seat_id(): int {
        return $this->row * 8 + $this->col;
    }

    public function print_seat_id() {
        echo "Seat Id: ". $this->seat_id() ."\n";
    }
}

(new BoardingCard('FBFBBFFRLR'))->print_seat_id(); // row 44, column 5, seat ID 357.
(new BoardingCard('BFFFBBFRRR'))->print_seat_id(); // row 70, column 7, seat ID 567.
(new BoardingCard('FFFBBBFRRR'))->print_seat_id(); // row 14, column 7, seat ID 119.
(new BoardingCard('BBFFBBFRLL'))->print_seat_id(); // row 102, column 4, seat ID 820.

$input = explode("\n", file_get_contents('input.txt'));
$seat_ids = [];
foreach ($input as $value) {
    array_push($seat_ids, (new BoardingCard($value))->seat_id());
    array_multisort($seat_ids);
}

// Part 1
echo "Largest id: ". max($seat_ids) ."\n"; // 822

// Part 2
for ($a=0; $a < sizeof($seat_ids); $a++) {
    $nextSid =  $seat_ids[$a] + 1;
    if ($nextSid !== $seat_ids[$a+1]) {
        echo "Your seat: ". $nextSid ."\n"; // 705
        break;
    }
}
?>