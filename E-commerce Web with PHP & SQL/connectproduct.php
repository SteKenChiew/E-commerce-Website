<?php

$server_name = "localhost";
$database_name = "demo";
$username = "root";
$password = "";


try{
    $conn = new PDO("mysql:host=$server_name;dbname=$database_name",$username,$password);


}catch(PDOException $e){
    $html = "Can't Connect to database !". $e->getMessage();

}

$conn->setAttribute(PDO:ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);


?>