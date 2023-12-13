<!DOCTYPE html>
<html>
<head>
    <title>FORGOTTEN PASSWORD</title>
    <style type="text/css">
        body {
            background-color: linear-gradient(to left, #00B6FF, #00FFB6);
        }

        .main {
            height: 100%;
            width: 100%;
            background: linear-gradient(to left, #00B6FF, #00FFB6);
            background-position: center;
            background-size: cover;
            position: absolute;
        }

        .box {
            width: 380px;
            height: 400px;
            position: absolute;
            text-align: center;
            left: 40%;
            margin: 5% auto;
            background: #f5f6f8;
            padding: 5px;
            padding-top: 50px;
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 10px 28px rgba(0,0,0,0.25), 
                    0 16px 14px rgba(0,0,0,0.22);
        }

        .box h2 {
            text-align: center;
            margin-top: -30px;
            margin-bottom: 12px;
        }

        .box h6 {
            font-size: 12px;
            margin-bottom: 40px;
            color: blue;
        }

        .box p {
            text-align: left;
            margin-left: 15px;
        }

        .box input[type='email'],
        .box input[type='text'] {
            width: 350px;
            padding: 10px auto;
            margin: 0;
            margin-bottom: 25px;
            border: 0;
            border-bottom: 3px solid #999;
            outline: none;
            background: transparent;
        }

        .er {
            margin-top: 60px;
            position: relative;
            font-size: 18px;
        }

        .box input[type="submit"] {
            background: #000;
            color: #fff;
            width: 30%;
            padding: 12px 10px;
            position: absolute;
            left: 35%;
            transition: 0.5s;
        }

        .box input[type="submit"]:hover {
            background: green;
        }

        a {
            text-decoration: none;
            color: red;
        }

        a:hover {
            color: green;
        }
    </style>
</head>
<body>
    <div class="main">
        <div class="box">
            <h2>FORGOTTEN PASSWORD</h2>
            <h6>Enter Your Registered Email & Phone Number<br>To Get Your Password</h6>
            <form method="POST" action="">
                <input type="email" name="mail" required="TRUE" placeholder="Email"><br>
                <input type="text" name="phno" required="TRUE" placeholder="Mobile Number"><br>
                <input type="submit" name="fp" value="Confirm">
            </form>
            <?php
            require('connection.php');
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            if (isset($_POST['fp'])) {
                $email = $_POST['mail'];
                $phno = $_POST['phno'];
               
                $q = "select * from customer where email='$email'";
                $res = mysqli_query($conn, $q) or die("wrong query");
                $row = mysqli_fetch_assoc($res);
                if (!empty($row)) 
				{
                    if ($phno != $row['phone'])
					 {
                        echo "<script>alert('Phone Number Not Matched!'); </script>";
					 }
					else 
					{
						echo '<br><br><br><br>';
                        echo '<div class="fp">';
						echo 'Hi,' .$row['name'].'<br>' ;
                        echo 'Your Last Password was :' . $row['pass'] . '<br>';
                        echo '<a href="login.php">Login Again Now</a>';
                        echo "</div>";
                    }
                } else {
                    echo "<script>alert('Not Yet Registered!'); window.open('login.php','_self')</script>";
                }
            }
            ?>
        </div>
    </div>
</body>
</html>

