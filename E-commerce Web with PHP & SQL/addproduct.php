<?php
session_start();
require("session_time_logout.php");
$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"itemtest");



include ("header.php");

function data_validation($data, $data_pattern, $data_type){
    if (preg_match($data_pattern, $data)) {
        return "";
    } else { 
        return " <script >alert('$data_type ')</script>";
    }   
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
            <form   class="addform" method="post" enctype="multipart/form-data">
                <h1><?php echo $_SESSION['name'];?></h1>
                <h4>Item name</h4>
                <input type="text" name="itemname" id="" placeholder="Item name">
                <h4>Image</h4>
                <input type="file" name="image" id="">
                <h4>Description</h4>
                <input type="text" name="desc" id="" placeholder="Description">
                <h4>Price</h4>
                <input type="text" name="price" id="" placeholder="Price">
                <input type="submit" name="upload"  value="Submit">
            </form>
            

        </div>
        

    </div>
</body>
</html>
<?php
$username = $_SESSION['name'];

if(isset($_POST["upload"]))
{
    

    $v1=rand(1111,9999);
    $v2=rand(1111,9999);

    $v3=$v1.$v2;

    $v3=md5($v3);
    $filename = $_FILES["image"]["name"];
    $dst="./product/".$v3.$filename;
    $dst1="product/".$v3.$filename;
    move_uploaded_file($_FILES["image"]["tmp_name"],$dst1);


        $validation = "";
        $validation = data_validation($_POST['itemname'],  "/^[a-zA-Z\s,;.]{1,50}$/" , "item name accept character only and should not more than 50 character or empty");
        $validation .= data_validation($_POST['price'],"/^[0-9]{1,10}$/","Price should not more than 10 number");
        $validation .= data_validation($_POST['desc'],"/^[a-zA-Z\s,;.]{1,255}$/","Description should not more than 255 character or empty and only accepting dot comma semicolon");
    if($validation == ""){
       

        
        mysqli_query ($link ,"INSERT INTO tblproduct values (null,'$username','$_POST[itemname]','$v3','$dst1','$_POST[desc]',$_POST[price])");


       
        echo "<script>alert('Uploaded')</script>";
            
        

        
    }else{
        echo $validation;
    }
    
}


include ("footer.php");

?>