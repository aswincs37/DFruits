<?php
include('admin_navbar.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer View</title>
    <style>
       

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body><br><br><br>
    <h1>Customers</h1>
    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require('../connection.php');

    $q = "SELECT * FROM customer";
    $r = mysqli_query($conn, $q);

    // Check if query execution was successful
    if ($r) {
        echo '<table>';
        echo '<tr><th>Customer ID</th><th>Customer Name</th><th>Customer Email</th><th>Customer Phone</th></tr>';
        
        // Fetch data and display it in a table
        while ($row = mysqli_fetch_assoc($r)) {
            echo '<tr>';
            echo '<td>' . $row['c_id'] . '</td>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . $row['email'] . '</td>';
            echo '<td>' . $row['phone'] . '</td>';
            // You can add more columns here if needed
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    ?>
</body>
</html>
