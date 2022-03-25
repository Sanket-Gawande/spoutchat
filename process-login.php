<?php
session_start();
$exist = FALSE;
$_SESSION['logged_in'] = FALSE;
require("_conn.php");   // connection object

$logs = [];

$phone = $_POST['phone'];
  
  $pass = $_POST['pass_'];

  $query = "SELECT * FROM user_data WHERE mo_no = '$phone' ";

  $execute = mysqli_query($link, $query);
  $valid = mysqli_num_rows($execute);
  if ($valid) {
$data = mysqli_fetch_assoc($execute);
$hash = $data['pass'];

if(password_verify($pass , $hash) === true){
  
    $_SESSION['logged_in'] = TRUE;
    $_SESSION['user_id'] = $phone;

  $logs = [
    "status" => "success",
    'massage' => 'Successfully logged in  , redirecting to home....'
  ];

}else{
  
  $logs = [
    "status" => "error",
    'massage' => "Password and Phone number do not match ."
  ];
}
    
  } else {
    
  $logs = [
    "status" => "error",
    'massage' => "Phone number is not registered ."
  ];
  }
  echo (json_encode($logs));
  ?>
