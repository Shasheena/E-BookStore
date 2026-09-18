<?php 
require "connection.php";

$code = $_GET["code"];
$password = $_GET["pw"];

$verify_rs = Database::search("SELECT * FROM `user` WHERE `verification_code` = '".$code."'");
$verify_num = $verify_rs->num_rows;

if($verify_num==1){
    $pw_rs = Database::search("SELECT * FROM `user` WHERE `password` = '".$password."'");
    $pw_num = $pw_rs->num_rows;
    $verify_data = $verify_rs->fetch_assoc();

    if($pw_num>0){
        echo("This password is already in use");
    } if(strlen($password)<6){
        echo("Password is too short!");
    }else if(strlen($password)>18){
        echo("Your password is too long!");
    }else if($verify_data["password"]==$password){
        echo("You have used this password before!");
    }else{
        Database::iud("UPDATE `user` SET `password` = '".$password."' WHERE `verification_code` = '".$code."'");
        echo("success");
    }
}else{
    echo("verification code failed!");
}

?>