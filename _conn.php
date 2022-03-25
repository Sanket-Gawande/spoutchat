<?php
$host =  $_ENV['DB_HOST'];
$user =  $_ENV['DB_USER'];
$pass =  $_ENV['DB_PASS'];
$database=$_ENV['DB_NAME'];

$link = mysqli_connect($host , $user , $pass , $database);

if (!$link) {
    echo 'Connection failed !';
    echo mysqli_connect_error();
}

?>
