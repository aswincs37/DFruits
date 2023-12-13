<!DOCTYPE html>
<html lang="en">

<head>
    <title>D Fruits</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
       

        .welcome {
            display: block;
            color: white;
            float: left;
            margin-top: 5px;
            margin-left: 130px;
            font-size: 18px;
        }

        .welcome-text {
            text-align: center;
            position: absolute;
            width: 100%;
            height: auto;
            margin: 30% 0;
        }

        .welcome-text {
            position: absolute;
            width: 80%; /* Adjusted width for responsiveness */
            height: auto;
            margin: 20% 10%; /* Adjusted margin for responsiveness */
            text-align: center;
        }

        .welcome-text h1 {
            text-align: center;
            color: red;
            text-transform: uppercase;
            font-size: 25px;
            margin-top: -80px;
        }

        .welcome-text a {
            border: 1px solid #fff;
            padding: 10px 25px;
            text-decoration: none;
            text-transform: uppercase;
            font-size: 14px;
            margin-top: 15px;
            display: inline-block;
            color: black;
            background: gray;
        }

        .welcome-text a:hover {
            background: cyan;
            color: #333;
        }
        .welcome-text h1 {
    color: #fff; /* Set your desired text color */
    font-size: 30px; /* Set your desired font size */
    text-align: center; /* Set your desired text alignment */
    text-shadow: 4px 4px 4px red; 
    
}
footer {
    background-color: #f5f5f5;
    padding: 20px;
    text-align: center;
    bottom: 0;
    width: 100%;
}

.image-container {
    position: relative;
    display: inline-block;
    border: 2px solid #ccc; /* Border style */
    padding: 10px; /* Padding around the image */
    width: 100%; /* Set a fixed width for the box */
    height: 400px; /* Set a fixed height for the box */
    box-sizing: border-box; /* Include padding and border in the box dimensions */
    border-radius: 8px; /* Optional: Rounded corners */
    background-color: #f7f7f7; /* Optional: Background color */
}

.image-container img {
    display: block;
    width: 100%;
    height: auto;
}


        .image-button {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border: none;
            font-size: 16px;
            cursor: pointer;
           
        }

        .image-button:hover {
            background-color: #0056b3;
        }
   



    </style>
</head>

<body>

    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require('./customer_navbar.php');
    ?>
    
 <!-- Slider Section -->
 <div id="homeSlider" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
            <div class="image-container">
        <a href="../customer/products.php">
            <button class="image-button">Shop Now</button>
                <img src="../images/bg2.jpg" class="d-block w-100" alt="First Slide" >
            </div>
            </a>
    </div>
            <div class="carousel-item">
            <div class="image-container">
        <a href="products.php">
            <button class="image-button">Shop Now</button>
                <img src="../images/bg3.jpg" class="d-block w-100" alt="First Slide" >
            </div>
            </a>
                
            </div>
            <div class="carousel-item">
            <div class="image-container">
        <a href="products.php">
            <button class="image-button">Shop Now</button>
                <img src="../images/bg4.jpg" class="d-block w-100" alt="First Slide" >
            </div>
            </a>
            </div>
            <div class="carousel-item">
            <div class="image-container">
        <a href="products.php">
            <button class="image-button">Shop Now</button>
                <img src="../images/bg5.jpg" class="d-block w-100" alt="First Slide" >
            </div>
            </a>
            </div>
        
        </div>
        <a class="carousel-control-prev" href="#homeSlider" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#homeSlider" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <!-- JavaScript/jQuery for automatic sliding -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#homeSlider').carousel({
                interval: 5000, // Adjust the interval as needed (in milliseconds)
                pause: 'hover' // Optional: pause on hover
            });

            // Automatically start sliding
            setInterval(function () {
                $('#homeSlider').carousel('next');
            }, 4000); // Change the time to slide automatically
        });
    </script>
    <div class="welcome-text">
        <h1>For a snack that’s healthy and delicious, try these dried fruits</h1>
       
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    

   </footer>
   <!--Products-->
   <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>D Fruits</title>
    <style>
        .card {
            height: 100%; /* Set a fixed height for all cards */
        }

        .card:hover {
            box-shadow: 0px 0px 15px 0px rgba(0, 0, 0, 0.3); /* Add box shadow on hover */
            transform: scale(1.05); /* Increase size on hover */
            transition: all 0.3s ease-in-out; /* Add smooth transition */
        }

        .in-stock {
            padding: 5px 10px;
            background-color: #28a745; /* Green background color */
            color: white; /* Text color */
            border-radius: 4px;
        }
        .rupee {
  font-size: 30px;
  color: #2c3e50;
        }
        .stylish-text {
  text-shadow: 1px 1px 1px #333; 
        }
        .price-container {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    border: 1px solid #ccc;
    padding: 10px;
}

