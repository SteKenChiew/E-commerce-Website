<?php

session_start();
require_once("dbcontroller.php");

$db_handle = new DBController();

//Get method for adding/remove item to Cart
if(!empty($_POST["action"])) {
switch($_POST["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='" . $_GET["code"] . "'");
			//get the first data only with index [0]
                        $itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 
                                     'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"],
                                      'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["image"]));
			
			if(!empty($_SESSION["cart_item"])) {
                                //checking new add item with currect Cart
				if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
                                                        
							if($productByCode[0]["code"] == $k) {
                                                               //if the quantity  is empty, starting the quantity from Zero
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
                                                                //if the item already in the Cart, add the quantity
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} 
                                //if current item is not in the cart, add the item
                                else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
                                //if the session is empty, start the new session.
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);
                                        // if no more item in cart, empty the session
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
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
    
    <!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="one.jpg" class="d-block w-100" height="500px" alt="one.jpg">
    </div>
    <div class="carousel-item">
      <img src="one.jpg" class="d-block w-100" height="500px" alt="one.jpg">
    </div>
    <div class="carousel-item">
      <img src="one.jpg" class="d-block w-100" height="500px" alt="one.jpg">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<section class="productpage">
        <div class="productlist" >
                <div class="product">
                    <div class="addproduct">
                        <?php

                        if(!empty($_SESSION['name'])){

                            echo "<a href='addproduct.php'>+</a>";
                        }else{
                            echo "<a href='logintest.php'>+</a>";
                        }


                         ?>

                        

                    </div>
                    
                    
                    
                </div>
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
                        <div class="product" >
                                        <!-- mixture of Get and post method. Get method for adding and removing items  -->
                            <form method="post" action="index.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
                            <img  src="<?php echo $product_array[$key]["image"]; ?>">
                            <div class="productdesc">
                                <?php
                                if(!empty($_SESSION['name'])){
                                    ?>
                                    <a href='productpage.php?product=<?php echo $product_array[$key]['id']; ?> '>link to product</a><?php
                                }else{
                                    echo "<a href='logintest.php'>link to product</a>";
                                }
        
                                ?>
                            
                            <h5><?php echo $product_array[$key]["username"]; ?></h5>
                            <h1><?php echo $product_array[$key]["name"]; ?></h1>
                            <span><?php echo $product_array[$key]["code"]; ?></span>
                            <h4><?php echo "$".$product_array[$key]["price"]; ?></h4>
                        </div>
                            
                            
                            </form>
                        </div>

                        
                    <?php
                        }
                    }
                    ?>
                

    </section>
</body>
</html>