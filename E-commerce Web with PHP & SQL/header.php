
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>DoubleWin Foundation</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="index1.css">
        <script src="https://kit.fontawesome.com/2716a25ac5.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
        
    </head>
    <header class="navbar">
        <div class="nav-inner">
            <div class="logo">
                <a href="index.php">DoubleWin</a>
            </div>
            
                
            
            <div class="rightbar">

                <?php
                    if(!empty($_SESSION['name'])){
                        ?>
                        <a href="profilepage.php"><img src="<?php echo $_SESSION["profilepic"]?>" alt=""></a>
                        <?php
                        echo '<a href="profilepage.php">'.$_SESSION['name'].'</a>' ;
                        echo '<a href="session_logout.php">Log Out</a>';
                        if(!empty($_SESSION['cart_item'])){
                            
                            echo '<a href="cart.php"><i class="bi bi-bag-fill"></i></a>';
                        }else{
                            echo '<a href="cart.php"><i class="bi bi-bag"></i></a>';
                        }
                        if(!empty($_SESSION['role'])){
                            echo '<a href="adminpage.php">Admin</a>' ;
                        }
                        
                    }else{
                        echo '<a href="logintest.php">Login</a>';
                        echo '<a href="signuptest.php">SignUp</a>';
                    }
                    
                ?>
                
            </div>
            
        </div>
    </header>
</html>
