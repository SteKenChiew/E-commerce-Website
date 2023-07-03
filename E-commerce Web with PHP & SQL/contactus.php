<?php
session_start();
include "header.php";


$conn = mysqli_connect("localhost", "root", "", "contactus");

function data_validation($data, $data_pattern, $data_type){
    if (preg_match($data_pattern, $data)) {
        return "";
    } else { 
        return " <script >alert('$data_type ')</script>";
    }   
}  

$validation = "";

if(isset($_POST["upload"])){
    $validation = data_validation($_POST['email'],  "/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/" , "Email unvalid");
    $validation .= data_validation($_POST['subject'],"/^[a-zA-Z]{1,25}$/","Subject cannot be empty or more than 25 character");
    $validation .= data_validation($_POST['desc'],"/^[a-zA-Z\s,;.]{1,500}$/","Description should not more than 500 character or empty");
    if($validation == ""){
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $desc = $_POST['desc'];

        $sql = "INSERT INTO contact (`email`,`subject`,`desc`)VALUES ('$email','$subject','$desc')";

        $data = mysqli_query($conn,$sql);


        if($data)
        {
            echo "<script>alert('Thank You For Contacting Us')</script>";
            
        }

        mysqli_close($conn);
    }else{
        echo $validation;
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
    <link rel="stylesheet" href="contactus.css">
</head>
<body>
    <div class="contactuswrapper">
        <div class="contactusbox">
            <h1>Contact Us</h1>
            <form action="" method="post">
                <h5>Email Address</h5>
                <input type="text" name="email" id="" required="">
                <h5>Subject</h5>
                <input type="text" name="subject" id="" required="">
                <h5>Description</h5>
                <textarea  name="desc" style="height:170px" required=""></textarea>
                <div class="submitbox">
                    <input type="submit" name="upload">
                </div>
               
            </form>
        </div>

    </div>
</body>
</html>

<?php
include "footer.php";
?>
