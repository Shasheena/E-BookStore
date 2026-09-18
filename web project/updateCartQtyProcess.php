<?php 
require "connection.php";
session_start();

$qty = $_GET["qty"];
$id = $_GET["id"];

if(isset($_SESSION["user"])){
    Database::iud("UPDATE `cart` SET `qty` = '".$qty."' WHERE `user_email` = '".$_SESSION["user"]["email"]."' AND `book_id` = '".$id."'");
    echo("success");
}else{
    echo("Sign in first");
}
// echo($qty);
?>