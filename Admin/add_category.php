<?php
require('admin_navbar.php');
?>

<!DOCTYPE html>
<html>
<head>
  <style>
form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 60%;
            margin: 0 auto;
        }

        h2 {
            text-align: center;
            color: #333;
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
	<title>Category</title>
</head>
<body>
    
	
	<div class="cat">
    
	<br><br><br><form action="" method="POST">
  <h2><u>Add Category</u></h2>
     
     Category Name:<br>
    <input type="text" name="Catname" required="true" onkeyup="this.value=this.value.toUpperCase()">
    <br><br>
    image:
    
    <input type="file" name="Catimage" required="true" >
    <br>
    <br>
    <input type="submit" name="add" value="Add Category">
</form>
</div> 
  <br>
    

<?php
require('../connection.php');
if(isset($_POST['add']))
                 {
                  $cn=$_POST['Catname'];
                  $ci=$_POST['Catimage'];
                  $q="insert into category(cat_name,cat_image)values('$cn','$ci')";
                  if (mysqli_query($conn,$q)==true) 
                  {
                    echo '<script>alert("Successfully Added!")</script>';
                  }
                  else
                  {
                    echo '<script>alert("Failed Added!")</script>';
                  }

              }
            
?>
</body>
</html>