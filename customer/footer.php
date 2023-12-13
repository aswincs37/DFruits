<!DOCTYPE html>
<html>

<head>
    <style>
        footer {
            text-align: center;
            padding: 20px;
            background-color: gray;
            color: white;
        }

        .footer-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
        }

        .footer-logo {
            flex: 1;
            text-align: left;
            margin-right: 20px;
        }

        .footer-logo img {
            width: 150px; 
            height: auto;
        }

        .footer-links {
            flex: 4;
            text-align: left;
            margin: 10px 0;
        }

        .footer-links a {
            display: inline-block;
            color: white;
            text-decoration: none;
            font-size: 18px;
            margin-right: 20px;
        }

        .footer-links a:last-child {
            margin-right: 0;
        }

        .footer-additional-links {
            flex: 2;
            text-align: left;
            font-size: 14px;
            margin-top: 10px;
        }

        .footer-additional-links ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-additional-links ul li {
            margin-bottom: 5px;
        }

        .footer-additional-links ul li a {
            color: yellow;
            text-decoration: none;
        }

        .footer-additional-links ul li a:hover {
            text-decoration: underline;
        }

        h5 {
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <footer>
        <div class="footer-container">
            <!-- Logo -->
            <div class="footer-logo">
                <a href="index.php">
                    <img src="../images/logo.png" alt="Logo">
                </a>
            </div>

            <!-- Links -->
            <div class="footer-links">
                <a href="contact.php" class="link1">Contact Us</a>
                <a href="products.php" class="link1">Products</a>
                <a href="delivery.php" class="link4">Delivery Policy</a>
                <a href="terms.php" class="link4">Terms & Conditions</a>
                <a href="privacy.php" class="link3">Privacy Policy</a>
                <a href="returns.php">Returns</a>
            </div>
        </div>
       <b><p>&copy; 2023 DFruits. All rights reserved.</p></b>
    </footer>

</body>

</html>
