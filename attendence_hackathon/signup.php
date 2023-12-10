<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign Up</title>
 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <style media="screen">
      *,
*:before,
*:after{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body{
    background-color: #080710;
    size: 80%
}
.background{
    width: 430px;
    height: 520px;
    position: absolute;
    transform: translate(-50%,-50%);
    left: 50%;
    top: 50%;
}
.background .shape{
    height: 200px;
    width: 200px;
    position: absolute;
    border-radius: 50%;
}
.shape:first-child{
    background: linear-gradient(
        #1845ad,
        #23a2f6
    );
    left: -80px;
    top: -80px;
}
.shape:last-child{
    background: linear-gradient(
        to right,
        #ff512f,
        #f09819
    );
    right: -30px;
    bottom: -80px;
}
form{
    height: 660px;
    width: 400px;
    background-color: rgba(255,255,255,0.13);
    position: absolute;
    transform: translate(-50%,-50%);
    top: 50%;
    left: 50%;
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    padding: 50px 35px;
}
form *{
    font-family: 'Poppins',sans-serif;
    color: #ffffff;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
}
form h3{
    font-size: 30px;
    font-weight: 500;
    line-height: 42px;
    text-align: center;
    padding-bottom: 7px;
}


label{
    display: block;
    margin-top: 30px;
    font-size: 16px;
    font-weight: 500;
}
input{
    display: block;
    height: 50px;
    width: 100%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 20px;
    padding: 0 10px;
    margin-top: 15px;
    font-size: 14px;
    font-weight: 300;
}
::placeholder{
    padding: 7px;
    color: #e5e5e5;
}
button{
    margin-top: 50px;
    width: 100%;
    background-color: #ffffff;
    color: #080710;
    padding: 15px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 20px;
    cursor: pointer;
}
.social{
  margin-top: 30px;
  display: flex;
}
.social div{
  background: red;
  width: 150px;
  border-radius: 3px;
  padding: 5px 10px 10px 5px;
  background-color: rgba(255,255,255,0.27);
  color: #eaf0fb;
  text-align: center;
}
.social div:hover{
  background-color: rgba(255,255,255,0.47);
}
.social .fb{
  margin-left: 25px;
}
.social i{
  margin-right: 4px;
}


    </style>
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form action="signup_process.php" method="post">
        <h3>Login Here</h3>
        <input type="email" id="email" name="email" placeholder="Email" required>
        <input type="text" id="firstName" name="firstName" placeholder="First Name" required>
        <input type="text" id="lastName" name="lastName" placeholder="Last Name" required>


        <input type="password" id="password" name="password" placeholder="Password" required>
        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required>


        <button>Log In</button>
        <div class="social">
          <div class="go"><i class="fab fa-google"></i>  Google</div>
          <div class="fb"><i class="fab fa-facebook"></i>  Facebook</div>
        </div>
    </form>
</body>
</html>

<?php
    if (isset($_GET["result"])) {
        if ($_GET["result"] == "emptyinput") {
            echo "<div class='alert-error'><p>Error: Empty Field</p></div>";
        }
        else if ($_GET["result"] == "uidfalse") {
            echo "<div class='alert-error'><p>Error: Username or Email Does Not Exist</p></div>";

        }
        else if ($_GET["result"] == "passwordsdontmatch") {
            echo "<div class='alert-error'><p>Error: Passwords Don't Match</p></div>";
        }
    }
?> 
<div>
    <h2>Teacher Sign Up</h2>
    <form action="signup_process.php" method="post">
        <label for="firstName">First Name:</label>
        <input type="text" id="firstName" name="firstName" required>


        <br><label for="lastName">Last Name:</label>
        <input type="text" id="lastName" name="lastName" required>


        <br><label for="email">Email:</label>
        <input type="email" id="email" name="email" required>


        <br><label for="password">Password:</label>
        <input type="password" id="password" name="password" required>


        <br><label for="confirmPassword">Confirm Password:</label>
        <input type="password" id="confirmPassword" name="confirmPassword" required>


        <br><button type="submit" name="submit">Sign Up</button>
    </form>
</div>


</body>
</html>