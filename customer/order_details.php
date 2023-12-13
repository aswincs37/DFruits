<?php
include('customer_navbar.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="container"><br><br><br>
        <h1>Checkout</h1>
        <form method="post" action="">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" placeholder="Enter your name for This Purchase" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="address">Delivery Address:</label>
                <textarea id="address" name="address" placeholder="Enter the Delivery Address" class="form-control" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="text" name="phone" placeholder="Phone Number" pattern="[6-9]{1}[0-9]{9}" title="Enter a valid Indian phone number (10 digits starting with 6-9)" required>

            </div>

            <input type="submit" name="submit" value="Make Payment" class="btn btn-primary">
        </form>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require('../connection.php');

if (isset($_GET['c_id']) && isset($_POST['submit'])) {
    $customer_id = $_GET['c_id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $invoice_no = mt_rand();
    $status = 'pending';

    $cart_query_price = "SELECT * FROM cart WHERE customer_id = '$customer_id'";
    $result_cart_price = mysqli_query($conn, $cart_query_price);
    $count_products = mysqli_num_rows($result_cart_price);

    $productIds = array();
    $quantityArray = array();

    while ($row_price = mysqli_fetch_assoc($result_cart_price)) {
        $product_id = $row_price['product_id'];
        $quantity = $row_price['quantity'];
        $productIds[] = $product_id;
        $quantityArray[$product_id] = $quantity;
    }

    if (!empty($productIds)) {
        $productidsString = implode(',', $productIds);
        $mergedArray = array();

        foreach ($productIds as $product_id) {
            if (array_key_exists($product_id, $quantityArray)) 
            {
                $mergedArray[] = $product_id . ':' . $quantityArray[$product_id];
            } 
            else {
                $mergedArray[] = $product_id . ':0';
            }
        }

        $mergedString = implode(',', $mergedArray);

        $subtotal = 0;

        foreach ($quantityArray as $product_id => $quantity) {
            $select_products = "SELECT * FROM product WHERE product_id = '$product_id'";
            $run_price = mysqli_query($conn, $select_products);

            while ($row_product_price = mysqli_fetch_assoc($run_price)) {
                $product_price = $row_product_price['price'];
                $subtotal += $product_price * $quantity;

                $updateQuery = "UPDATE product SET stock = stock - '$quantity' WHERE product_id = '$product_id'";
                $updateResult = mysqli_query($conn, $updateQuery);

                if (!$updateResult) {
                    echo "<script>alert('Failed to update stock for product ID: $product_id.')</script>";
                }
            }
        }

        $insert_orders = "INSERT INTO customer_orders (c_id, customer_name, customer_address, customer_phone, amount, invoice_no, total_products,product_ids,product_ids_quantity,order_date, order_status)
            VALUES ('$customer_id', '$name', '$address', '$phone', '$subtotal', '$invoice_no', '$count_products', '$productidsString','$mergedString', NOW(), '$status')";
        $result = mysqli_query($conn, $insert_orders);

        if ($result) {
            $q = "SELECT order_id FROM customer_orders WHERE c_id = $customer_id ORDER BY order_id DESC LIMIT 1";
            $r = mysqli_query($conn, $q);
            $row = mysqli_fetch_assoc($r);
            $order_id = $row['order_id'];

            if ($order_id) {
                echo "<script>window.open('payment.php?order_id=$order_id','_self')</script>";
            } else {
                echo "<script>alert('Failed to retrieve order_id.')</script>";
            }
        } else {
            echo "<script>alert('Failed to submit the order.')</script>";
        }

        $delete = mysqli_query($conn, "DELETE FROM cart WHERE customer_id = '$customer_id'");
    } else {
        echo "<script>alert('No products in the cart.')</script>";
    }
}
?>
