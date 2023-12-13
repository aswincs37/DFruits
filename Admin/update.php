
<!DOCTYPE html>
<html>

<head>
    <title>Update Products</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type="text"],
        input[type="number"],
        input[type="file"],
        textarea {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="submit"],
        input[type="reset"] {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #333;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: #555;
        }

        img {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    require('../connection.php');

    if (!empty($_GET['product_id'])) {
        $pid = $_GET['product_id'];
        $q = "SELECT * FROM product where product_id='$pid'";
        $res = mysqli_query($conn, $q);
        $row = mysqli_fetch_assoc($res);

        if (isset($_POST['update'])) {
            $pname = $_POST['pname'];
            $desc = $_POST['desc'];
            $key = $_POST['keywords'];
            $price = $_POST['price'];

            $q = "UPDATE product SET product_name='$pname', description='$desc',
            keywords='$key', price='$price' WHERE product_id='$pid'";
            $r = mysqli_query($conn, $q) or die("Can't execute the query...");

            header("location: display_products.php");
        }
    ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <h2>UPDATE PRODUCT DETAILS</h2>

            Product NAME:<br>
            <input type="text" name="pname" required="TRUE" onkeyup="this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1);"
                value="<?php echo $row['product_name']; ?>"><br>

            Product Description:<br>
            <textarea name="desc" required="TRUE" onkeyup="this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1);"
                value="<?php echo $row['description']; ?>"><?php echo $row['description']; ?></textarea>

            Product Keywords:<br>
            <input type="text" name="keywords" required="TRUE" value="<?php echo $row['keywords']; ?>"><br>

            Product price:<br>
            <input type="number" name="price" required="TRUE" value="<?php echo $row['price']; ?>"><br>

            <input type="submit" class="btn" name="update" value="SAVE">
            <input type="reset" class="btn" name="reset" value="CANCEL">
            
        </form>
    <?php
    }
    ?>
    <button><a href="update_image.php?pid=<?php echo $pid?>" class="btn">Update Image </a></button>
</body>

</html>
