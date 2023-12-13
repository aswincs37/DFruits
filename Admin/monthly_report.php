<!DOCTYPE html>
<html>
<head>
    <title>Monthly Report</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<center><form action="" method="POST"><br><br><br>
    <h1>Report</h1>
    Enter the start date:<input type="date" name="sdate" required><br><br>
    Enter the end date:<input type="date" name="edate" required><br><br>
    <input type="submit" name="submit" value="submit"><br>
</form></center>

<?php
require('admin_navbar.php');
include '../connection.php';

if (isset($_POST['submit'])) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    $sdate = $_POST['sdate'];
    $edate = $_POST['edate'];

    $query = "SELECT product_ids, amount, order_status
              FROM customer_orders
              WHERE order_status = 'Delivered'
              AND order_date BETWEEN '$sdate' AND '$edate'";

    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Query Failed: " . mysqli_error($con));
    }

    echo "<h1>Sales Report between $sdate and $edate</h1>";
    echo "<table>
            <tr>
                <th>Total Revenue for the Period</th>
                <th>Total Products Sold for the Period</th>
                <th>Product IDs Sold for the Period</th>
                <th>Most Sold Product ID for the Period</th>
            </tr>";

    $q1 = "SELECT SUM(amount) AS total_revenue FROM customer_orders WHERE order_status = 'Delivered' AND order_date BETWEEN '$sdate' AND '$edate'";
    $r1 = mysqli_query($conn, $q1);
    $result1 = mysqli_fetch_assoc($r1);
    $totalRevenue = $result1['total_revenue'];

    $q2 = "SELECT SUM(total_products) AS total_sold_products FROM customer_orders WHERE order_status = 'Delivered' AND order_date BETWEEN '$sdate' AND '$edate'";
    $r2 = mysqli_query($conn, $q2);
    $result2 = mysqli_fetch_assoc($r2);
    $totalProducts = $result2['total_sold_products'];

    $q3 = "SELECT GROUP_CONCAT(DISTINCT product_ids) AS product_ids FROM customer_orders WHERE order_status = 'Delivered' AND order_date BETWEEN '$sdate' AND '$edate'";
    $r3 = mysqli_query($conn, $q3);
    $result3 = mysqli_fetch_assoc($r3);
    $distinctProductIds = $result3['product_ids'];

    $q4 = "SELECT product_ids, COUNT(*) AS total_sales 
           FROM customer_orders 
           WHERE order_status = 'Delivered' AND order_date BETWEEN '$sdate' AND '$edate'
           GROUP BY product_ids 
           ORDER BY total_sales DESC LIMIT 1";
    $r4 = mysqli_query($conn, $q4);
    $result4 = mysqli_fetch_assoc($r4);
    $mostSoldProductId = $result4['product_ids'];
  

    echo "<tr>
    <td>$totalRevenue</td>
    <td>$totalProducts</td>
    <td>$distinctProductIds</td>
    <td><a href='selling_products.php?pids=$mostSoldProductId'>$mostSoldProductId</a></td>
  </tr>";

echo "</table>";

mysqli_close($conn);


    
}
?>


</body>
</html>
