<center>
    <br><br><br>
    <h1>ADD OFFER</h1>
<?php
require('admin_navbar.php');
if(isset($_GET['product_id']))
{
require('../connection.php');
$pid=$_GET['product_id'];
 // Fetch product details
 $sql = mysqli_query($conn, "SELECT * FROM product where product_id=$pid");
 if($sql)
 {
    $row = mysqli_fetch_assoc($sql);
 $price = $row['price'];
 $offer_price=$row['offer_price'];
echo "Orginal Price: $price";
echo "<br>";
echo "Current Offer Price:$offer_price";
 }
if(isset($_POST['submit'])) 
{
    $perc = $_POST['percentage'];
    
   
    // Calculate offer based on percentage
    $percentage = $price * $perc / 100;
    $offer = $price - $percentage;

    // Process the offer (e.g., update database with the offer price)
     mysqli_query($conn, "UPDATE product SET offer_price = '$offer' ,percentage='$perc' WHERE product_id = '$pid'");
    // Don't forget to sanitize and validate user inputs to prevent SQL injection and other security risks
    echo "<br>";
    echo "Offer price: " . $offer; // Just for demonstration; replace with database update or other operations
    echo '<script>alert("Successfully Added!");window.open("add_offer.php","_self")</script>';
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Offer</title>
</head>
<body>
    
   <br> <form action="" method="POST"> <!-- Replace 'process_offer.php' with your processing script -->
        Percentage: <input type="number" name="percentage"><br>
        <input type="submit" name="submit" value="Add Offer">
    </form>
</body>
</html></center>