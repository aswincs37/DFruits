<?php 
include('admin_navbar.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status</title>
    <style>
       

        h1 {
            color: #333;
            text-align: center;
        }

        form {
            text-align: center;
            margin-top: 20px;
        }

        input[type="submit"] {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            margin: 5px;
        }

        input[type="submit"]:hover {
            background-color: #258cd1;
        }
    </style>
</head>

<body>
<br><br><br>
    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require('../connection.php');

    $order_id = $_GET['order_id'];

    $status_query = "SELECT order_status FROM customer_orders WHERE order_id='$order_id'";
    $status_result = mysqli_query($conn, $status_query);

    if ($status_result) {
        $row = mysqli_fetch_assoc($status_result);
        echo "<h1>Order Status: " . $row['order_status'] . "</h1>";

    } else {
        echo "Failed to retrieve order status.";
    }
    ?>

    <form action="" method="POST">
        <input type="submit" name="packed" value="Packed">
        <input type="submit" name="delivered" value="Delivered">
    </form>

    <?php
    if (isset($_POST['packed']) || isset($_POST['delivered'])) {
        // Assuming you have the order_id available, replace it with the actual variable
        $order_id = $order_id; // Replace with the actual order_id

        if (isset($_POST['packed'])) {
            $update_status_query = "UPDATE customer_orders SET order_status='Packed' WHERE order_id=$order_id";
        } elseif (isset($_POST['delivered'])) {
            $update_status_query = "UPDATE customer_orders SET order_status='Delivered' WHERE order_id=$order_id";
            echo '<script>alert("Order status updated successfully!")</script>';
            echo '<script>window.open("view_orders.php","_self")</script>';
        }

        $update_result = mysqli_query($conn, $update_status_query);

        if ($update_result) {
            echo '<script>alert("Order status updated successfully!")</script>';
        } else {
            echo '<script>alert("Failed to update order status: ' . mysqli_error($conn) . '")</script>';
        }
    }

    mysqli_close($conn);
    ?>
</body>

</html>