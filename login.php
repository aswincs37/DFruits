<!DOCTYPE html>
<html>
<head>
  <title>Login-Registration</title>
  
</head>
<body>
   <!--CSS-JS--> 
  <div class="main">
    <div class="formbox">
      <div class="btnbox">
        <div id="btn"></div>
        <button type="button" class="tog" onclick="login()">Login</button>
        <button type="button" class="tog" onclick="register()">Register</button>
        <button type="button" class="tog" onclick="admin()">Admin</button>
      </div>

      <!--Login Process--> 

      <form action="customer_login_process.php" method="POST" id="login" class="contain">
    <img src="./images/logo.png" class="logo" alt="logo">
    <p>LOGIN HERE</p>
    <label>Email</label>
    <input type="email" name="email" placeholder="Email" required="TRUE">
    <label>Password</label>
    <input type="password" name="pass" placeholder="Password" required="TRUE">
    <?php
    if (isset($_GET['el1'])) 
    {
        echo '<div class="conr">Incorrect Password</div>';
        echo '<br><br>';
    }
    ?>
    <a href="forgot.php">Forgot Password</a>
    <button type="submit" class="submitbtn">LOGIN</button><br>
    <?php
    if (isset($_GET['el2']))
     {
        echo '<div class="conr">Not Yet Registered? Please Register!</div>';
        echo '<br><br>';
    }
    ?>
     <?php 
          if(isset($_GET['er1'])) {
            echo '<div class="conr2">Already a Customer! Login.</div>';
            echo '<br><br>';
          }
        ?>
</form>



       <!--Registration Process-->
      
       <form action="customer_registration_process.php" method="POST" id="register" class="contain">
        <p>REGISTER HERE</p>
        <label>Name</label>
        <input type="text" name="name" placeholder="Name" pattern="[A-Za-z ]+" title="Name should contain only letters and spaces" required>

        <label>Gender</label>
        <div class="radio">
          <input type="radio" name="gender" value="Male" required> Male   
          <input type="radio" name="gender" value="Female" required> Female 
          <input type="radio" name="gender" value="Others" required> Others<br>
        </div> 

        <label>Phone Number</label>
        <input type="tel" id="phone" name="phone" placeholder="phone number with country code (+91 for India)" required><br>
        
       
        <div id="recaptcha-container"></div>
        <button type="button" onclick="phoneAuth()">Send OTP</button><br>
        Enter OTP: <input type="number" id="otp"><br>
        <button type="button" onclick="codeVerify()">Verify OTP</button><br>
        <div class="registration">
        <label>Email</label>
        <input type="email" name="email" placeholder="Email" required autocomplete="off">

        
            <p>Password</p>
            <label for="pass">(At least 8 characters <br>Including Uppercase, Lowercase, Numbers, and Special characters):</label><br>
            <input type="password" id="pass" name="pass" placeholder="Password" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$">
            <button type="submit" name="register" class="submitbtn2" id="regsub" disabled>REGISTER</button>
        </div>
        </div>
    </form>
