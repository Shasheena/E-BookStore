<?php 
require "connection.php";
session_start();

if(isset($_SESSION["user"])){
    $book_id = $_GET["id"];
    $wishlist_rs = Database::search("SELECT * FROM `wishlist` WHERE `user_email` = '".$_SESSION["user"]["email"]."' AND `books_book_id` = '".$book_id."'");
    $wishlist_num = $wishlist_rs->num_rows;
    if($wishlist_num==0){
        Database::iud("INSERT INTO `wishlist`(`user_email`,`books_book_id`) VALUES ('".$_SESSION['user']["email"]."','".$book_id."')");
        echo("success");
    }else{
        echo("Already added to the wishlist.");
    }
    // echo($book_id);
}else{
    echo("Sign in first");
}
?>