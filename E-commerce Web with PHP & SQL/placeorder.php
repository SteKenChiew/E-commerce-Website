<?php

session_start();

include("header.php");
require("session_time_logout.php");
unset($_SESSION["cart_item"]);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Placed</title>
</head>
<body>

    <h1 width="100%"  style="height: 70vh; margin-top: 100px;padding-top: 100px;display: flex;justify-content: center;">Order Have Been Placed &nbsp;<a href="index.php" style="text-decoration: none;"">  Return To Home Page</a></h1>
</body>
</html>

<?php



include("footer.php");


?>