<!-- Ensure proper structure and security measures -->
<!DOCTYPE html>
<html>
<head>
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
        $q = "SELECT * FROM product WHERE product_id='$pid'";
        $res = mysqli_query($conn, $q);
        $row = mysqli_fetch_assoc($res);

        if (isset($_POST['update'])) {
            // File upload logic for image 1
            $image1 = $_FILES['img1']['name'];
            $temp_name1 = $_FILES['img1']['tmp_name'];
            move_uploaded_file($temp_name1, "./images/" . $image1);

            // File upload logic for image 2
            $image2 = $_FILES['img2']['name'];
            $temp_name2 = $_FILES['img2']['tmp_name'];
            move_uploaded_file($temp_name2, "./images/" . $image2);

            $q = "UPDATE product SET image1='$image1', image2='$image2' WHERE product_id='$pid'";
            $r = mysqli_query($conn, $q);

            if ($r) {
                echo "<p>Images updated successfully.</p>";
                header("location: display_products.php");
                exit; // Prevent further execution after redirect
            } else {
                echo "<p>Error updating images: " . mysqli_error($conn) . "</p>";
            }
        }
    }
    ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <h2>UPDATE IMAGE</h2>

        Product Image 1:<br>
        <img class="img" src="../images/<?php echo $row['image1']; ?>" width="50px"><br>

        NEW IMAGE 1:<br>
        <input type="file" name="img1"><br>

        Product Image 2:<br>
        <img class="img" src="../images/<?php echo $row['image2']; ?>" width="50px"><br>

        NEW IMAGE 2:<br>
        <input type="file" name="img2"><br>

        <input type="submit" class="btn" name="update" value="SAVE">
        <input type="reset" class="btn" name="reset" value="CANCEL">
    </form>
</body>
</html>
