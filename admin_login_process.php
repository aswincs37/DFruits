<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require ('connection.php');
if (!empty($_POST)) 
    {
	   $un=$_POST['username'];
	   $q="select * from login where username='$un'";
	   $res=mysqli_query($conn, $q) or die("Wrong query");
	   $row=mysqli_fetch_assoc($res);
	   if (!empty($row)) 
	   {
	   	if ($_POST['password']==$row['password']) 
	   	{
            $_SESSION['uname'] = $row['username'];
                $_SESSION['pass'] = $row['password'];
                header("location:./Admin/admin_home.php");
	   		
	   	}
          else
          {
          	header("location:login.php?wrongpwd=1");
          }

	   }
	   else
	   {
         header("location:login.php?wrongun=1");
	   }

     }
 ?>    
