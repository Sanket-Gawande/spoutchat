<?php
$host = "localhost"; //. $_ENV['DB_HOST'];
$user = "root" ; //$_ENV['DB_USER'];
$pass = "";// $_ENV['DB_PASS'];
$database ="chat_room" ;//$_ENV['DB_NAME'];

$link = mysqli_connect($host , $user , $pass , $database);

if (!$link) {
    echo 'Connection failed !';
    echo mysqli_connect_error();
}

?>
