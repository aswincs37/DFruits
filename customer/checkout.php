<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
</head>
<body>
    
</body>
</html>

<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (!isset($_SESSION['c_id'])) 
{
    include('../login.php');  
    exit;
}
else 
{
    $customer_id = $_SESSION['c_id'];
    $r = mysqli_query($conn, "SELECT * FROM cart WHERE customer_id='" . $customer_id . "'");
    $pr = mysqli_fetch_all($r, MYSQLI_ASSOC);

    // Extracting product IDs from the result
    $productIds = array_column($pr, 'product_id');
?>
    <a href="order_details.php?pid=<?php echo implode(',', $productIds); ?>&c_id=<?php echo $customer_id; ?>" class="btn btn-success">Checkout</a>
<?php
}
?>
