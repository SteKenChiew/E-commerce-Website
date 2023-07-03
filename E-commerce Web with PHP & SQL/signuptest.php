<?php 
	require_once 'SQL_login.php';

    include "header.php";




    $validation = "";

    
    function data_validation($data, $data_pattern, $data_type){
        if (preg_match($data_pattern, $data)) {
            return "";
        } else { 
            return " <script >alert('$data_type unavailable')</script>";
        }   
    }  
	if(isset($_POST['username']) && isset($_POST['pwd'])){

		try
		{
			$pdo = new PDO($attr, $user, $pass, $opts);
		}
		catch (\PDOException $e)
		{
			throw new \PDOException($e->getMessage(), (int)$e->getCode());
		}
	
		$myusername = sanitise($pdo,$_POST['username']);
        $email = sanitise($pdo,$_POST['email']);
		$mypassword = sanitise($pdo,$_POST['pwd']);
		$mypassword = password_hash($mypassword, PASSWORD_DEFAULT);
		
        $validation = data_validation($_POST['username'], "/^[a-zA-Z0-9]+([._]?[a-zA-Z0-9]+)*$/" , "username");
        $validation .= data_validation($_POST['email'],  "/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/" , "email");
        $validation .= data_validation($_POST['pwd'], '/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{6,12}$/', "password- at least one letter, at least one number, and there have to be 6-12 characters");

        
        error_reporting(0);
        if ($_POST['pwd'] == $_POST['repwd']){
            if ($validation == ""){
                $findsamename = "SELECT * FROM $table WHERE login = '$_POST[username]'";
                $resultcheck = $pdo->query($findsamename);

                if ($resultcheck->rowCount() ){
                    echo "<script>alert('Username Registered')</script>";
                }else{
                    $query = "INSERT INTO $table (userid, email, login, pass) 
                    VALUES(NULL, $email, $myusername, '$mypassword')";
                
        
                    $result = $pdo->query($query);
                    if (! $result){
                        die('Error: ' . mysqli_error());
                    }
                    echo "<script>alert('Registered :)')</script>";
                    
            }
            }else{
                echo $validation;
            }
        }else{
            echo "<script>alert('Confirm Password should be same')</script>";
        }
		

		
		
}

	function sanitise($pdo, $str)
	{
		$str = htmlentities($str);
		return $pdo->quote($str); 
	}	
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="signup.css">
</head>
<body>
    <div class="signupwrapper">
        <div class="signupbox">
            <h1>SignUp</h1>
            <div class="inputbox">
                <form action="" method = "post">
                    <h4>Username</h4>
                    <input type="text" name="username" id="" placeholder="Username">
                    <h4>E-mail</h4>
                    <input type="email" name="email" id="" placeholder="E-mail">
                    <h4>Password</h4>
                    <input type="password" name="pwd" id="" placeholder="Password">
                    <h4>Confirm Password</h4>
                    <input type="password" name="repwd" placeholder="Confirm Password">
                    <input type="submit"  id="" value="SignUP">
                </form>
                <span>Aldready have an Account? <a href="logintest.php">Login</a></span>
            </div>

        </div>
    </div>
</body>
</html>

<?php
include ("footer.php");
?>