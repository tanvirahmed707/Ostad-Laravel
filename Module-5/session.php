<?php
session_start( [
    'name'            => 'php',
    'cookie_lifetime' => 150,
] );

print_r( $_SESSION );
echo $_SESSION['name'];
