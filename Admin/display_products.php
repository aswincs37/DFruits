<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Display</title>
    <style>
        
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        h1,h3 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        #main tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #main a {
            color: #333;
            text-decoration: none;
            font-weight: bold;
            margin-right: 10px;
        }

        #main a:hover {
            color: red;
        }

        img {
            display: block;
            margin: 0 auto;
        }
    </style>
   
</head>
<body>
    <table id="main" border="5"><br><br><br>
        <h3>PRODUCTS</h3>
        <tr>
            <th>Product ID</th>
            <th>Category ID</th>
            <th>Product Name</th>
            <th>Product Description</th>
            <th>Keywords</th>
            <th>Price</th>
            <th>Date-Time</th>
            <th>In stock</th>
            <th>Image 1</th>
            <th>Image 2</th>
            <th>Options</th>
        </tr>

        <!-- PHP code for fetching data -->
        <?php
        require('admin_navbar.php');
        require('../connection.php');
        $q = "SELECT * FROM product";
        $result = mysqli_query($conn, $q) or die("Query failed: " . mysqli_error($conn));
        while ($row = mysqli_fetch_array($result)) {
            ?>
            <tr>
                <!-- Displaying product information -->
                <td><?php echo $row['product_id']; ?></td>
                <td><?php echo $row['cat_id']; ?></td>
                <td><?php echo $row['product_name']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo $row['keywords']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <td><?php echo $row['date']; ?></td>
                <td><?php echo $row['stock']; ?></td>
                <td><img src="../images/<?php echo $row['image1']; ?>" width="50" height="50"></td>
                <td><img src="../images/<?php echo $row['image2']; ?>" width="50" height="50"></td>
                <td>
                    <!-- Options for each product -->
                    <button><a href="update.php?product_id=<?php echo $row['product_id']; ?>">UPDATE</a></button>
                    <button><a href="stock_update.php?product_id=<?php echo $row['product_id']; ?>">STOCK UPDATE</a></button>
                   <button> <a href='display_products.php?remove=<?php echo $row['product_id']; ?>' onclick="return confirm('Are you sure you want to remove this product?')">REMOVE</a></button>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
</body>
</html>
<?php
if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    $remove_query = mysqli_query($conn, "DELETE FROM product WHERE product_id = '$remove_id'");
}
?>
