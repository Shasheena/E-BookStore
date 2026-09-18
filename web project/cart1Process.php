<?php 
session_start();
require "connection.php";

$bid = $_GET["id"];
$email = $_SESSION["user"]["email"];

if(isset($_SESSION["user"])){

    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `book_id` = '".$bid."' AND `user_email` = '".$email."'");
    $cart_num = $cart_rs->num_rows; 

    if($cart_num>0){
        echo("This was already added to the cart.");
    }else{
        Database::iud("INSERT INTO `cart`(`book_id`,`user_email`,`qty`) VALUES
        ('".$bid."','".$email."','1')");
        Database::iud("DELETE FROM `wishlist` WHERE `user_email` = '".$_SESSION["user"]["email"]."' AND `books_book_id` = '".$bid."'");
    
        echo("success");
    }
   
}else{
    echo("Sign in first!");
}