
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require('../connection.php');
if (isset($_POST['add']))
{
    $category = $_POST['cat'];
    $pname = $_POST['pname'];
    $desc = $_POST['desc'];
    $key = $_POST['key'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $percentage=0;
    
    $img1 = $_FILES['image1']['name'];
    $img2 = $_FILES['image2']['name'];
    $temp_img1 = $_FILES['image1']['tmp_name'];
    $temp_img2 = $_FILES['image2']['tmp_name'];


    $q = "INSERT INTO `product` (cat_id, product_name, description, keywords, price,offer_price,percentage,image1, image2, date, stock) 
    VALUES ('$category', '$pname', '$desc', '$key', '$price','$price','$percentage', '$img1', '$img2', NOW(), '$stock')";

    $r = mysqli_query($conn, $q) or die("Can't connect to the query...");

    if ($r) {
        echo '<script>alert("Successfully Added!")</script>';
    } else {
        echo '<script>alert("Adding Failed!")</script>';
    }
}
?>


<?php
require('admin_navbar.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Products</title>
    <style>
       

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 60%;
            margin: 0 auto;
        }

        h1 {
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #333;
        }

        select,
        input[type="text"],
        input[type="number"],
        textarea,
        input[type="file"],
        input[type="submit"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border-radius: 4px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            font-size: 14px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
   
</head>
<body>
    
      <br> <br><br> <form action="" method="POST" enctype="multipart/form-data">
            <h1><i><u>Add Product</u></i></h1>
            <br>
            Category: <br>
            <select name="cat">
                <?php
                require('../connection.php');
                $q = "SELECT * FROM category";
                $res = mysqli_query($conn, $q);
                while ($row = mysqli_fetch_assoc($res)) {
                    $catid = $row["cat_id"];
                    $catname = $row["cat_name"];
                    echo '<option value="' . $catid . '">' . $catname . '</option>';
                }
                ?>
            </select>
            <br><br>
            Product Name:<br>
            <input type="text" name="pname" onkeyup="this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1);">
            <br><br>
            Product Description:<br>
            <textarea id="desc" name="desc" rows="4" cols="50" onkeyup="this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1);"></textarea>
            <br><br>
            Product Keywords:<br>
            <input type="text" name="key">
            <br><br>
            Product Price:<br>
            <input type="text" name="price">
            <br><br>
            Product Stock:<br>
            <input type="number" name="stock">
            <br><br>
            Product Image 1:<br>
            <input type="file" name="image1" id="image1">
            <br><br>
            Product Image 2:<br>
            <input type="file" name="image2" id="image2">
            <br><br>
            <input type="submit" name="add" value="Add Product">
        </form>
        <br>
    
</body>
</html>


