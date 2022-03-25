<?php
require('_conn.php');
session_start();

if (!isset($_SESSION['user_id']) &&  !isset($_SESSION['room_'])) {
    header("Location:index.php");
    die();
}

$room = $_SESSION['room_'];
$user = $_SESSION['user_id'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>chatBox</title>
    <link rel="stylesheet" href="styles/chatPage.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- font awasome -->
    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inconsolata:wght@800&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


</head>
<body>
    <header>


        <div class="heading">
            <a href="index.php">
                <img src="icon/back.svg">
            </a>
            <h3><?php echo $room; ?><small><?php echo $user; ?></small> </h3>
        </div>
        <div class='members'>
            <img src="icon/setting-white.svg" class="setting-icon">
            <img src="icon/users.svg" class="room_members">

            <div class="members_name">
                <?php

                $q = "SELECT user_data.name FROM user_room INNER JOIN user_data ON user_room.user_linked = user_data.mo_no WHERE room_name ='$room'";

                $get = mysqli_query($link, $q);
                while ($names = mysqli_fetch_assoc($get)) {
                    echo '<p>'.$names['name'].'</p>';
                }

                ?>

            </div>
            <div class="wallpaper-settings">
                <div class="bg-preview">
                    <img src="images/bg-preview.png" class="bg-preview-img">
                </div>

                <h4>Choose background image</h4>
                <input type="file" class="inp-file">
                <button onclick="changebg()">Change background</button>

                <h4>Background diming</h4>
                <input type="range" min="0" max="100" oninput="bgOpacity()" class="opacity-slider">
            </div>
        </div>
    </header>
    <div class="main">
        <div class="main-before">

        </div>
        <div class="main-chats">

        </div>

        <input class="focus" readonly type="text">
    </div>

    <div class="text">

        <input type="text" placeholder="Type something......" class="input_msg" name="msg" autocomplete="off">

        <button class="send_msg" onclick="sendString()" name="send"><i class="material-icons">send</i> </button>
    </div>
</body>
<style>

</style>
<!-- important java script files -->
<script src="javascript/chat_page.js">
</script>

<script>
    let room = "<?php echo $room; ?>";

    let slider = document.querySelector(".opacity-slider");
    getOpacity = localStorage.getItem(room+"bg-opacity");
    slider.value = parseInt(getOpacity);

    getBgImage = localStorage.getItem(room+"bg");
    document.querySelector(".main").style.background = "url('"+getBgImage+"') center center/cover";
    
    //function to set background opacity
    function bgOpacity() {

        opec = slider.value;
        localStorage.setItem(room+"bg-opacity", opec);
        getOpacity = localStorage.getItem(room+"bg-opacity");
        document.querySelector(".main-before").style.background = "rgba(0,0,0,"+parseInt(getOpacity)/100+")";

        slider.style.setProperty('--left' , opec+"%")
        slider.style.setProperty('--width' , opec+"%")
    }
    //function to set background image


    let file = document.querySelector(".inp-file");
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
            if (size <= 200000) {
                obj = new FileReader;
                obj.readAsDataURL(file.files[0])
                obj.onload = function () {

                    //	console.log(this.result)
                    document.querySelector(".bg-preview-img").src = this.result;

                }
            } else {
                alert("File size is too big , please upload  file under 200kb\n\nFile size : "+size/1000+"kb")
                file.value = "";
            }
        } else {
            alert("Invalid file type , Please upload jpg/jpeg/png/svg/webp")
            file.value = "";
        }

    }

    function changebg() {
      //  let file = document.querySelector(".inp-file")
     //   if (file.src.length > 0) {
            localStorage.setItem(room+"bg", obj.result);
            getBgImage = localStorage.getItem(room+"bg");
            document.querySelector(".main").style.background = "url('"+getBgImage+"') center center/cover";

     //   } else
    /*    {
            file.focus()}  */
    }

    <!--  function to show users box on clicking users icon -->
    document.querySelector(".setting-icon").onclick = ()=> {
        document.querySelector(".wallpaper-settings").classList.toggle("members_name_visible");
    }

    <!--  function to show users box on clicking users icon -->

    document.querySelector(".room_members").onclick = ()=> {
        document.querySelector(".members_name").classList.toggle("members_name_visible");
    }
    bgOpacity();
</script>


<script>
    //      function to update chats in real time

    setInterval(updateThreads, 1000);


    function  updateThreads() {

        let string = document.querySelector(".input_msg");

        var obj = new XMLHttpRequest();

        obj.open("POST", "getChat.php", true);

        obj.onload = function() {
            let data = obj.responseText;
            let main = document.querySelector(".main-chats")
            main.innerHTML = data;
            // string.focus();
        }
        obj.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        obj.send("room_name=<?php echo $room; ?>&&user_id=<?php echo $user; ?>");

    }

</script>


</html>