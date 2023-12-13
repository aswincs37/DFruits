<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require('../connection.php');
include('admin_navbar.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <style>
      

        h1 {
            color: black;
            text-align: center;
            margin-top: 50px;
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
            text-decoration: none;
            color: blue;
        }
    </style>
</head>
<body>
    <h1 >Orders</h1>
    <table border="5" style="color: red;">
        <tr>
            <th>Sl no.</th>
            <th>Order ID</th>
            <th>Customer_id</th>
            <th>Customer Name</th>
            <th>Delivery Address</th>
            <th>Phone Number</th>
            <th>Invoice No</th>
            <th> total_products</th>
            <th>product_id's:quantities</th>
          
            <th>Order Date</th>
            <th>payment Status</th>
        </tr>
        <?php
        error_reporting(E_ALL);
                    
        $get_order_details = mysqli_query($conn, "SELECT * FROM customer_orders");
         
        $num = 1; // Initialize the row number
        while ($row_orders = mysqli_fetch_assoc($get_order_details)) {
            echo "<tr>";
            echo "<td>$num</td>";
            echo "<td>{$row_orders['order_id']}</td>";
            echo "<td>{$row_orders['c_id']}</td>";
            echo "<td>{$row_orders['customer_name']}</td>";
            echo "<td>{$row_orders['customer_address']}</td>";
            echo "<td>{$row_orders['customer_phone']}</td>";
            echo "<td>{$row_orders['invoice_no']}</td>";
            echo "<td>{$row_orders['total_products']}</td>";
            echo "<td>{$row_orders['product_ids_quantity']} <a href='check.php?pids={$row_orders['product_ids_quantity']}'>check</a></td>";

            //echo "<td>{$row_orders['quantity']}</td>";
            echo "<td>{$row_orders['order_date']}</td>";
            $order_id=$row_orders['order_id'];
            // Checking and displaying "Complete" or "Incomplete" based on order status
          
                  echo "<td><a href='payment_status.php?order_id=$order_id'>Done</td>";
             
          
       
            echo "</tr>";
            $num++; // Increment the row number
        }
        ?>
    </table>
</body>
</html>
