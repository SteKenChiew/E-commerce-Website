<?php
session_start();

include ("header.php");
require_once 'SQL_login.php';
require("session_time_logout.php");

  
  $query   = "SELECT * FROM userdata WHERE login = '$_SESSION[name]'";
  $result  = $pdo->query($query);
  
  $row = $result->fetch();
  $un  = $row['login'];
  $add = $row['address'];
  $phoneno = $row['phoneno'];
  $email = $row['email'];
  $role = $row['role'];
  $pic = $row['profilepic'];
 
  if(!empty($pic)){ 
    $_SESSION['profilepic'] = $pic;;
  }


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="profile.css">
  <title>Document</title>
</head>
<body>
  <div class="profile">
    
      <div class="profile-card">
        <form method="POST" enctype="multipart/form-data">
          <h1>Profile Page</h1>
          <div class="profilepicture">
            <img src="<?php if(!empty($pic)){ echo "$pic";}else{echo "profile/user.png";}?>" alt="">
          </div>
          <input type="file" name="image" class="changepic">
          
          <div class="information">
            
              <div class="header">
                <div style="text-align:center; color:red;"><?php
              if(isset($_GET["error"])){
  echo "Phone number and address need to be filled";
  
}?></div>
                <div class="name"><h3>Username</h3><h5><?php echo $un?></h5></div>
                <div class="name">
                  <h3>Email</h3>
                <input type="text" name="email"  value="<?php echo $email?>">
              </div>
              <div class="name">
                <h3>Phone Number</h3>
                <input type="text" name="phoneno" id="phoneno" value="<?php echo $phoneno?>">
              </div>
              <div class="name">
                <h3>Address</h3>
                <input type="text" name="address" id="address" value="<?php echo $add?>">
              </div>
              <div class="submit">
                <input type="submit" name="upload" id="">
              </div>

            
              </div>
            
          </div>
        </form>
      </div>
    
  </div>

</body>
</html>


<?php
$validation = "";
if(isset($_POST["upload"])){


 
  if(!empty($_FILES["image"]["name"])){
    $v1=rand(1111,9999);
    $v2=rand(1111,9999);
  
    $v3=$v1.$v2;
  
    $v3=md5($v3);
    $filename = $_FILES["image"]["name"];
    $dst="./profile/".$v3.$filename;
    $dst1="profile/".$v3.$filename;
    move_uploaded_file($_FILES["image"]["tmp_name"],$dst1);
  }else{
    $dst1 = "$pic";
  }
  
  	$validation = data_validation($_POST['email'],  "/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/" , "email");
    $validation .= data_validation($_POST['phoneno'],"/^\+?6?(?:01[0-46-9]-?(?:\d{7,8}|\d{4} \d{4})|0\d-\d{3} \d{4})$/","phone number");
    

  if( $_POST['email'] == "" xor  $_POST['phoneno'] == "" xor  $_POST['address']==""){
    echo "<script >alert('Email, Phone Number, Address Cannot leave empty');</script>";
  }else{
   
    
      if ($validation == ""){
        $query123   = "UPDATE userdata SET email = '$_POST[email]', phoneno = '$_POST[phoneno]', address = '$_POST[address]', profilepic = '$dst1' WHERE `login` = '$_SESSION[name]'";
        $result12  = $pdo->query($query123);
        echo "<script >alert('Updated');</script>";
        if(!empty($_FILES["image"]["name"])){
          $_SESSION['profilepic'] = $dst1;
        }
        
        header("Location:profilepage.php");
        
        }else{
          echo $validation;
        }
    
    
  }
  

  
}

function data_validation($data, $data_pattern, $data_type){
	if (preg_match($data_pattern, $data)) {
		return "";
	} else { 
		return " <script >alert('$data_type unavailable or cannot be empty')</script>";
	}   
}  

include ("footer.php");
?>