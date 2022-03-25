<?php 
require('_conn.php');

$pass =  md5($_POST['room_key']);
$name = $_POST['room_name'];

$sql_ = "SELECT * FROM user_room WHERE room_name = '$name' AND room_pass = '$pass'";

$exec_sql_ = mysqli_query($link , $sql_);
if(mysqli_num_rows($exec_sql_))
{
session_start();

$_SESSION['room_login'] = true;

$_SESSION['room_'] = $_POST['room_name'];

header('Location:chat_page.php');}

else{$error = true;}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
				<title>Authenticate_user</title>
				
</head>
<body>


</body>
<?php 
if($error)
{ echo "<script>if(confirm('Incorrect password , please enter valid one !')){window.location = 'home.php'}else{window.location = 'home.php'}</script>";}
?>
</html>