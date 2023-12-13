
<head>
    <style>
        .in-stock {
            padding: 5px 10px;
            background-color: #28a745; /* Green background color */
            color: white; /* Text color */
            border-radius: 4px;
        }
        .rupee {
  font-size: 30px;
  color: #2c3e50;
        }
        .stylish-text {
  text-shadow: 1px 1px 1px #333; 
        }
    </style>
</head>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require('../connection.php');
require('customer_navbar.php');
// Check if the search form was submitted
if (isset($_POST['search_button'])) {
    $search = $_POST['search'];

    // Construct the SQL query to search for projects
    $query = "SELECT * FROM product WHERE keywords LIKE '%$search'";
    $result = mysqli_query($conn, $query);

    // Check if the query returned an empty result set
    if (mysqli_num_rows($result) > 0) {
        ?>
        <div class="container mt-5">
            <br>
            <h1 class="text-center">Search Result</h1>
            <div class="row">
            <?php
            while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="col-md-3 mb-3">
                    <div class="card">
                    <img src="../images/<?php echo htmlspecialchars($row['image1']); ?>" style="height: 200px;" class="card-img-top" alt="Product Image">

                        <div class="card-body">
                        <h2 class="card-title stylish-text"><?php echo htmlspecialchars($row['product_name']); ?></h2>

                           
                            <div class="rupee"><p class="card-text1">&#x20B9;<?php echo htmlspecialchars($row['price']); ?></p></div>

                            <p class="card-text">
                                <?php 
                                    $stock = htmlspecialchars($row['stock'] . " piece Available");
                                    echo "<span class='in-stock'>$stock</span>"; // Apply the 'in-stock' style to the stock information
                                ?>
                            </p>
                            <a href="view_product.php?product_id=<?php echo $row['product_id']; ?>" class="btn btn-primary btn-block">View Product</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>
        </div>
        <?php
    }else {
        echo "<div class='container mt-5 text-center'>
            <h3 class='alert alert-danger error-message'>No matching results found. Please try again.</h3></div>";
    }
    
}
?>
</body>
</html>
<style>
/* Default styling for all devices */
.error-message {
    background-color: #ff9999;
    border: 1px solid #cc0000;
    padding: 10px;
}

/* Apply different styles for smaller screens (e.g., screens with a max width of 768px) */
@media screen and (max-width: 768px) {
    .error-message {
        padding: 5px; /* Adjust padding for smaller screens */
    }
}

/* Apply different styles for larger screens (e.g., screens with a min width of 1200px) */
@media screen and (min-width: 1200px) {
    .error-message {
        font-size: 24px; /* Adjust font size for larger screens */
    }
}
</style>
