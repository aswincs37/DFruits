<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require('../connection.php');
include('admin_navbar.php');

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<style>
       
        h1 {
            color: #333;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        a {
            color: blue;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
</head>
<body><br><br><br>
    <h1 style="color: black;">Payment Details</h1>
    <table border="1" style="color: red;">
        <tr>
            <th>Payment ID</th>
            <th>Order ID</th>
            
            <th>Invoice No</th>
            <th>Amount Paid</th>
            <th>Payment Method</th>
            <th>Order Date</th>
            <th>Confirm</th>
        </tr>
        <?php
        $order_id=$_GET['order_id'];
        $get_payment_details = mysqli_query($conn, "SELECT * FROM payment  where order_id='$order_id'");

        if (!$get_payment_details) 
        {
            die("Query failed: " . mysqli_error($conn));
        }

        $num = 1; // Initialize the row number
        while ($row_orders = mysqli_fetch_assoc($get_payment_details)) {
            echo "<tr>";
            echo "<td>$num</td>";
          
            echo "<td>{$row_orders['order_id']}</td>";
            echo "<td>{$row_orders['invoice_no']}</td>";
            echo "<td>{$row_orders['amount']}</td>";
            echo "<td>{$row_orders['payment_method']}</td>";
            echo "<td>{$row_orders['date']}</td>";
           
            $num++; // Increment the row number
            echo "<td><a href='order_status.php?order_id=$order_id' >Confirm</td>";
            echo "</tr>";
        }
        ?>

    </table>
</body>
</html>
