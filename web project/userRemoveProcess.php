<?php
require "connection.php";
session_start();
$email = $_GET["e"]; 

if(isset($_SESSION["admin"])){
    $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='".$email."'");
    $user_num = $user_rs->num_rows;

    if($user_num>0){
        $user_data = $user_rs->fetch_assoc();
        Database::iud("INSERT INTO `removed_users`(`email`,`fname`,`lname`,`joined_date`,`mobile`,`removed_by`)
        VALUES ('".$user_data["email"]."','".$user_data["fname"]."','".$user_data["lname"]."','".$user_data["joined_date"]."','".$user_data["mobile"]."',
        '".$_SESSION["admin"]["admin_email"]."')");

        Database::iud("DELETE FROM `user` WHERE `email`='".$email."'");

        echo("success");
    }else{
        echo("No results found on this email!");
    }

}else{
    echo("Please Sign in first!");
}

// echo $email;
?>