.price-details {
    display: flex;
    justify-content: flex-start;
    align-items: baseline;
    margin-bottom: 5px;
}

.original-price {
    font-size: 18px;
    color: #000; /* Original price color */
    text-decoration: line-through; /* Strikethrough for original price */
    margin-right: 10px;
}

.offer-percentage {
    font-size: 14px;
    color: #388e3c; /* Offer percentage color */
}

.final-offer-price {
    font-size: 24px;
    color: #d32f2f; /* Final offer price color */
}

    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Products</h1>
        <div class="row">
            <?php
            require('../connection.php');
           // require('customer_navbar.php');

            $q = "SELECT * FROM product ORDER BY product_id DESC"; // Order by latest inserted
            $r = mysqli_query($conn, $q) or die("Wrong Query!");

            while ($row = mysqli_fetch_assoc($r)) { ?>
                <div class="col-md-3 mb-3">
                    <div class="card">
                    <img src="../images/<?php echo htmlspecialchars($row['image1']); ?>" style="height: 200px;" class="card-img-top" alt="Product Image">

                        <div class="card-body">
                        <h4 class="card-title stylish-text"><?php echo htmlspecialchars($row['product_name']); ?></h4>
                        <div class="price-container">
    <div class="price-details">
        <span class="original-price">&#x20B9;<?php echo htmlspecialchars($row['price']); ?></span>
        <span class="offer-percentage"><?php echo htmlspecialchars($row['percentage']); ?>% off</span>
    </div>
    <div class="final-offer-price">&#x20B9;<?php echo htmlspecialchars($row['offer_price']); ?></div>
</div>



                            <p class="card-text">
                                <?php 
                                    $stock = htmlspecialchars($row['stock'] . " KG Available");
                                    echo "<span class='in-stock'>$stock</span>"; // Apply the 'in-stock' style to the stock information
                                ?>
                            </p>
                            <a href="view_product.php?product_id=<?php echo $row['product_id']; ?>" class="btn btn-primary btn-block">View Product</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
<!--categories-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>D Fruits</title>
    <style>
        .card {
            height: 100%; /* Set a fixed height for all cards */
        }

        .card:hover {
            box-shadow: 0px 0px 15px 0px rgba(0, 0, 0, 0.3); /* Add box shadow on hover */
            transform: scale(1.05); /* Increase size on hover */
            transition: all 0.3s ease-in-out; /* Add smooth transition */
        }

        .in-stock {
            padding: 5px 10px;
            background-color: #28a745; /* Green background color */
            color: white; /* Text color */
            border-radius: 4px;
        }
        .rupee {
  font-size: 30px;
  color: #2c3e50;
        }
        .stylish-text {
  text-shadow: 1px 1px 1px #333; 
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Categories</h1>
        <div class="row">
            <?php
            require('../connection.php');
            //require('customer_navbar.php');

            $q = "SELECT * FROM category ORDER BY cat_id DESC"; // Order by latest inserted
            $r = mysqli_query($conn, $q) or die("Wrong Query!");

            while ($row = mysqli_fetch_assoc($r)) { ?>
                <div class="col-md-3 mb-3">
                    <div class="card">
                    <img src="../images/<?php echo htmlspecialchars($row['cat_image']); ?>" style="height: 200px;" class="card-img-top" alt="Category Image">

                        <div class="card-body">
                        <h2 class="card-title stylish-text"><?php echo htmlspecialchars($row['cat_name']); ?></h2>

                          
                            <a href="product_categories.php?cat_id=<?php echo $row['cat_id']; ?>" class="btn btn-primary btn-block">View Products</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

    <footer>
        <?php
require('footer.php');
    ?></footer>

</body>

</html>
<footer>
    


