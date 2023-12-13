<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require('connection.php');

if (isset($_POST['register'])) 
{
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['pass'];

    // Check if email already exists
    $checkQuery = "SELECT * FROM customer WHERE email = '$email'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if ($checkResult && mysqli_num_rows($checkResult) > 0) {
        // Email already exists, registration failed
        header("Location: login.php?er1=1");
        exit;
    }
    else
    {

        $insertQuery = "INSERT INTO customer (name, gender, phone, email, pass)  
                        VALUES ('$name', '$gender', '$phone', '$email', '$password')";
        $result = mysqli_query($conn, $insertQuery);

        $q= mysqli_query($conn, "select * from customer where email='$email'");
        $r=mysqli_fetch_assoc($q);
        $c_id=$r['c_id'];

        if ($result)
         {
            // Registration successful
            $_SESSION['name'] = $name;
            $_SESSION['c_id'] = $c_id;
            header("Location: ./customer/index.php");
            exit;
        } 
    }
}
?>
