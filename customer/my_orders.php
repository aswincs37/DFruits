<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        td a {
            color: #007bff;
            text-decoration: none;
        }

        td a:hover {
            text-decoration: underline;
        }

        .btn-continue-shopping {
            display: block;
            width: 150px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require('../connection.php');
    include('customer_navbar.php');

    if (!$_SESSION['c_id']) {
        echo "<script>alert('Login to your account!')</script>";
        echo "<script>window.open('../login.php','_self')</script>";
        exit();
    } else {
        $customer_id = $_SESSION['c_id'];
        $get_customer = mysqli_query($conn, "SELECT * FROM customer WHERE c_id='$customer_id'");

        $row_fetch = mysqli_fetch_assoc($get_customer);
        $customer_id = $row_fetch['c_id'];
    }
    ?>
    <br><br>
    <h1>My Orders</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Sl no.</th>
                <th>Order ID</th>
                <th>Delivery Address</th>
                <th>Phone Number</th>
                <th>Invoice No</th>
                <th>Total Amount</th>
                <th>Total products</th>
                <th>Order Date</th>
                <th>Order Status</th>
                <th>Feedback</th>
                <th>Bill</th>
            </tr>
        </thead>
        <tbody>
            <?php
            error_reporting(E_ALL);

            $get_order_details = mysqli_query($conn, "SELECT * FROM customer_orders WHERE c_id='$customer_id'");

            $num = 1; // Initialize the row number
            while ($row_orders = mysqli_fetch_assoc($get_order_details)) {
                echo "<tr>";
                echo "<td>$num</td>";
                echo "<td>{$row_orders['order_id']}</td>";
                echo "<td>{$row_orders['customer_address']}</td>";
                echo "<td>{$row_orders['customer_phone']}</td>";
                echo "<td>{$row_orders['invoice_no']}</td>";
                echo "<td>{$row_orders['amount']}</td>";
                echo "<td>{$row_orders['total_products']}</td>";
                echo "<td>{$row_orders['order_date']}</td>";
                echo "<td>{$row_orders['order_status']}</td>";

                $order_id = $row_orders['order_id'];
                $feedbackLink = ($row_orders['order_status'] == 'Delivered') ? "<a href='feedback.php?order_id=$order_id'>Write</a>" : "N/A";

                echo "<td>$feedbackLink</td>";
                echo "<td><a href='bill.php?order_id={$row_orders['order_id']}'>Bill</a></td>";

                echo "</tr>";
                $num++; // Increment the row number
            }
            if (!$get_order_details) {
                echo "Login Into your account!";
            }
            ?>
        </tbody>
    </table>
    <a href="products.php" class="btn btn-primary btn-continue-shopping">Continue Shopping</a>
    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
