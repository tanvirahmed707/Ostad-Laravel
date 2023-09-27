<?php
function removeEvenNumbers($numbers) {
    
    $result = array_filter($numbers, function($num) {
        return $num % 2 != 0;
    });
    print_r($result);
}

$numbers = range(1, 10);
removeEvenNumbers($numbers);

