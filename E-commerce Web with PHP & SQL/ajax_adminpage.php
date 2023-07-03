<?php
session_start();
require_once("dbcontroller1.php");
$db_handle = new DBController();
$action = $_POST["action"];
$userid = $_POST["userid"];

if(!empty($_POST["action"])) {

    

    if($action == "promote"){

        $db_handle->runQuery("UPDATE userdata SET role = 1 WHERE userid = '$userid' ");
    }elseif($action == "delete"){
        $db_handle->runQuery("DELETE FROM userdata WHERE userid = '$userid' ");
    }elseif($action == "demote"){
        $db_handle->runQuery("UPDATE userdata SET role = 0 WHERE userid = '$userid' ");
    }

    
}

?>