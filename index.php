<?php
require '_conn.php';

session_start();
if (!isset($_SERVER['logged_in']) && !isset($_SESSION['user_id'])) {
    header('Location:login.php');
    die('Unauthorised');
}
$user = $_SESSION['user_id'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home - SpoutChat</title>
    <link rel="stylesheet" href="./styles/home.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- font awasome cdn -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   
</head>
<body>
    <header>
        <div class="header">
            <div class="logo">
                <img src="images/spoutchat.png">
            </div>
            <div class="menu">
                
            <a href='setting.php' class="setting-icon">Settings<img src="icon/setting.svg"></a>
            <a href='log-out.php'>Logout <img src="icon/logout.svg"></a>
            </div>


            </div>
            </header>

            <div class="user_">

                <?php
                $sql_ = "SELECT * FROM user_data WHERE mo_no= '$user'";

                $execute = mysqli_query($link, $sql_);

                $data = mysqli_fetch_assoc($execute);
                if ($data['name'] == '') {
                    $name =
                        " <a href='setting.php' >  Kindly update your name here </a>";
                } else {
                    $name = $data['name'];
                }

                echo '<img src="' .
                    $data['user_photo'] .
                    '" alt="profile"><h3>Hello, ' .
                    $name .
                    ' </h3>';
                ?>
            </div>
            <main>
                <div class="hero_img">
                    <img class="chatting" src="images/chatting-boy.svg" alt="" />
                </div>
                <div class="main">
                    <h2>SpoutChat - Web based chatting system </h2>
                    <small> by : Sanket Gawande</small>
                    <ul>

                        <li>Free web based communication system </li>
                        <li>Start conversation by creating a chatting room </li>
                        <li>One can join room by using  credentials of existing room</li>
                        <li>There is no limit to add user in room</li>
                        <li>All massages are end-to-end encrypted.</li>
                        <li>Same experience across all devices , fully  responsive web app</li>

                    </ul>
                    <div>
                        <span class="create_room a">Create room

                        </span>
                        <span class="a" onclick="openJoinForm()">Join room</span>
                    </div>

                </div>
            </main>
            <div class="rooms">
                <h3>Your rooms</h3>


                <div class="chat-rooms">
                    <?php
                    $sql_ = "SELECT * FROM user_room WHERE user_linked = '$user'";

                    $execute = mysqli_query($link, $sql_);
                    if (mysqli_num_rows($execute) > 0) {
                        //checking for rooms created or joined by this user

                        while ($rooms = mysqli_fetch_assoc($execute)) {
                            $room = $rooms['room_name'];
                            $sql = "SELECT * FROM user_room WHERE room_name = '$room'";
                            $exec = mysqli_query($link, $sql);
                            $num = mysqli_num_rows($exec);
                            echo '<div class="room">

                                     <img src="' .
                                $rooms['thumbnail'] .
                                '" alt="">

                    <h4>' .
                                substr($rooms['room_name'] ,0,10) .
                                '</h4>
                    <h5> ' .
                                $num .
                                ' members</h5>

                    <form class="room_" action="go_to_room.php" method="POST">

                    <input type="hidden" required name="room_name" value="' .
                                $rooms['room_name'] .
                                '">

                    <input type="password" placeholder="Password" required name="room_key">

                    <button type="submit" name="join_btn"> Enter !</button>
                    </form>
                    </div>';
                        }
                    } else {
                         ?>

                        <div class="no-room-found">

                            <h2>You didn't join or create any chatting room </h2>
                            <p>
                                Please use above given button to join your friend's chat room or You can also create a new chatting room for your friend circle
                            </p>

                        </div>

                        <?php
                    }
                    ?>



                </div>
            </div>
            <div class="room_form">
                <form method="POST" action="create_room.php" enctype="multipart/form-data">
                    <span onclick="closeRoom()">&times</span>
                    <h3>Create personal chat room....</h3>
                    <input type="text" placeholder="Chat-room name..." required name="room_name" minlenght="4" maxlength="10" pattern="\w{4,10}">
                    <input type="file" required class='file' name="room_thumbnail">
                    <input type="password" placeholder="Password" name="password_room" required class="pass_room">
                    <input type="password" placeholder="Password" name="c_password_room" required class="c_pass_room">
                    <button type="submit" name="create" class="create">Create</button>
                    <small class="warn">Confirm Password should be same !</small>

                </form>
            </div>
            
            <div class="join_room">

                <form action="join_room.php" method="POST">
                    <span onclick="closeRoom2()">&times</span>
                    <h3>Join chat room....</h3>
                    <input type="text" placeholder="chat-room name..." required name="room_name">
                    <input type="password" placeholder="Password" name="password_room" required>

                    <button type="submit" name="join">Go !</button>


                </form>

            </div>

            <footer>
                <p>Created by <a href="https://github.com/Sanket-Gawande">Sanket-Gawande</a> with <i class="fa fa-heart"></i></p>
                <p class="bg-cyan">
                    
                All rights are reserved © GossiYape.com 2021-22
                </p>
            </footer>
        </body>
        <style>
       
   
        </style>
        <script src='javascript/home1.js'> </script>

        <script src='javascript/home2.js'></script>

    </html>