<!--Firebase-->
    <script src="https://www.gstatic.com/firebasejs/9.12.1/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.12.1/firebase-auth-compat.js"></script>

    <script>
          // For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
    apiKey: "AIzaSyC3MIN64hy_oTQfQWUHl0lID-CJkIfci0M",
    authDomain: "yt-project-a29f8.firebaseapp.com",
    projectId: "yt-project-a29f8",
    storageBucket: "yt-project-a29f8.appspot.com",
    messagingSenderId: "159898773748",
    appId: "1:159898773748:web:2985334de4f06ff73356a1",
    measurementId: "G-DLWR9M5SJC"
};
// initializing firebase SDK
firebase.initializeApp(firebaseConfig);

        window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
        recaptchaVerifier.render();

        let confirmationResult;

        function phoneAuth() {
            const phoneNumber = document.getElementById('phone').value;
            const appVerifier = window.recaptchaVerifier;
            firebase.auth().signInWithPhoneNumber(phoneNumber, appVerifier)
                .then(function (result) {
                    confirmationResult = result;
                    console.log('OTP Sent');
                    alert('6 Digit OTP Sented!')
                })
                .catch(function (error) {
                    alert(error.message);
                });
        }

        function codeVerify() {
            const code = document.getElementById('otp').value;
            confirmationResult.confirm(code)
                .then(function (result) {
                    console.log('OTP Verified');
                    alert('OTP Verified');
                    const user = result.user;
                    // You can redirect or perform actions after successful verification here
                    regsub.disabled = false;
                })
                .catch(function (error) {
                    console.log('Incorrect OTP');
                    alert('Incorrect OTP');
                });
        }
    </script>

          <!--Admin Login Process--> 
      <form action="admin_login_process.php" method="POST" id="admin" class="contain">
    <img src="./images/logo.png" class="logo" alt="logo">
    <p>ADMIN LOGIN</p>
    <label>Admin Username</label>
    <input type="text" name="username" placeholder="Username" required="TRUE">
     <?php
   if (isset($_GET['wrongun'])) 
      {
        echo "<font color='red' font face='verdana' size='2'> <b>Incorrect Username !</b> </font>";
        echo "<br>";
      }
 ?>
    <label>Password</label>
    <input type="password" name="password" placeholder="Password" required="TRUE">
    <?php            

   if (isset($_GET['wrongpwd'])) 
      {
        echo "<font color='red' font face='verdana' size='2'> <b>Incorrect Password !</b> </font>";
        echo "<br>";   
      }
 ?>
 <button type="submit" class="submitbtn">LOGIN</button><br>
     
    </div>
  </div>

   <!--Java Script--> 
   <script>
    var x = document.getElementById("login"); 
    var y = document.getElementById("register");
    var a = document.getElementById("admin");
    var z = document.getElementById("btn");

    // Initially hide the admin form
    a.style.display = "none";

    function login() {
      x.style.left = "50px";
      y.style.left = "800px";
      a.style.display = "none"; // Hide the admin form when switching to login
      z.style.left = "0px";
    }

    function register() {
      x.style.left = "-800px";
      y.style.left = "50px";
      a.style.display = "none"; // Hide the admin form when switching to registration
      z.style.left = "90px";
    }

    function admin() {
      x.style.left = "-2000px";
      y.style.left = "-1500px"; // Move the register form to the right
      a.style.display = "block";  // Show the admin form
      a.style.left = "360px";
      a.style.top = "170px";
      z.style.left = "180px";
    }
</script>









