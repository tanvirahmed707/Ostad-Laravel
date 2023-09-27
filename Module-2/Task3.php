<?php

$limit = 10;
$first = 0;
$second = 1;

for ($i = 0; $i < $limit; $i++) {
    if ($i <= 1) {
        $fib = $i;
    } else {
        $fib = $first + $second;
        $first = $second;
        $second = $fib;
    }

    if ($fib > 100) {
        break;
    }

    echo $fib . "\n";
}


