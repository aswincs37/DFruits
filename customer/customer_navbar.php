<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dry Fruits Shop</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 60px;
        }

        .navbar-brand img {
            max-height: 43px;
            margin-left: 2px;
        }

        .cust a {
            color: white;
            font-weight: bold;
            text-decoration: none;
            transition: color 0.3s, background-color 0.3s;
        }

        .cust a:hover {
            color: #333;
            background-color: #fff; /* Change to your preferred color */
        }
        .nav-link {
        text-shadow: 1px 1px 1px #000; 
        
        font-weight: bold;
        color: orange; /* Adjust the color to your preference */
        margin-left: -10px; /* Adjust the margin as needed */
        
    }
    i
    {
        color: orangered;
    }
    .form-inline {
        margin-left: 15px;
    }
  
   
    </style>
</head>

<body>

    <!-- Bootstrap Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-info fixed-top">
        <a class="navbar-brand" href="index.php">
            <img src="../images/logo.png" alt="Logo" class="img">
        </a>
        <div class="nav-item">
    <?php
    if (isset($_SESSION['name'])) {
        echo "<span class='nav-link'>Welcome "  . $_SESSION['name'] . "</span>";
    } else {
        echo "<a href='../login.php' class='btn btn-outline-light'>LOGIN||REGISTER</a>";
    }
    ?>
</div>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <!-- Search Form -->
                <li class="nav-item">
                    <form class="form-inline" method="POST" action="search_process.php">
                        <input class="form-control mr-sm-2" type="text" name="search" placeholder="Search products">
                        <button class="btn btn-primary my-2 my-sm-0" type="submit" name="search_button">Search</button>
                    </form>
                </li>
            </ul>
            
            <ul class="navbar-nav ml-auto">
                <!-- Navigation Buttons -->
                <a  href="cart.php" style="text-decoration: none; color:black; ">My cart<i class="fa" style="font-size:24px">&#xf07a;</i></a>
    <span>  <?php
                    require('../connection.php');
                    if (isset($_SESSION['c_id'])) 
                    {
                        $cust_id=$_SESSION['c_id'];
                        $q = mysqli_query($conn, "select * from cart where customer_id='$cust_id'") or die("Query Failed!");
                    $count = mysqli_num_rows($q);
                    echo $count;
                    }
                    else echo "0";
                    ?> </span>
                <li class="nav-item">
                    <a href="index.php" class="btn btn-success ml-2">Home</a>
                </li>
                <li class="nav-item">
                    <a href="./products.php" class="btn btn-success ml-2">Products</a>
                </li>
                <li class="nav-item">
                    <a href="categories.php" class="btn btn-success ml-2">Categoy</a>
                </li>
               
                <li class="nav-item">
                    <a href="profile.php" class="btn btn-success ml-2">My Profile</a>
                </li>
                <li class="nav-item">
                    <a href="about.php" class="btn btn-success ml-2">About Us</a>
                </li>
               <?php if (isset($_SESSION['c_id'])) 
                    {?>
                <li class="nav-item">
                    <a href="logout.php" class="btn btn-danger ml-2">Logout</a>
                </li>
                   <?php }?>
            </ul>
        </div>
    </nav>

    <!-- Include Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    
</body>

</html>




