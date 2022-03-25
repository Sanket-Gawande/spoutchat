<?php
require("_conn.php");
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] != TRUE) {
    header("Location:login.php");

} else {

    $user = $_SESSION['user_id'];
}


$sql = "SELECT * FROM user_data WHERE mo_no = $user";

$execute = mysqli_query($link, $sql);
$user_data = mysqli_fetch_assoc($execute);
//var_dump($user_data);
$user_profile = $user_data['user_photo'];
$username = $user_data['name'];
$user_email = $user_data['email'];

?>


<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/setting.css">
    <title></title>
</head>
<body>
    <header>
        <div class="header">
            <div class="logo">
                <img src="images/spoutchat.png">
            </div>
           <a class="home_link" href="index.php"> <i class="fa fa-home"></i> Home</a>
        </div>
    </header>
    <div class="container">
        <div class="profile-form-div">
            <form action="profile-setting.php" method="post" accept-charset="utf-8" enctype="multipart/form-data" class="form">
                <h3 class="heading">Update profile</h3>
                <input type="file" name="profile-image" id="file" value=" sanet.jpg" />
                <input type="hidden" name="oldImage" value="<?php echo $user_profile ; ?>"/>
                <label for="file" class="profile-image"><img class="profile-img-preview" src="<?php echo $user_profile; ?>" alt="Display picture" /></label>

                <label for="name">Full name</label>
                <input required type="text" name="name" min="4" size='2' id="name" value="<?php echo $username; ?>" />
                <label for="email">Email address</label>
                <input required type="email" name="email" id="email" value="<?php echo $user_email; ?>" />
                <button class="password-setting-button" type="submit" name='update'>Update</button>
            </form>

        </div>
        <div class="password-form-div">
            <h3 class="heading">Upadate password</h3>
            <img src="./images/password-change.webp" alt="preview" class="preview-image">
            <form  method="post" accept-charset="utf-8" enctype="multipart/form-data" class="password-form">
                <label for="old-password">Your password</label>
                <input required type="password" name="old-password" id="old-password" value="" />
                <label for="new-password">New password</label>
                <input required type="password" name="new-password" id="new-password" value="" />
                <label for="confirm-password">Confirm password</label>
                <input required type="text" name="confirm-password" id="confirm-password" value="" />
                <button type="submit" name="update" class="update-button">Update</button>
            </form>

        </div>
        
        
        <div class="joined-rooms">
            <ul>
                <h3 class="heading">Your rooms</h3>
        <?php 
           $sql_ = "SELECT * FROM user_room WHERE user_linked = '$user'";

                    $execute = mysqli_query($link, $sql_);
                    if (mysqli_num_rows($execute) > 0) {

                        //checking for rooms created or joined by this user


                        while ($rooms = mysqli_fetch_assoc($execute)) {


                            $room = $rooms["room_name"];
                            $sql = "SELECT * FROM user_room WHERE room_name = '$room'";
                            $exec = mysqli_query($link, $sql);
                            $num = mysqli_num_rows($exec);
                            echo '
                <li><img class="room-thumbnail" src="'.$rooms['thumbnail'].'" alt="thumb" /><h4 class="room-name">'.$rooms['room_name'].'</h4> <a onclick="confirmLeave('.$rooms["id"].')">Leave</a></li>
                            ';
                        }
                    } else {

                        ?>

                            <li>You didn't join or create any chatting room </li>

                        <?php
                    }

                    ?>
            </ul>
        </div>
    </div>
   <footer>
   <p>Created by <a href="https://github.com/Sanket-Gawande">Sanket-Gawande</a> with <i class="fa fa-heart"></i></p>
                <p class="bg-cyan">
                    
                All rights are reserved © GossiYape.com 2021-22
                </p>
            </footer>
    <style>
    </style>
    <script src='javascript/pass-setting.js' defer></script>
    <script>
         function confirmLeave(id) {
                
                if (confirm("Are you sure to leave this chat room\n\nRoom name: My room")) {
                    alert(id);
                }
            }
    
            //preview chosen profile  image
            /*I have added some validations  while choosing file . it must be image file in given format and also there are some size limitations.*/
    
            let file = document.querySelector("#file");
            file.onchange = function () {
                let name = this.files[0].name
                let size = this.files[0].size
                let arr = name.split(".")
                let ext = arr[arr.length - 1];
    
                validExt = ["jpg",
                    "png",
                    "jpeg",
                    "svg",
                    "webp"];
                if (validExt.includes(ext)) {
                    if (size <= 500000) {
                        obj = new FileReader;
                        obj.readAsDataURL(file.files[0])
                        obj.onload = function () {
    
                            //	console.log(this.result)
                            document.querySelector(".profile-img-preview").src = this.result;
    
                        }
                    } else {
                        alert("File size is too big , please upload  file under 500kb\n\nFile size : "+size/1000+"kb")
                        file.value = "";
                    }
                } else {
                    alert("Invalid file type , Please upload jpg/jpeg/png/svg")
                    file.value = "";
                }
    
            }
    
    // loading animation in button 
      let b = document.querySelector(".password-setting-button");
            b.onclick = () => {
                a = '<i class="fa fa-spinner fa-pulse"></i>';
                b.innerHTML = a;
                b.style.opacity = ".8"
            }
    
            
    </script>
    <script src="https://use.fontawesome.com/d625ba4101.js"></script>    
</body>
</html>