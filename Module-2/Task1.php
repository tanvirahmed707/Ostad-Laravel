<?php
//Using for Loop

function printEvenNumbers($start, $end, $step) {
    for ($i = $start; $i <= $end; $i += $step) {
        if ($i % 2 == 0) {
            echo $i . " ";
        }
    }
}

printEvenNumbers(1, 20, 2);



//Using While Loop

function printEvenNumbersWhile($start, $end, $step) {
    $i = $start;
    while ($i <= $end) {
        if ($i % 2 == 0) {
            echo $i . " ";
        }
        $i += $step;
    }
}

printEvenNumbersWhile(1, 20, 2);


// Using Do-While Loop

function printEvenNumbersDoWhile($start, $end, $step) {
    $i = $start;
    do {
        if ($i % 2 == 0) {
            echo $i . " ";
        }
        $i += $step;
    } while ($i <= $end);
}

printEvenNumbersDoWhile(1, 20, 2);




