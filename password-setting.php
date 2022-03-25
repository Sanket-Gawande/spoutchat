<?php

require("_conn.php");
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] != TRUE) {
    header("Location:index.php");

} else {

    $user = $_SESSION['user_id'];
}
//var_dump($_REQUEST);
if (isset($_POST['old-password'])) {
    $old = mysqli_real_escape_string($link, $_POST['old-password']);
    $new = mysqli_real_escape_string($link, $_POST['new-password']);
    $conf = mysqli_real_escape_string($link, $_POST['confirm-password']);
   
    function change_pass($new_pass , $conf_pass , $user , $link){
        if ($new_pass === $conf_pass) {
            $new_hash = password_hash($new_pass , PASSWORD_BCRYPT);
            $sql = "UPDATE user_data set pass = '$new_hash' WHERE mo_no = '$user'";
            $execute = mysqli_query($link, $sql);
    
            return  json_encode([
                "status" => "success" ,
                "msg" => "Password updated successfully ."
            ]);
    
            } else {
             return   json_encode([
                    "status" => "error" ,
                    "msg" => "Confirm password do not matches ."
                ]);
            }
    }
    
    //checking if user credentials is valid
   $sql = "SELECT * FROM user_data WHERE mo_no = '$user'";
    $execute = mysqli_query($link, $sql);
   $data =  mysqli_fetch_assoc($execute);
   $hash = $data['pass'];
   if(password_verify($old , $hash)){
      echo  change_pass($new , $conf , $user , $link);
   }
   else{
        echo json_encode([
       "status" => "error" ,
       "msg" => "You entered wrong old password ."
   ]);
}



}

?>