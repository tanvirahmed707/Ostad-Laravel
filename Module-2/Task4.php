<?php
function printFibonacci($n) {
    $first = 0;
    $second = 1;

    for ($i = 0; $i < $n; $i++) {
        if ($i <= 1) {
            $fib = $i;
        } else {
            $fib = $first + $second;
            $first = $second;
            $second = $fib;
        }

        echo $fib . "\n";
    }
}

printFibonacci(15);

