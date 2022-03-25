<?php
require "_conn.php";
session_start();
if (isset($_POST['join'])) {

    $user = $_SESSION['user_id'];
    $name = mysqli_real_escape_string($link, $_POST['room_name']);
    $pass = md5($_POST['password_room']);
//checking if user is already member of this room
    $sql = "SELECT * FROM user_room WHERE room_name = '$name' AND user_linked = '$user'";

    $exec_sql = mysqli_query($link, $sql);

    if (mysqli_num_rows($exec_sql)) {
        $error = "You are already member of this room ";
    } else {
        $sql = "SELECT * FROM user_room WHERE room_name = '$name' AND room_pass = '$pass'";
        
        $exec_sql = mysqli_query($link, $sql);
        // check if passord is wrong & send alert when its wrong.
        if (mysqli_num_rows($exec_sql) < 1) {
            $error = "Please enter a valid password ";
        } else {
        //Fetching thumbnail of this room .
        $data = mysqli_fetch_assoc($exec_sql);
    echo     $thumbnail = $data['thumbnail'];
        //adding room details on users account .
            $sql_syn = "INSERT INTO user_room 					(room_name,room_pass,user_linked , thumbnail) VALUES 	('$name','$pass','$user', '$thumbnail')";

            $execute_sql = mysqli_query($link, $sql_syn);
            $_SESSION['room_login'] = true;
            $_SESSION['room_'] = $name;
           // header("Location:chat_page.php");
        }
    }

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Authenticate_user</title>

</head>
<body>


</body>
<?php
if ($error) {
    echo "<script>if(confirm('".$error."!')){window.location = 'home.php'}else{window.location = 'home.php'}</script>";
}
?>
</html>