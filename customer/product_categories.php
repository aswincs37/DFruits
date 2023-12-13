<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .product {
            width: 100%;
            max-width: 300px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd; /* Adding a border to each product */
        }

        .product img {
            width: 100%;
            height: auto;
            margin-bottom: 10px;
        }

        .product h2 {
            margin-bottom: 5px;
            font-weight: 600;
        }

        .product h5 {
            margin-bottom: 15px;
        }

        .btn {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            transition: background-color 0.3s;
        }

        .btn:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .in-stock {
            font-size: 14px;
            padding: 5px 8px;
            border-radius: 20px;
            background-color: #28a745; /* Green background color */
            color: #fff;
        }
        h1{
            text-align: center;
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
<body><br>
    <h1>Products</h1>
<div class="container">
    <div class="row">
        <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        require('customer_navbar.php');
        require('../connection.php');

        if (!empty($_GET['cat_id'])) {
            $customer_id = isset($_SESSION['c_id']) ? $_SESSION['c_id'] : null;
            $cid = $_GET['cat_id'];
            $q = "SELECT * FROM product where cat_id='$cid'";
            $result = mysqli_query($conn, $q) or die("Query failed: " . mysqli_error($conn));

            while ($row = mysqli_fetch_array($result)) {
                ?>
                <div class="col-md-4 mb-3">
                    <form method="post" action="" class="product">
                        <div id="productCarousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="../images/<?php echo $row['image1']; ?>" class="d-block w-100"
                                         alt="image1">
                                </div>
                                <div class="carousel-item">
                                    <img src="../images/<?php echo $row['image2']; ?>" class="d-block w-100"
                                         alt="image2">
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

                        <h2><?php echo $row['product_name']; ?></h2>
                        <h5><?php echo $row['description']; ?></h5>
                        <h5 class="in-stock">Available: <?php echo $row['stock'] . " pieces"; ?></h5>
                        <div class="price-container">
    <div class="price-details">
        <span class="original-price">&#x20B9;<?php echo htmlspecialchars($row['price']); ?></span>
        <span class="offer-percentage"><?php echo htmlspecialchars($row['percentage']); ?>% off</span>
    </div>
    <div class="final-offer-price">&#x20B9;<?php echo htmlspecialchars($row['offer_price']); ?></div>
</div>
                        <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                        <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>">
                        <input type="hidden" name="product_image" value="<?php echo $row['image1']; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">

                        <?php
                        if ($row['stock'] == 0) {
                            echo '<input type="submit" name="submit" value="Out of Stock" class="btn" disabled>';
                        } else {
                            echo '<input type="submit" name="submit" value="Add to Cart" class="btn btn-primary">';
                        }
                        ?>
                    </form>
                </div>
            <?php
            }
        }
        ?>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


<?php
if (isset($_POST['submit'])) {
    if (isset($_SESSION['c_id'])) {
        // Get form data
        $customer_id = $_SESSION['c_id'];
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_image = $_POST['product_image'];
        $product_price = $_POST['product_price'];
        $quantity = 1;

        // Check if the product is already in the cart
        $sql = "SELECT * FROM cart WHERE customer_id = $customer_id AND product_id = $product_id";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('This product is already added to your cart.');</script>";
            echo "<script>window.open('cart.php', '_self')</script>";
        } else {
            // Insert product into cart
            $insert_query = "INSERT INTO cart (customer_id, product_id, product_name, quantity, price, image) VALUES ('$customer_id', '$product_id', '$product_name', '$quantity', '$product_price', '$product_image')";
            $insert_result = mysqli_query($conn, $insert_query);

            if ($insert_result) {
                echo "<script>
                    if (confirm('Added to cart. Do you want to continue shopping?')) {
                        window.open('product_categories.php', '_self');
                    } else {
                        window.open('cart.php', '_self');
                    }
                </script>";
            } else {
                echo "<script>alert('Failed to add the product to the cart.');</script>";
            }
        }
    } else {
        echo "<script>alert('Please Login!');</script>";
        echo "<script>window.open('../login.php', '_self')</script>";
    }
}
?>
</body>
</html>
