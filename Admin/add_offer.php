<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>D Fruits</title>
    <style>
        .card {
            height: 100%; /* Set a fixed height for all cards */
        }

        .card:hover {
            box-shadow: 0px 0px 15px 0px rgba(0, 0, 0, 0.3); /* Add box shadow on hover */
            transform: scale(1.05); /* Increase size on hover */
            transition: all 0.3s ease-in-out; /* Add smooth transition */
        }

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
        .price-container {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    border: 1px solid #ccc;
    padding: 10px;
}

.price-details {
    display: flex;
    justify-content: flex-start;
    align-items: baseline;
    margin-bottom: 5px;
}

.original-price {
    font-size: 18px;
    margin-right: 10px;
}

.offer-percentage {
    font-size: 14px;
    color: #388e3c; /* Offer percentage color */
}

.final-offer-price {
    font-size: 24px;
    color: #d32f2f; /* Final offer price color */
}

    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Products</h1>
        <div class="row">
            <?php
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            
            require('../connection.php');
            include('admin_navbar.php');

            $q = "SELECT * FROM product ORDER BY product_id DESC"; // Order by latest inserted
            $r = mysqli_query($conn, $q) or die("Wrong Query!");

            while ($row = mysqli_fetch_assoc($r)) { ?>
                <div class="col-md-3 mb-3">
                    <div class="card">
                    <img src="../images/<?php echo htmlspecialchars($row['image1']); ?>" style="height: 200px;" class="card-img-top" alt="Product Image">

                        <div class="card-body">
                        <h5 class="card-title stylish-text"><?php echo htmlspecialchars($row['product_name']); ?></h5>
                        <div class="price-container">
    <div class="price-detail">
     Orginal Price:<span class="original-price">&#x20B9;<?php echo htmlspecialchars($row['price']); ?></span><br><br>
        Offer Percentage:<span class="offer-percentage"><?php echo htmlspecialchars($row['percentage']); ?>%</span>
    </div>
    Offer Now @:<div class="final-offer-price">&#x20B9;<?php echo htmlspecialchars($row['offer_price']); ?></div>
</div>



                            <p class="card-text">
                                <?php 
                                    $stock = htmlspecialchars($row['stock'] . " KG Available");
                                    echo "<span class='in-stock'>$stock</span>"; // Apply the 'in-stock' style to the stock information
                                ?>
                            </p>
                           
<a href="offer.php?product_id=<?php echo $row['product_id']; ?>" class="btn btn-primary btn-block">Add Offer</a>

                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

