<?php 
require('admin_navbar.php');
?>
<!DOCTYPE html> 
<html>
<head>
	<title>Admin HOME PAGE</title>
</head>
<body> 
  <h1>Welcome Admin!</h1>
</body>
</html>



<style type="text/css">
  body
  {
    background-image: url(../images/logo.png);
    background-repeat: no-repeat;
    font-family:serif;  
    background-position-x:380px;
    background-position-y:70px;
   

  }

h1{
  text-align: center;
  margin-left: 50px;
   margin-top: 260px;
    color: blueviolet;
   font-size: 40px;
    display: inline-block;
                  font-weight: bold;
                  animation: mover 4s linear infinite;
                  }

@keyframes mover
               {
                0%
                  {
                   text-shadow: 0 0 0px rgba(0,0,0,0);
                   }
                50%
                  {
                  text-shadow: 0 0 0px rgba(0,0,0,0.30);
                  transform: translateY(15px);
                  }
               80%
                  {
                  text-shadow: 0 0 0px rgba(0,0,0,0);
                  }
               }
</style>

