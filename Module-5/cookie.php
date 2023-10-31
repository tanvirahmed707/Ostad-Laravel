<?php

$name  = 'name';
$value = 'Tanvir';
setcookie( $name, $value, time() + 150 );


echo $_COOKIE[$name];

$data = [
    'name' => 'John Doe',
    'age'  => 30,
];


setcookie( 'data', json_encode( $data ), time() + 300 );


$data1 = json_decode( $_COOKIE['data'], true );
print_r( $data1['name'] );

