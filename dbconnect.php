<?php

$host = 'localhost';
$user = 'root';
$pass = 'zzz';
$database = 'phpcrudapp';

$conn = mysqli_connect($host, $user, $pass, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
