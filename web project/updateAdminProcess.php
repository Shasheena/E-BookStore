<?php 
require "connection.php";
session_start();

$mobile = $_GET["mb"];

if(isset($_SESSION["admin"])){
    if(strlen($mobile)!=10){
        echo("Invalid number");
    }else if(!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/",$mobile)){
        echo("Invalid number");
    }else{
        Database::iud("UPDATE `admin` SET `mobile` = '".$mobile."' WHERE `admin_email` = '".$_SESSION["admin"]["admin_email"]."'");
        echo("success");
    }
}else{
    echo("Something went wrong");
}
// echo($mobile);
?>