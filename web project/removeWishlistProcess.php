<?php 
require "connection.php";
session_start();

$bid = $_GET["id"];

if(isset($_SESSION["user"])){
    Database::iud("DELETE FROM `wishlist` WHERE `user_email` = '".$_SESSION["user"]["email"]."' AND `books_book_id` = '".$bid."'");
    echo("success");
}else{
    echo("Sign in first");
}
