<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('customer_navbar.php');
require('../connection.php');
if (!$_SESSION['c_id']) 
{
    echo "<script>alert('Login to your account!')</script>";
    echo "<script>window.open('../login.php','_self')</script>";
    exit();
}
else
{
if (isset($_POST['update_quantity'])) {
   
    $update_id = $_POST['update_id'];
    $update_quantity = $_POST['update_quantity'];

    // Update the quantity in the database
    $update = mysqli_query($conn, "UPDATE cart SET quantity = '$update_quantity' WHERE cart_id = '$update_id'");

    if ($update) {
        // $update_total_price_query = "UPDATE cart SET total_price = quantity * price WHERE cart_id = '$update_id'";
        // $update_total_price = mysqli_query($conn, $update_total_price_query);

        header('location: cart.php');
    } else {
        echo "Error updating quantity.";
    }
}

if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    $remove_query = mysqli_query($conn, "DELETE FROM cart WHERE cart_id = '$remove_id'");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Display</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        #main tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #main a {
            color: blanchedalmond;
            text-decoration: none;
            font-weight: bold;
        }

        #main a:hover {
            color: darkred;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Product Details</h1>
        <table id="main" class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Sl No:</th>
                    <th>Product Name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                 $cid=$_SESSION['c_id'];
                $q = "SELECT * FROM cart where customer_id=$cid";
                $result = mysqli_query($conn, $q) or die("Query failed: " . mysqli_error($conn));
                $grandtotal = 0;

                if (mysqli_num_rows($result) > 0) {
                    $num = 1;

                    while ($row = mysqli_fetch_assoc($result)) {
                        $productId = $row['product_id'];
                        $stockQuery = "SELECT stock FROM product WHERE product_id = $productId";
                        $stockResult = mysqli_query($conn, $stockQuery);
                        $stockRow = mysqli_fetch_assoc($stockResult);
                        $stock = $stockRow['stock'];
                        ?>
                        <tr>
                            <td><?php echo $num ?></td>
                            <td><?php echo $row['product_name']; ?></td>
                            <td><img src="../images/<?php echo $row['image']; ?>" alt="" width="100px" height="100px">
                            </td>
                            <td><?php echo number_format($row['price']); ?></td>
                            <td>
                                <form action="" method="POST">
                                    <input type="hidden" value="<?php echo $row['cart_id']; ?>" name="update_id">
                                    <input type="number" min="1" max="<?php echo $stock ?>"  value="<?php echo $row['quantity']; ?>"
                                        name="update_quantity" class="form-control" >
                                    <input type="submit" value="Update" name="update"
                                        class="btn btn-primary btn-sm mt-2">
                                </form>
                            </td>
                            <td><?php echo $subtotal = number_format($row['price'] * $row['quantity']); ?>/-</td>
                            <td>
                                <a href='cart.php?remove=<?php echo $row['cart_id']; ?>'
                                    onclick="return confirm('Are you sure you want to remove this category?')"
                                    class="btn btn-danger btn-sm">Remove</a>
                            </td>
                        </tr>
                        <?php

                        $grandtotal += $row['price'] * $row['quantity'];
                        $num++;
                    }
                } else {
                    echo "<script>alert('No Products In The Cart!')window.open('products.php','_self')</script>";
                }
                ?>
            </tbody>
        </table>
        <h4 style="color: red;"><?php echo "Grand Total: $grandtotal"; ?>/-</h4>

        <a href="products.php" class="btn btn-primary">Continue Shopping</a> 
        
        <?php
        
            $customer_id = isset($_SESSION['c_id']) ? $_SESSION['c_id'] : null;
       
    $r = mysqli_query($conn, "SELECT * FROM cart WHERE customer_id='" . $customer_id . "'");
    $pr = mysqli_fetch_all($r, MYSQLI_ASSOC);

    // Extracting product IDs from the result
    $productIds = array_column($pr, 'product_id');
?>
    <a href="order_details.php?pid=<?php echo implode(',', $productIds); ?>
    &c_id=<?php echo $customer_id; ?>" class="btn btn-success">Checkout</a>

    <?php 

    }
    
    ?>




  
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