<!--style-->


  <style>
    body {
      margin: 0;
      width: 100%;
      height: 100vh;
      font-family: serif;
      color: black;
      background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
      background-size: 400% 400%;
      -webkit-animation: gradientBG 10s ease infinite;
      animation: gradientBG 10s ease infinite;
    }

    .main {
      height: 100%;
      width: 100%;
      position: absolute;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .formbox {
      width: 655px;
      height: 500px;
      position: absolute;
      margin: 5% auto;
      background: #f5f6f8;
      padding: 5px;
      overflow: hidden;
      border-radius: 8px;
      box-shadow: 0 10px 28px rgba(0, 0, 0, 0.25), 0 16px 14px rgba(0, 0, 0, 0.22);
      transition: 0.5s;
    }

    .btnbox {
      width: 270px;
      margin: 20px auto;
      margin-top: 30px;
      position: relative;
      box-shadow: 0 0 15px 9px #ff61241f;
      border-radius: 30px;
      padding: 0;
      display: flex;
      justify-content: space-around;
    }

    .tog {
      padding: 15px 15px;
      cursor: pointer;
      background: transparent;
      border: 0;
      outline: none;
      position: relative;
      text-align: center;
    }

    #btn {
      top: 0;
      left: 0;
      position: absolute;
      width: 100px;
      height: 100%;
      background: linear-gradient(to right, #66ffff, #3399ff);
      border-radius: 30px;
      transition: 0.5s;
    }

    .contain {
      top: 80px;
      position: absolute;
      width: 200px;
      transition: 0.5s;
    }

    .contain input {
      width: 100%;
      padding: 10px 0;
      padding-top: 2px;
      margin: 0;
      font-size: larger;
      margin-bottom: 8px;
      border: 0;
      border-bottom: 2px solid #999;
      outline: none;
      background: transparent;
    }

    .contain input[type="text"]:valid,
    .contain input[type="email"]:valid,
    .contain input[type="password"]:valid,
    .contain input[type="number"]:valid {
      border-bottom: 3px solid #00FFB7;
    }

    .contain input[type="text"]:focus,
    .contain input[type="email"]:focus,
    .contain input[type="password"]:focus,
    .contain input[type="number"]:focus {
      border-bottom: 3px solid #00B6FF;
    }

    .contain a {
      outline: none;
      font-size: 15px;
      color: black;
      margin: 0;
      margin-left: 40px;
      margin-top: 20px;
      padding: 0;
      text-decoration: none;
      display: block;
    }

    .contain a:hover {
      color: #f46b45;
    }

    .contain p {
      outline: none;
      font-size: 20px;
      text-align: center;
      color: black;
      top: -30px;
      padding: 0;
      margin-bottom: 10px;
      font-weight: bold;
    }

    .contain label {
      color: #9933ff;
      display: inline-flex;
      outline: none;
      text-decoration: none;
      margin: 0;
      font-size: 15px;
    }
  
    .submitbtn,
    .submitbtn2 {
      width: 70%;
      padding: 10px 30px;
      cursor: pointer;
      display: block;
      margin: auto;
      color: #000;
      background: #d7d2cc;
      border: 0;
      outline: none;
      border-radius: 30px;
      margin-top: 20px;
      transition: 0.5s;
      font-size: 16px;
      line-height: 13px;
    }

    .submitbtn:hover,
    .submitbtn2:hover {
      background: linear-gradient(to left, #00B6FF, #00FFB6);
    }

    #regsub {
      margin-top: 15px;
    }

    #login {
      left: 50px;
    }

    #register {
      left: 800px;
    }

    .contain input[type="number"]::-webkit-inner-spin-button,
    .contain input[type="number"]::-webkit-outer-spin-button {
      -webkit-appearance: none;
    }

    .conr {
      color: red;
      size: 10px;
      text-align: center;
    }

    .conr2 {
      color: red;
      size: 10px;
      padding: 1px 2px;
      display: block;
      width: 200px;
      position: absolute;
      margin: 8px 0 0 37px;
      text-align: center;
    }

    ::placeholder {
      color: #999999;
      opacity: 50%;
      font-size:15px;
    }

    .logo {
      width: 300px;
      height: 300px;
      margin-top: 10px;
      margin-left: 300px;
      position: absolute;
    }

    .radio {
      font-size: 13px;
      display: inline-flex;
      width: 195px;
    }

    .mid {
      margin-top: -300px;
      margin-left: 280px;
      width: 200px;
      position: absolute;
    }
    .registration {
      font-size: large;
    position: absolute;
    top: 15%;
    right: 30%; 
    left: 300px;/* Adjust the right distance as needed */
    width: 300px; /* Adjust width if necessary */
}
.registration p{
  text-align: left;
  font-size: medium;
  color: #9933ff;
}
.registration form {
    width: 100%;
}

/* Update the label styles */
.registration label {
    color: #9933ff;
    display: block;
    margin-bottom: 5px;
    font-size: 15px;
}

/* Update the input styles */
.registration input[type="text"],
.registration input[type="email"],
.registration input[type="password"] {
    width: calc(100% - 20px);
    padding: 10px;
    margin-bottom: 10px;
}
.registration input[type="phone"]::placeholder,input[type="email"]::placeholder
{
  font-size: medium;
}
.registration  .submitbtn:hover,
    .submitbtn2:hover 
{
  color: #9933ff;
}
/* Update the button styles */
.registration .submitbtn2 {
    width: calc(100% - 20px);
    padding: 10px 0;
    margin-top: 10px;
    background: #d7d2cc;
    
    border-radius: 30px;
    transition: 0.5s;
    font-size: 16px;
    line-height: 13px;
    background: #d7d2cc;
    background: linear-gradient(to left, #00B6FF, #00FFB6);
}
    @-webkit-keyframes gradientBG {
      0% {
        background-position: 0% 50%;
      }
      50% {
        background-position: 100% 50%;
      }
      100% {
        background-position: 0% 50%;
      }
    }

    @keyframes gradientBG {
      0% {
        background-position: 0% 50%;
      }
      50% {
        background-position: 100% 50%;
      }
      100% {
        background-position: 0% 50%;
      }
    }
  </style>
