<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type="number"],
        input[type="submit"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }
    </style>
    <form action="" method="POST" enctype="multipart/form-data">
    <?php
    session_start();
    require('../connection.php');

    if (!empty($_GET['product_id'])) {
        $pid = $_GET['product_id'];
        $q = "SELECT stock FROM product where product_id='$pid'";
        $res = mysqli_query($conn, $q);
        $row = mysqli_fetch_assoc($res);
    ?>
    
    <h3>CURRENT STOCK: </h3>
    <h1><?php echo $row['stock']; ?></h1><br>
    ADD STOCK: <br>
    <input type="number" name="stock" value="<?php echo $row['stock']; ?>"><br>
    <input type="submit" name="update" value="Update">
    <?php } ?>
</form>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require('../connection.php');


if (isset($_POST['update'])) {

    $stock = $_POST['stock'];
    $q = "UPDATE product SET  stock='$stock' WHERE product_id='$pid'";
    $r = mysqli_query($conn, $q) or die("Can't execute the query...");
    echo "<script>alert('Stock Updated!.')</script>";    
    echo "<script>window.open('display_products.php','_self')</script>";  
}
