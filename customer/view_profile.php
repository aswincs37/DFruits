<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Your custom CSS styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding-top: 50px;
        }

        .profile-form {
            max-width: 400px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <!-- Your navbar content from customer_navbar.php -->
        <?php require('customer_navbar.php'); ?>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center mb-4">My Profile</h1>

        <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        require('../connection.php');

       

        if (!isset($_SESSION['c_id'])) {
            echo "<script>alert('Login to your account!')</script>";
            echo "<script>window.open('../login.php','_self')</script>";
            exit();
        } else {
            $cid = $_SESSION['c_id'];
            $q = "select * from customer where c_id=$cid";
            $result = mysqli_query($conn, $q);
            $row = mysqli_fetch_assoc($result);
        ?>
            <div class="profile-form">
                <p><strong>Name:</strong> <?php echo $row['name']; ?></p>
                <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
                <p><strong>Gender:</strong> <?php echo $row['gender']; ?></p>
                <p><strong>Phone:</strong> <?php echo $row['phone']; ?></p>

                <p><strong>Change Password?</strong></p>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="currentPass">Current Password:</label>
                        <input type="password" class="form-control" placeholder="Enter Current Password" id="currentPass" name="currentpass">
                    </div>
                    <div class="form-group">
                    <label for="pass">(At least 8 characters <br>Including Uppercase,Lowercase,Numbers, and Special characters):</label><br>
        <input type="text"  name="newpass" placeholder="Enter New Password" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$">
                    </div>
                    <div class="form-group">
                        <label for="confirmPass">Confirm Password:</label>
                        <input type="password" class="form-control" placeholder="Confirm Password!" id="confirmPass" name="confirmpass">
                    </div>
                    <button type="submit" name="submit" class="btn btn-danger">Change Password</button>
                </form>

                <?php
                if (isset($_POST['submit'])) {
                    $currpass = $_POST['currentpass'];
                    $newpass = $_POST['newpass'];
                    $confirmpass = $_POST['confirmpass'];

                    if ($row['pass'] == $currpass) {
                        if ($newpass == $confirmpass) {
                            $q = "update customer set pass='$newpass' where c_id=$cid";
                            mysqli_query($conn, $q);
                        } else {
                            echo "<script>alert('New Password & Confirm Password Can\'t Match!')</script>";
                        }
                    } else {
                        echo "<script>alert('New Password & Old Password Can\'t Match!')</script>";
                    }
                }
                ?>
            </div>
        <?php
        }
        ?>

    </div>

    <!-- Bootstrap JS (Optional, if needed) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
