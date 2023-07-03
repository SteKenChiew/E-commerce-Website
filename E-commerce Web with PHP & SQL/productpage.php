<?php
require_once("dbcontroller.php");
session_start();
include("header.php");
require("session_time_logout.php");

$db_handle = new DBController();
$product_array = $db_handle->runQuery("SELECT * FROM tblproduct WHERE id = ".$_GET["product"]."");




if (!empty($product_array)) { 
    foreach($product_array as $key=>$value){




?>
    
        

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="productpage1.css">
        
<script src="https://code.jquery.com/jquery-3.5.1.min.js" type="text/javascript"></script>
<script>

function cartAction(action,product_code) {
	var queryString = "";
	if(action != "") {
		switch(action) {
			case "add":
				queryString = 'action='+action+'&code='+ product_code+'&quantity='+1;
			break;
			case "remove":
				queryString = 'action='+action+'&code='+ product_code;
			break;
			case "empty":
				queryString = 'action='+action;
			break;
		}	 
	}
	jQuery.ajax({
	url: "ajax_action.php",
	data:queryString,
	type: "POST",
	success:function(data){
		location.reload();
		if(action != "") {
			switch(action) {
				case "add":
					alert("<?php echo $product_array[$key]["name"]; ?> Added");
				break;
				case "remove":
					$("#add_"+product_code).show();
					$("#added_"+product_code).hide();
				break;
				case "empty":
					$(".btnAddAction").show();
					$(".btnAdded").hide();
				break;
			}	 
		}
	},
	error:function (){}
	});
}
</script>   

   


</script>
        <script src="https://kit.fontawesome.com/2716a25ac5.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <section class="productpage">
            <form >
            <div class="productcard">
                
                <div class="productimg">
                    <img src="<?php echo $product_array[$key]["image"]; ?>" alt="">
                    <div></div>
                </div>
                <div class="productdesc">
                    <?php
                    if (!empty($_SESSION['role'])){?>
                    <div class="edit">
                        <a href="edit_product.php?product=<?php echo $product_array[$key]["id"];?>" class="edit-btn">Edit</a></div><?php
                    
                    
                    }
                    ?>
                    <h1><?php echo $product_array[$key]["name"]; ?></h1>
                    
                    <h3>Description:</h3>
                    <p><?php echo $product_array[$key]["desc"]; ?></p>
                    <div class="productprice">
                        <h4><?php echo "$".$product_array[$key]["price"]; ?></h4>
                        
                        <div class="buybutton">
                        
                            <button type="button" id="add_<?php echo $product_array[$key]["code"]; ?>" value="Add to cart" class="btnAddAction cart-action" onClick = "cartAction('add','<?php echo $product_array[$key]["code"]; ?>')"  ><i class="fa fa-cart-plus" aria-hidden="true"></i>Add to Cart</button>
                            
                        </div>
                        
                    </div>
                </div>
            
            </div>
            </form>
        </section>

    </body>
    </html>
    
<?php
    }
}
include("footer.php");
?>