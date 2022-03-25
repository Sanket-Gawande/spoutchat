<?php
require('_conn.php');

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['change'])){
$user = $_POST['phone'];
$q ="SELECT pass_key,email from  user_data WHERE mo_no ='$user'";
$run = mysqli_query($link , $q);

if($run){
  
  $data = mysqli_fetch_assoc($run);
  echo  $pass_key =  $data['pass_key'];
 echo   $user_email =  $data['email'];
  
}


//Load Composer's autoloader
require('phpMailer/Exception.php');
require('phpMailer/PHPMailer.php');
require('phpMailer/SMTP.php');

//$key = 'thisisdummykey';
//$email = "sanketgawande96k@gmail.com";
  //Create an instance; passing `true` enables exceptions
function send_mail($email , $key)
{
  $mail = new PHPMailer(true);

  try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP(); //Send using SMTP
    $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
    $mail->SMTPAuth = true; //Enable SMTP authentication
    $mail->Username = 'chatroompaswordverify@gmail.com'; //SMTP username
    $mail->Password = 'Chat-room@password-verify@369'; //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
    $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('chatroompaswordverify@gmail.com', 'GosiYappe');
    $mail->addAddress($email); //Add a recipient
    $mail->isHTML(true);
    //Set email format to HTML
    $mail->Subject = 'Change password.';
    $mail->Body = ' <a href=`http://localhost:8080/chat_app_php/auth.php?key='.$key.'`>Click here </a> to change your pass';


   $mail->send();
    echo 'Message has been sent';
  } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
  }
  send_mail($user_email , $pass_key);
}

?>





<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width , initial-scale=1.0">
    <title>Password reset</title>
  </head>
  <body>
    <form action="mail.php" method="post" accept-charset="utf-8">
      <h2>Enter phone number linked  to get account verification link </h2>
      <input type="text" name="phone" id="" value="" />
      <br>
      <button name="change" type="submit">Send email</button>
    </form>
  </body>
</html>