
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Display</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .card {
            margin-top: 100px;
            width: 250px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 16px;
        }

        .card img {
            width: 100%;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .card h4 {
            margin-top: 0;
            margin-bottom: 10px;
        }

        .card p {
            margin: 0;
            margin-bottom: 10px;
        }

        .card span {
            font-weight: bold;
        }
        h1{
            margin-top: 100px;
            padding-top: 50px;
            text-align: center;
        }
        h5{
            padding: 5px 10px;
            background-color: #28a745; /* Green background color */
            color: white; /* Text color */
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <h1>Products</h1>
    <?php
    require('admin_navbar.php');
    require('../connection.php');

    if (isset($_GET['pids'])) {
        $pids_string = $_GET['pids'];  
        $product_ids_array = explode(',', $pids_string);
        $quantities = array();

        foreach ($product_ids_array as $product_id) {
            list($pid, $quantity) = explode(':', $product_id); // Split each pair into product_id and quantity
            $quantities[$pid] = $quantity; // Store product IDs and their quantities in an array
        }

        foreach ($quantities as $product_id => $quantity) {
            $q = "SELECT * FROM product where product_id=$product_id";
            $result = mysqli_query($conn, $q) or die("Query failed: " . mysqli_error($conn));
            
            while ($row = mysqli_fetch_array($result)) {
    ?>
                <div class="card">
                    <img src="../images/<?php echo $row['image1']; ?>" alt="Product Image">
                    <h4><?php echo $row['product_name']; ?></h4>
                    <p><span>Product ID:</span> <?php echo $row['product_id']; ?></p>
                    <p><span>Category ID:</span> <?php echo $row['cat_id']; ?></p>
                    <p><span>Price:</span> <?php echo $row['price']; ?></p>
                    <p><span>In Stock:</span> <?php echo $row['stock']; ?></p>
                    <h5 ><span>Ordered Quantity is:</span> <?php echo $quantity; ?></h5>
                </div>
    <?php
            }
        }
    }
   
    ?>
</body>


</html>
