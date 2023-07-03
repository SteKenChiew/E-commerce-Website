<?php
session_start();
require_once("dbcontroller.php");
include ("header.php");
require("session_time_logout.php");
$db_handle = new DBController();
?>
<HTML>
<HEAD>
<TITLE>DoubleWin Shoping Cart</TITLE>
<link href="style.css" type="text/css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.5.1.min.js" type="text/javascript"></script>
<script>

function cartAction(action,product_code) {
	var queryString = "";
	if(action != "") {
		switch(action) {
			case "add":
				queryString = 'action='+action+'&code='+ product_code+'&quantity='+$("#qty_"+product_code).val();
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
		$("#cart-item").html(data);
		if(action != "") {
			switch(action) {
				case "add":
					$("#add_"+product_code).hide();
					$("#added_"+product_code).show();
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
</HEAD>
<script>
$(document).ready(function () {
	cartAction('','');
})
</script>
<BODY>

<div class="clear-float"></div>

<div id="shopping-cart">

<div id="cart-item"></div>
</div>




</BODY>
</HTML>
<?php

 include("footer.php");

?>