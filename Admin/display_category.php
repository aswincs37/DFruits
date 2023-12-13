<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Display</title>
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
   <br><br><br> <table id="main" border="5">
      <h3>CATEGORY</h3>
        <tr>
            <th>Category ID</th>
            <th>Category Name</th>
            <th>Category Image</th>
            <th>Options</th>
        </tr>

        <?php
         require('admin_navbar.php');
         require('../connection.php');
        $q = "SELECT * FROM category";
        $r = mysqli_query($conn, $q) or die("Query failed: " . mysqli_error($conn));

        while ($row = mysqli_fetch_array($r)) {
            ?>
            <tr>
                <td><?php echo $row['cat_id']; ?></td>
                <td><?php echo $row['cat_name']; ?></td>
                <td><img src="../images/<?php echo $row['cat_image']; ?>" width="120" height="120" ></td>
                <td>
                    <button><a href="update_category.php?cat_id=<?php echo $row['cat_id']; ?>">UPDATE</a></button>
                    <br><br>
                    <button><a href='display_category.php?remove=<?php echo $row['cat_id']; ?>' onclick="return confirm('Are you sure you want to remove this category?')">REMOVE</a></button>
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
    $remove_query = mysqli_query($conn, "DELETE FROM category WHERE cat_id = '$remove_id'");
    header('location:display_category.php');
}
?>
