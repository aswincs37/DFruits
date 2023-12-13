<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .invoice {
            width: 80%;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 20px;
            background-color: #f9f9f9;
        }
        .invoice-header {
            text-align: left;
            margin-bottom: 20px;
        }
        .invoice-header  img{
           margin: 0 auto;
            margin-left: 420px;
            margin-top: -250px;
            width: 180px;
            height: 180px;
        }
        .invoice-header h1 {
            margin: 0;
            text-align: center;
        }
        .invoice-header h2 {
            margin: 5px;
            text-align: center;
        }
        .invoice-details {
            margin-bottom: 20px;
        }
        .invoice-details table {
            width: 100%;
            border-collapse: collapse;
        }
        .invoice-details th,
        .invoice-details td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        .invoice-details th {
            background-color: #f2f2f2;
        }
        .invoice-items {
            margin-bottom: 20px;
        }
        .invoice-items table {
            width: 100%;
            border-collapse: collapse;
        }
        .invoice-items th,
        .invoice-items td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        .invoice-items th {
            background-color: #f2f2f2;
        }
        .invoice {
        text-align: center;
        margin-top: 20px;
    }

    .invoice button {
        padding: 10px 20px;
        font-size: 16px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
    }

    .invoice button:hover {
        background-color: #45a049;
    }


    </style>
</head>
<body>
<?php
require('../connection.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Fetch customer details and order information from the database
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    // Rest of your code to fetch data using $order_id in your SQL query

$order_id = $_GET['order_id']; // Replace with the actual order ID
$sql = "SELECT * FROM customer_orders WHERE order_id = $order_id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $customer_name = $row['customer_name'];
    $customer_address = $row['customer_address'];
    $customer_phone = $row['customer_phone'];
    $invoice_no = $row['invoice_no'];
    $total_products = $row['total_products'];
    $order_date = $row['order_date'];
    $amount = $row['amount'];
    ?>

<div class="invoice"><form action="" method="POST">
  <button><input type="submit" name="dow" value="Download/Print Invoice"></button>
    <?php
    if (isset($_POST['dow']))
     {
        echo "<script>
            window.print();
            </script>";
    }
    ?></form>
</div>

    <div class="invoice">
        <!-- Header Section -->
        <div class="invoice-header">
            <h1>Invoice</h1>
            <h2>DFruits</h2>
            <p>Dry Fruits Shop</p>
            <p>Phone:9876543210</p>
            <p>Email:dfruits@gmail.com</p>
            <p>GST No:GST123456789 </p>
            <p>FSSAI No:FSSAI7890</p>
            <img src="../images/logo.png" alt="Logo" >
        </div>
        <div class="invoice-details">
            <table>
                <tr>
                    <th>Invoice Number</th>
                    <td><?php echo $invoice_no; ?></td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td><?php echo $order_date; ?></td>
                </tr>
                <tr>
                    <th>Customer Name</th>
                    <td><?php echo $customer_name; ?></td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td><?php echo $customer_address; ?></td>
                </tr>
                <!-- Add more customer details here -->
            </table>
        </div>
        <div class="invoice-items">
            <h2>Invoice Items</h2>
            <table>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>
                <?php
                $pids_string = $row['product_ids_quantity'];
                $product_ids_array = explode(',', $pids_string);

                foreach ($product_ids_array as $product_id) {
                    list($pid, $quantity) = explode(':', $product_id); // Split each pair into product_id and quantity

                    $sql = "SELECT * FROM product where product_id=$pid";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $price = $row['price'];
                    $pname = $row['product_name'];
                    $total = $price * $quantity;
                    ?>
                    <tr>
                        <td><?php echo $pname; ?></td>
                        <td><?php echo $quantity; ?></td>
                        <td><?php echo $price; ?>/-</td>
                        <td><?php echo $total; ?>/-</td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <div class="invoice-summary">
            <h2>Summary</h2>
            <table>
                <tr>
                    <th>Total Products</th>
                    <td><?php echo $total_products; ?></td>
                </tr>
                <tr>
                    <th>Total Amount</th>
                    <td><?php echo $amount; ?>/-</td>
                </tr>
            </table>
            <tr><h3>Thank You...Shop Again...!</h3></tr>
          
        </div>
    </div>
    <?php
} else {
    echo "No order found.";
}
}
?>

</body>
</html>
