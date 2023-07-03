<?php
session_start();
require_once("dbcontroller.php");
require_once 'SQL_login.php';
$db_handle = new DBController();

if(!empty($_POST["action"])) {
switch($_POST["action"]) {
	
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='" . $_POST["code"] . "'");
			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["image"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["code"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
		break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_POST["code"] == $k)
						unset($_SESSION["cart_item"][$k]);
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

$query   = "SELECT * FROM userdata WHERE login='$_SESSION[name]'";
$result  = $pdo->query($query);

if($result){
	$row = $result->fetch();
	$phone = $row['phoneno'];
	$add = $row['address'];
	$ordercheck = false;
	if($phone =="" || $add == ""){
		$ordercheck = false;
	}else{
		$ordercheck = true;
	}
}

?>

<link rel="stylesheet" href="cart.css">
<div id="shopping-cart" style="">

<div id="cart-item">
<table cellpadding="10" cellspacing="1" class="table">
<tbody>
<tr>
	<td colspan="1" style="text-align:center; font-size:20px;">Shopping Cart</td>
	
	<td colspan="2" style="text-align:right;"><a id="btnEmpty" class="cart-action" onClick="cartAction('empty','');">Empty Cart</a></td>
	
</tr>
<tr>
	<td colspan="4"><hr style="width:100%;"></td>
	
</tr>
<tr>
<th style="text-align:left;">Name</th>


<th style="text-align:right;" width="8%">Unit Price</th>
<th style="text-align:center;" width="5%">Remove</th>
</tr>	
<?php
	
	if(isset($_SESSION["cart_item"])){
		$item_total = 0;
	
		foreach ($_SESSION["cart_item"] as $item){
			?>
					<tr>
					<td class="cart-img"><img src="<?php echo $item["image"]?>" width="50px" height="50px" style="border-radius:25px; border:1px solid black;" ><h4><?php echo $item["name"]; ?></h4></td>
					
					
					<td style="text-align:right;"><?php echo "$".$item["price"]; ?></td>
					<td style="text-align:center;"><a onClick="cartAction('remove','<?php echo $item["code"]; ?>')" class="btnRemoveAction cart-action"><img src="icon-delete.png" alt=""></a></td>
					</tr>
					<?php
					
				$item_total += ($item["price"]*$item["quantity"]);
			}
			?>

<tr>
<td colspan="1" align="right">Total:</td>
<td align="right" colspan="1"><strong><?php echo "$ ".$item_total; ?></strong></td>

</tr>
<tr>
<td colspan="4" style="text-align:right;"><a href="<?php 
if($ordercheck == true){
	echo ("placeorder.php");
}
else{
	
	echo("profilepage.php?error=details");
}?>" class="placeorder">Place Order</a></td>
</tr>
  <?php
}else{
	?>
	<tr>
		<td colspan="5" style="text-align:center;" height="500px" ><strong>Empty Cart</strong></td>
	</tr>
	
	<?php
}


?>
</div>
</div>
</tbody>
</table>

