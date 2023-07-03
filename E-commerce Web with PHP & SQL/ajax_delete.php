<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();

if(!empty($_POST["deleteid"])) {

    $deleteid = $_POST["deleteid"];
    $db_handle->runQuery("DELETE FROM tblproduct WHERE id='$deleteid'");
}

?>