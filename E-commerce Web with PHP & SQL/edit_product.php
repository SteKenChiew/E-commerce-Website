<?php
session_start();
require_once("dbcontroller.php");
require("session_time_logout.php");
$db_handle = new DBController();

$product_array = $db_handle->runQuery("SELECT * FROM tblproduct WHERE id = ".$_GET["product"]."");

if (!empty($product_array)) { 
    foreach($product_array as $key=>$value){

    }}

include ("header.php");

if(isset($_POST["upload"]))
{
    if (!empty($product_array)) { 
        foreach($product_array as $key=>$value){
            //validation//
           if($product_array[$key]["name"] == $_POST["itemname"] && $product_array[$key]["price"] == $_POST["price"] && $product_array[$key]["desc"] == $_POST["desc"]){
            echo "<script>alert('Same name or price or same desc')</script>";
           } else{
            $db_handle->runQuery("UPDATE tblproduct 
            SET `name` = '$_POST[itemname]', `price` = '$_POST[price]', `desc` = '$_POST[desc]'
            WHERE `ID` = $_GET[product];");
            echo "<script>alert('Editted')</script>";
            header("Refresh:0");
        } 
        }}
  
   
    
    
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="product.css">
</head>
<body>
    <div class="productmerge">
        <div class="formmerge">
            <form class="editform" method="POST" >
                <h1><?php echo $_SESSION['name'];?></h1>
                <h4>Item name</h4>
                <input type="text" name="itemname" id="" value="<?php echo $product_array[$key]["name"]?>">
                <h4>Desc</h4>
                <input type="text" name="desc" id="" value="<?php echo $product_array[$key]["desc"]?>">
                <h4>Price</h4>
                <input type="text" name="price" id="" value="<?php echo $product_array[$key]["price"]?>">
                
                <input type="submit" name="upload"  value="Submit">
            </form>
            

        </div>
        

    </div>
</body>
</html>
<?php




include ("footer.php");

?>