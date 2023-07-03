<?php
require_once "SQL_login.php";
require_once "dbcontroller1.php";
session_start();
require("session_time_logout.php");
include "header.php";

$db_handle = new DBController();

$finduser = "SELECT * FROM $table ORDER BY userid ASC ";
$finduserid = $db_handle->runQuery($finduser);



?>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" type="text/javascript"></script>
<script>
function adminfunc(action,userid) {
    if(action != "") {
		switch(action) {
			case "promote":
				queryString = 'action='+action+'&userid='+userid;
			break;
            case "demote":
				queryString = 'action='+action+'&userid='+userid;
			break;
			case "delete":
				queryString = 'action='+action+'&userid='+userid;
			break;
			
		}	 
	}
    jQuery.ajax({
	url: "ajax_adminpage.php",
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
    <title>Document</title>
    <link rel="stylesheet" href="adminpage.css">
</head>
<body>
    <div class="table">
        <h5>Admin Dashboard</h5>
        <table id="table">
            <tr>
                <th style="text-align:left;" colspan="2">Admin = 1 <br> User = 0</th>
             
                
            </tr>
            <tr >
                <th>Id</th>
                <th>Name</th>
                <th>Role</th>
                <th>E-mail</th>
                <th>Promote</th>
                <th>Demote</th>
                <th>Delete</th>
            </tr>
            <tr>
                <th colspan="7"  style="border-bottom: 1px solid black;"></th>
            </tr>
        <?php
        $idcount = 1;
        if (!empty($finduserid)) { 
            foreach($finduserid as $key=>$value){?>
            <tr>
                <td style="text-align:center;"><?php echo $idcount;?></td>
                <td><?php echo $finduserid[$key]['login'];?></td>
                <td style="text-align:center;"><?php echo $finduserid[$key]['role'];?></td>
                <td><?php echo $finduserid[$key]['email'];?></td>
                <td style="width:100px; text-align:center;"><button class="promote-btn" onClick="adminfunc('promote','<?php echo $finduserid[$key]['userid'];?>')">Promote</button></td>
                <td style="width:100px; text-align:center;"><button onClick="adminfunc('demote','<?php echo $finduserid[$key]['userid'];?>')">Demote</button></td>
                <td style="width:100px; text-align:center;"><button onClick="adminfunc('delete','<?php echo $finduserid[$key]['userid'];?>')">Delete</button></td>
                
                
            </tr>
        <?php
        $idcount += 1;
        }
    }
        ?>
        </form>
        </table>
    </div>
    
</body>
</html>
<?php

include "footer.php";

?>
