<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Report</title>
</head>
<body>
    
</body>
</html><?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require('admin_navbar.php');
require('../connection.php'); // Include your database connection

$q1 = "SELECT SUM(amount) AS total_revenue FROM customer_orders WHERE DATE(order_date) = CURDATE()";
$r1 = mysqli_query($conn, $q1);

$q2 = "SELECT SUM(total_products) AS total_sold_products FROM customer_orders WHERE DATE(order_date) = CURDATE()";
$r2 = mysqli_query($conn, $q2);

$q3 = "SELECT GROUP_CONCAT(DISTINCT product_ids) AS product_ids FROM customer_orders WHERE DATE(order_date) = CURDATE()";
$r3 = mysqli_query($conn, $q3);

$distinctProductIds = ''; // Initialize with an empty string

$result3 = mysqli_fetch_assoc($r3);
if ($result3 && isset($result3['product_ids'])) {
    $productIdsString = $result3['product_ids'];
    $productIdsArray = explode(',', $productIdsString);
    $distinctProductIds = implode(',', array_unique($productIdsArray));
}


$q4 = "SELECT product_ids, COUNT(*) AS total_sales 
      FROM customer_orders 
      WHERE DATE(order_date) = CURDATE() 
      GROUP BY product_ids 
      ORDER BY total_sales DESC";
$r4 = mysqli_query($conn, $q4);


echo "
<!DOCTYPE html>
<html>
<head>
    <title>Daily Report</title>
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
<br><br><br><h1>Today's Statement</h1>

<body>
<table>
    <tr>";

if ($r1 && $r2 && $r3 && $r4) {
    $result1 = mysqli_fetch_assoc($r1);
    $totalRevenue = $result1['total_revenue'];

    $result2 = mysqli_fetch_assoc($r2);
    $totalProducts = $result2['total_sold_products'];

    $result3 = mysqli_fetch_assoc($r3);
   

    echo "<th>Total Revenue for Today</th>";
    echo "<th>Total Products Sold for Today</th>";
    echo "<th>Most Sold Product id's Today (IDs)</th>";
    echo "<th>Most Sold Product Today (ID)</th>";
    echo "</tr><tr>";
    
    echo "<td>$totalRevenue</td>";
    echo "<td>$totalProducts</td>";
    echo "<td>$distinctProductIds</td>";
    

    echo "<td>";
    if ($result4 = mysqli_fetch_assoc($r4)) {
        $mostSoldProductId = $result4['product_ids'];
        echo "<a href=selling_products.php?pids=$mostSoldProductId>$mostSoldProductId</a>";
    }
    echo "</td>";
} else {
    echo "<td colspan='4'>Error retrieving data: " . mysqli_error($conn) . "</td>";
}

echo "</tr></table></body></html>";

mysqli_close($conn);
?>
