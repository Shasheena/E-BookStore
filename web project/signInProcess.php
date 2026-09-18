<?php 
require "connection.php";
session_start();

$email = $_GET["e"];
$password = $_GET["p"];
$rememberme = $_GET["rm"];

$user_rs = Database::search("SELECT * FROM `user` WHERE `email` = '".$email."' AND `password` = '".$password."'");
$user_num = $user_rs->num_rows;

if($user_num>0){
    $user_data = $user_rs->fetch_assoc();
    $_SESSION["user"] = $user_data;
    Database::iud("UPDATE `user` SET `status_id` = '1' WHERE `email` = '".$email."' AND `password` = '".$password."'");

    if($rememberme = true){
        setcookie("email",$email,time()+ (60*60*24*7));
        setcookie("password",$password,time()+ (60*60*24*7));
    }else{
        setcookie("email","",-1);
        setcookie("password","",-1);
    }
    echo("success");
}else{
    echo "Invalid user!";
}

// echo($email);echo($password);
// echo "success";
?>