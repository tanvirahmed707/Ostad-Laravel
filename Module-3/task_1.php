<?php
function modifyText($text) {
    $text = strtolower($text);
    $text = str_replace("brown", "red", $text);
    echo $text;
}

$text = "The quick brown fox jumps over the lazy dog.";
modifyText($text);


