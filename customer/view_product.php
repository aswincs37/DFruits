<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .main {
            max-width: 800px; /* Adjust the maximum width as needed */
            margin: 20px auto; /* Adjust margin */
            padding: 10px; /* Adjust padding */
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            color: red;
            display: flex;
        }

        .product-image {
            flex: 1;
            margin-right: 20px; /* Adjust margin */
        }

        img {
            width: 100%;
            height: auto;
        }

        .product-details {
            flex: 1;
        }

        h2{
            font-family:Georgia, 'Times New Roman', Times, serif;
            font-weight:lighter;
        }

        input[type="submit"] {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 18px;
            cursor: pointer;
            margin-top: 10px;
        }

        input[type="submit"]:hover {
            background-color: #258cd1;
        }
        .in-stock {
            padding: 5px 10px;
            background-color: #28a745; /* Green background color */
            color: white; /* Text color */
            border-radius: 4px;
        }
        
    </style>
</head>

<body>
    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require('customer_navbar.php');
    require('../connection.php');
    if (!empty($_GET['product_id'])) {
        $customer_id = isset($_SESSION['c_id']) ? $_SESSION['c_id'] : null;
        $pid = $_GET['product_id'];
        $q = "SELECT * FROM product where product_id='$pid'";
        $result = mysqli_query($conn, $q) or die("Query failed: " . mysqli_error($conn));
        while ($row = mysqli_fetch_array($result)) {
    ?>
            <form method="post" action="">
                <div class="container main">
                    <div class="product-image">
                        <div id="productCarousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="../images/<?php echo $row['image1']; ?>" class="d-block w-100" alt="image1">
                                </div>
                                <div class="carousel-item">
                                    <img src="../images/<?php echo $row['image2']; ?>" class="d-block w-100" alt="image2">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#productCarousel" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#productCarousel" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <div class="product-details">
    <h2><?php echo $row['product_name']; ?></h2>
    <h5><?php echo $row['description']; ?></h5>
    <h5 class="in-stock">Available: <?php echo $row['stock']." pieces"; ?></h5>
    <h2>Price: <?php echo $row['price']; ?>/-</h2>
    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
    <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>">
    <input type="hidden" name="product_image" value="<?php echo $row['image1']; ?>">
    <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">

    <?php
    // Check if the stock is zero
    if ($row['stock'] == 0) {
        // Disable the "Add to Cart" button
        echo '<input type="submit" name="submit" value="Out of Stock" class="btn btn-primary" disabled>';
    } else {
        // Enable the "Add to Cart" button
        echo '<input type="submit" name="submit" value="Add to Cart" class="btn btn-primary">';
    }
    ?>
</div>

                </div>
            </form>
    <?php
        }
    }
    ?>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require('../connection.php');

if (isset($_POST['submit'])) {
    if (isset($_SESSION['c_id'])) {
        $customer_id = $_SESSION['c_id'];
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_image = $_POST['product_image'];
        $product_price = $_POST['product_price'];
        $quantity = 1;

     
        $sql = "SELECT * FROM cart WHERE customer_id = $customer_id AND product_id = $product_id";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('This product is already added to your cart.');</script>";
            echo "<script>window.open('cart.php', '_self')</script>";
        } else {
            
            $insert_query = "INSERT INTO cart (customer_id, product_id, product_name, quantity, price, image) VALUES ('$customer_id', '$product_id', '$product_name', '$quantity', '$product_price', '$product_image')";
            $insert_result = mysqli_query($conn, $insert_query);

            if ($insert_result) {
                echo "<script>
                if (confirm('Added to cart. Do you want to continue shopping?')) {
                    window.open('products.php', '_self');
                } else {
                    window.open('cart.php', '_self');
                }
            </script>";
            
            } else {
                echo "<script>alert('Failed to add the product to the cart.');</script>";
            }
        }
    }
    else
     {
        echo "<script>alert('Please Login!');</script>";
        echo "<script>window.open('../login.php', '_self')</script>";
     }
}
?>
