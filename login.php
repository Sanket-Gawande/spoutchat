<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/sign-page.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>login here: spoutchat</title>
</head>

<body>
    <div class="header">
       <img src="images/spoutchat.png" alt="logo" srcset="" class="logo">
       <div class="menu">
           <a href="./login.php">Login</a>
           <a href="./signup.php">Singup</a>
       </div>
      </div>
    <div class="main">

        <form autocomplete="off" method="POST">

            <h3 class="heading">Login here</h3>
            <small  class="show-alert"> </small>
        
             <input type="text" placeholder="Phone number..." required pattern="[0-9]{10}$" title="Please enter a valid phone number" name="phone">
            <input type="password" placeholder="Password" required name="pass_">
            <button type="submit" name="login_btn">Login </button>
            <h5 class="sub-link">Already have an account ? <a href="./signup.php">sign up here</a></h5>
          </form>

    </div>

    
  <footer>
  <p>
     Created by <a href="https://github.com/Sanket-Gawande">Sanket-Gawande</a> with <i class="fa fa-heart"></i>
</p>
    <p class="bg-cyan">

      All rights are reserved ©spoutchat 2021-22
    </p>
  </footer>
  <script src='./javascript/login.js'></script>
</body>

</html>