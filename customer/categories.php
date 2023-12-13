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
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Categories</h1>
        <div class="row">
            <?php
            require('../connection.php');
            require('customer_navbar.php');

            $q = "SELECT * FROM category ORDER BY cat_id DESC"; // Order by latest inserted
            $r = mysqli_query($conn, $q) or die("Wrong Query!");

            while ($row = mysqli_fetch_assoc($r)) { ?>
                <div class="col-md-3 mb-3">
                    <div class="card">
                    <img src="../images/<?php echo htmlspecialchars($row['cat_image']); ?>" style="height: 200px;" class="card-img-top" alt="Category Image">

                        <div class="card-body">
                        <h2 class="card-title stylish-text"><?php echo htmlspecialchars($row['cat_name']); ?></h2>

                          
                            <a href="product_categories.php?cat_id=<?php echo $row['cat_id']; ?>" class="btn btn-primary btn-block">View Products</a>
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
<footer>
    <?php
    include('footer.php');
    ?>
</footer>
