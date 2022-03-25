<?php 
require("_conn.php");
 session_start();

if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in']!= TRUE  || !isset($_SESSION['user_id'])){
header("Location:index.php");
}

/* ----------------------------*/

//Function to encrypt massage :
function enc($massage){
  $key  = "this is secreat key for massage decrypting";
  $cipher =  "AES-256-CTR";
  $iv = 1234567812348765;
  return openssl_encrypt($massage , $cipher , $key, 0 , $iv );
}
/* ----------------------------*/

echo "1";
 $sender = $_SESSION['user_id'];
 $room =  mysqli_real_escape_string($link,$_SESSION['room_']);
 $str = mysqli_real_escape_string($link,$_POST['text']);
$massage = enc($str);

$save = "INSERT INTO user_chats (msg_by , msg, msg_from_room ) VALUES ('$sender' , '$massage' , '$room')";

$result = mysqli_query($link , $save);

 ?>
 
 
 