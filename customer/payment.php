<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require('../connection.php');
session_start();

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    $get_data = mysqli_query($conn, "SELECT * FROM customer_orders WHERE order_id='$order_id'");
    $row_fetch = mysqli_fetch_assoc($get_data);
    $invoice_no = $row_fetch['invoice_no'];
    $amount_due = $row_fetch['amount'];
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Choose Payment Option</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>

    <body>
        <div class="container mt-5">
            <h1 class="text-center">Payment Gateway</h1>
            <p class="text-center">Please make your payment below:</p>
            <h2 class="text-center">Choose Payment Option</h2>
            <p class="text-center">Order ID: <?php echo $order_id ?><br>
                Total Amount: <?php echo $amount_due ?></p>

            <form action="" method="post" class="text-center">
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="payment_option" value="credit_card" required>
                    <label class="form-check-label">Credit Card</label>
                </div>

                <div class="form-check">
                    <input type="radio" class="form-check-input" name="payment_option" value="googlepay" required>
                    <label class="form-check-label">Google Pay</label>
                </div>

                <div class="form-check">
                    <input type="radio" class="form-check-input" name="payment_option" value="paytm" required>
                    <label class="form-check-label">Paytm</label>
                </div>

                <div class="form-check">
                    <input type="radio" class="form-check-input" name="payment_option" value="bank_transfer" required>
                    <label class="form-check-label">Bank Transfer</label>
                </div>

                <button type="submit" name="submit" class="btn btn-primary mt-3">Pay Now</button>
                <a href="profile.php" class="btn btn-secondary mt-3">Cancel</a>
            </form>
        </div>

        <!-- Bootstrap JS and jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>

    </html>
<?php
}

if (isset($_POST['submit'])) {
    require('../connection.php');
    $order_id = $order_id;
    $amount_due = $amount_due;
    $invoice_no = $invoice_no;
    $payment_option = $_POST['payment_option'];

    $insert = "INSERT INTO payment(order_id, invoice_no, amount, payment_method, date)
    VALUES('$order_id', '$invoice_no', '$amount_due', '$payment_option', NOW())";
    $r = mysqli_query($conn, $insert);

    if ($r) {
        echo "<script>alert('Payment Success!')</script>";
        echo "<script>window.open('my_orders.php','_self')</script>";
    }
}
?>
