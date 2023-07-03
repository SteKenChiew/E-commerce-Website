<?php 
  require_once 'SQL_login.php';
  
  session_start();
  try
  {
    $pdo = new PDO($attr, $user, $pass, $opts);
  }
  catch (\PDOException $e)
  {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
  }





if(isset($_POST['username']) && isset($_POST['pwd'])){
	
    $un_temp = sanitise($pdo,$_POST['username']);
    $pw_temp = sanitise($pdo,$_POST['pwd']);
    $query   = "SELECT * FROM userdata WHERE login=$un_temp";
    $result  = $pdo->query($query);

    if (!$result->rowCount()) {
    echo "<script type='text/javascript'>alert('User Not Found');</script>";
    }else{
      if($result){
      $row = $result->fetch();
      $un  = $row['login'];
      $pw  = $row['pass'];
      $role = $row['role'];
      $pic = $row['profilepic'];
      if (password_verify( $pw_temp, $pw)){
        $_SESSION['name'] = $un;
        $_SESSION['role']=getUserAccessRoleByID($role);
        if(!empty($pic)){ 
          $_SESSION['profilepic'] = $pic;
        }else{
          $_SESSION['profilepic'] = "profile/user.png";
        }

        header("location:index.php");
     
      }else echo "<script type='text/javascript'>alert('error Password');</script>";
      }
    }

   

  
  }
  

  function sanitise($pdo, $str)
  {
    $str = htmlentities($str);
    return $pdo->quote($str);
  }

  include "header.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="loginwrapper">
        <div class="loginbox">
            <h1>Login</h1>
            <div class="inputbox">
                <form action="" method="post">
                    <h4>Username</h4>
                    <input type="text" name="username" id="" placeholder="Username">
                    <h4>Password</h4>
                    <input type="password" name="pwd" id="" placeholder="Password">
                    <input type="submit" name="" id="" value="Login">
                </form>
                <span>Don't have an Account? <a href="signuptest.php">SignUp</a> Now!</span>
            </div>
      
        </div>
    </div>
    
    
</body>

</html>
<?php
include ("footer.php");
?>
