
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
   session_start();
   require('connection.php');
      if (!empty($_POST))
    {
      $mail=$_POST['email'];
       
      $q="select * from customer where email='$mail'";
      $res=mysqli_query($conn,$q)or die("wrong query");
      $row=mysqli_fetch_assoc($res);
      if(!empty($row))
      {
        if($_POST['pass']!=$row['pass'])
        {
          header("Location:login.php?el1=1");     
        }
      
        else
        {
          //$_SESSION=array();
          $_SESSION['c_id']=$row['c_id'];
          $_SESSION['name']=$row['name'];
          header("Location:./customer/index.php");
        }
      
          }
       else 
        {
        header("Location:login.php?el2=1");
        }
  }
?>    