<?php
require_once('_conn.php');
session_start();
$phone = $_SESSION['user_id'];
if (isset($_POST['update'])) {
 
   // checking dir if is present , if not create to avoid running in unexpected error
  
   if(! is_dir("user_profiles")){
      mkdir("user_profiles");
   }


   $profile_photo= "user_profiles/".$phone.'_'.$_FILES['profile-image']['name'];
   $tmp= $_FILES['profile-image']['tmp_name'];
   move_uploaded_file($tmp , $profile_photo);
   $old = $_POST['oldImage'];
   if (strlen($tmp) > 0) {
     unlink($old);
     $path = $profile_photo;
   } else {
      $path = $old;
   }
   $name = $_POST['name'];
   $email = $_POST['email'];
   
   $sql = "UPDATE user_data SET user_photo = '$path' , name = '$name' , email = '$email' WHERE mo_no = '$phone'";
   $runQuery = mysqli_query($link , $sql);
   if ($runQuery) {
    header("location: setting.php");
    
   }
   else{
       echo mysqli_error($link);
   }
}
mysqli_close($link);
?>