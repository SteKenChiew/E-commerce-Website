<?php

session_start();
require_once("dbcontroller.php");
require_once('SQL_login.php');
require("session_time_logout.php");


$db_handle = new DBController();




include("header.php");
?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" type="text/javascript"></script>
<script>

function deleteAction(action,product_code) {
	var queryString = "";
	if(action != "") {
		switch(action) {
			case "delete":
				queryString = 'deleteid='+product_code;
			break;
		}	 
	}
    
	jQuery.ajax({
	url: "ajax_delete.php",
	data:queryString,
	type: "POST",
    success:function(data){
		location.reload();
	},
	error:function (){}
	});
   
}

</script>   

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DoubleWin Foundation</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="index1.css">
    <script src="https://kit.fontawesome.com/2716a25ac5.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    
</head>

<body>
 
    <div class="wordad">
        <marquee behavior="scroll" direction="left" scrollamount="20"><h1>Donating RM10 To Charity When Registered</h1></marquee>
        
        
    </div>
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" style="margin-top:0px; z-index:-1;">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
        <img src="one.jpg" class="d-block w-100" style="height:600px;" alt="one.jpg">
        </div>
        <div class="carousel-item">
        <img src="two.jpg" class="d-block w-100" style="height:600px;" alt="two.jpg">
        </div>
        <div class="carousel-item">
        <img src="three.jpg" class="d-block w-100" style="height:600px;" alt="three.jpg">
        </div>
    </div>
    
    </div> 


    
   

   <section  class="productpage" >
        <h1 class="productheader">Product</h1><hr>
        <div class="productlist" >

                <?php if(!empty($_SESSION['role'])){?>
                    <div class="product">
                        <div class="addproduct">
                           
                            <a href='addproduct.php'>+</a>

                        </div>
                        
                        
                        
                    </div>
                <?php }?>
                <!-- <div class="product">
                    <img src="addidoshoodie.jpg" alt="">
                    <div class="productdesc">
                        <h5>Steken</h5>
                        <h1>Shirt</h1>
                        <span>Adidos</span>
                        <h4>RM 20</h4>
                    </div>
                    <a href="#"><i class="fa fa-cart-plus" aria-hidden="true"></i></a>
                </div> -->

                
                
                
                   
                    <?php
                    $product_array = $db_handle->runQuery("SELECT * FROM tblproduct ORDER BY id ASC");
                  
                    if (!empty($product_array)) { 
                        foreach($product_array as $key=>$value){
                    ?>
                    <?php
                                if(!empty($_SESSION['name'])){
                                    ?>
                                    <a id="productcard" href='productpage.php?product=<?php echo $product_array[$key]['id']; ?> ' style="text-decoration:none; color:black;">
                                <?php
                                }else{?>
                                    <a href='logintest.php' style="text-decoration:none; color:black;"><?php
                                }
                                ?>
                                    <div class="product"  >
                                                    
                                        <form method="post" >
                                        <img  src="<?php echo $product_array[$key]["image"]; ?>">
                                        <div class="productdesc">
                                        
                                        <h1><?php echo $product_array[$key]["name"]; ?></h1>
                                        <h4><?php echo "$".$product_array[$key]["price"]; ?></h4>
                                        <?php
                                        if(!empty($_SESSION['role'])){?>
                                            <button onClick="deleteAction('delete','<?php echo $product_array[$key]["id"]; ?>'); return false">Delete</button><?php
                                        }?>
                                        
                                    </div>
                                
                            
                                        </form>
                                    </div>

                                    </a>
                    <?php
                        }
                    }
                    ?>
                

    </section>


    


</body>
</html>
<?php

include ("footer.php");

?>