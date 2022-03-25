<main>
    <?php
    require('_conn.php');
error_reporting(0);
    $room = $_POST['room_name'];

    $user = $_POST['user_id'];

    $getMsg = "SELECT * FROM user_chats INNER JOIN user_data ON user_chats.msg_by = user_data.mo_no WHERE user_chats.msg_from_room = '$room' ORDER BY  text_id";

    $res = mysqli_query($link, $getMsg);

/* ----------------------------*/

//Function to encrypt massage :
function dcp($massage){
  $key  = "this is secreat key for massage decrypting";
  $cipher =  "AES-256-CTR";
  $iv = 1234567812348765;
  return openssl_decrypt($massage , $cipher , $key, 0 , $iv );
}
/* ----------------------------*/
    if ($res) {
        while ($data = mysqli_fetch_assoc($res)) {
      $msg = dcp($data['msg']);
            if ($user == $data['msg_by']) {
                $id = "sender";
            } else {
                $id = "receiver";
            }
            echo '
<div class="massage" id="'.$id.'">
				<p>'.$msg.'</p>
				<span class="username"><img src="'.$data["user_photo"].'"></span>
       <small>'.$data['msg_on'].'</small>
</div>

            ';

        }
    } else

    {

        echo "not found".mysqli_error($link);
    }

    echo "<script>document.querySelector('').id ='this_user'</script>";
    ?>

</main>
<style>
    .123 {
        color: red;
    }

    main {
        overflow-y: scroll;
        display: grid;
        padding: 10px 0;
        width:100%;
        height:100%;
    }
    main .massage {
        margin: 15px 20px;
        margin-left:55px;
        padding: 10px 20px;
        max-width: 50%;
        min-width: 50px;
        border-radius: 15px 15px 15px 0px;
        background: #fff;
        box-shadow: 0 0 5px rgba(0,0,0,.3);
        color:;
        position: relative;
        justify-self: start;
        font-size: .8rem;

    }
    .massage p {
        margin: 0;
    }
    main #sender {
        justify-self: end;
        background: darkcyan;
        color: #fff;
        border-radius: 15px 15px 0 15px;
        text-align: right;
        margin-right: 55px;
    }
    .massage span {
        position: absolute;
        right:calc(100% + 10px);
        top: 50%;
        transform: translateY(-50%);
        width: 35px;
        height: 35px;
        border-radius: 50%;
       
        overflow: hidden;
    }
    .massage small {
        position: absolute;
        color: #bbb;
        bottom: -15px;
        font-size: 8px;
        left: 10px;
    }
    #sender small {
        right: 0px;
    }

  #sender span {
       right: -50px;
       
    }
    .massage span img {
        width: 100%;
        height: 100%;
        background:none;
        margin: 0;
    }
</style>

<?php

?>