<?php
$host =  "sql6.freesqldatabase.com"; // $_ENV['DB_HOST'];
$user = "sql6481415";// $_ENV['DB_USER'];
$pass = "Mj1QwyhhKH";// $_ENV['DB_PASS'];
$database="sql6481415";//$_ENV['DB_NAME'];

$link = mysqli_connect($host , $user , $pass , $database);

if (!$link) {
    echo 'Connection failed !';
    echo mysqli_connect_error();
}

?>
