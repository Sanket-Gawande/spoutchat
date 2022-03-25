<?php
require("_conn.php");
session_start();

if (isset($_SESSION['user_id'])) {

    $user = mysqli_real_escape_string($link, $_SESSION['user_id']);

    $name = mysqli_real_escape_string($link, $_POST['room_name']);

    $pass = mysqli_real_escape_string($link, md5($_POST['password_room']));

    $c_pass = mysqli_real_escape_string($link, md5($_POST['c_password_room']));

    $thumbnail = $_FILES['room_thumbnail'];

     // checking dir if is present , if not create to avoid running in unexpected error
  
   if(! is_dir("user_profiles")){
    mkdir("user_profiles");
 }

    $path = "room_thumbnails/". $name.'_'.$thumbnail['name'];
    $temp = $thumbnail['tmp_name'];
    $q = "SELECT * FROM user_room WHERE room_name = '$name'";
    
    $res = mysqli_query($link, $q);
    
    if (mysqli_num_rows($res) < 1) {
        
        if ($pass == $c_pass) {
            $sql_syn = "INSERT INTO user_room (room_name,room_pass,user_linked , thumbnail) VALUES 	('$name','$pass','$user' , '$path')";
            
            $execute_sql = mysqli_query($link, $sql_syn);
            $_SESSION['room_login'] = true;
            $_SESSION['room_'] = $name;
            move_uploaded_file($temp, $path);
           
            header("Location:chat_page.php");
        } else {
            echo "Password do not match";
        }
    } else
    {
        echo '<script>if(confirm("This Room Name is already taken"))
{window.location = "home.php"}
else{window.location = "home.php"}
</script>';
        echo "<h1>something wrong</h1>";
    }

}
?>