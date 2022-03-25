<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/sign-page.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>create account: spoutchat</title>
</head>

<body>
    <div class="header">
       <img src="images/spoutchat.png" alt="logo" srcset="" class="logo">
       <div class="menu">
           <a href="./login.php"> Login </a>
           <a href="./signup.php">Singup</a>
       </div>
      </div>
    <div class="main">

        <form autocomplete="off" method="POST" enctype="multipart/form-data">


            <h3 class="heading">Create account</h3>
        
           <small class="show-alert"> </small>

            <input type="text" placeholder="Phone number..." name="phone_number" required pattern="[0-9]{10}$"
                title="Please enter a valid phone number" value=''>

            <input type="email" placeholder="Email" name="email" required title="Please enter a valid email" value=''>

            <input type="password" placeholder="Password" name="password" class="password" required>
            <input type="password" placeholder="Confirm Password" name="c_password" class="c_password" required>
            <button type="submit" name="sign_up_btn" class="submit">Sign up</button>
            <h5 class="sub-link">Already have an account ? <a href="./login.php">Login here</a></h5>
        </form>
    </div>

    
  <footer>
  <p>
    Created by <a href="https://github.com/Sanket-Gawande" target='_blank'>Sanket-Gawande</a> with <i class="fa fa-heart"></i>
  </p>
    <p class="bg-cyan">

      All rights are reserved ©spoutchat 2021-22
    </p>
  </footer>
  <script src='javascript/signup.js' defer> </script>
</body>

</html>