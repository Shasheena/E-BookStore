<?php 
require "connection.php";
session_start();

$email = $_GET["e"];
$password = $_GET["pw"];
$rememberme = $_GET["rmb"];

$user_rs = Database::search("SELECT * FROM `admin` WHERE `admin_email` = '".$email."' AND `password` = '".$password."'");
$user_num = $user_rs->num_rows;

if($user_num>0){
    $user_data = $user_rs->fetch_assoc();
    $_SESSION["admin"] = $user_data;
   
    if($rememberme == true){
        setcookie("email",$email,time()+ (60*60*24*365));
        setcookie("password",$password,time()+ (60*60*24*365));
    }else{
        setcookie("email","",-1);
        setcookie("password","",-1);
    }
    echo("success");
}else{
    echo "Invalid user!";
}
?>