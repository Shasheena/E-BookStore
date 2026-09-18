<?php 
require "connection.php";
session_start();

if(isset($_SESSION["admin"])){

    if(isset($_SESSION["admin"]["images"])){
        Database::iud("UPDATE `admin` SET `images` = 'resources/emptyUser.png' WHERE `admin_email` = '".$_SESSION["admin"]["admin_email"]."'");
        $_SESSION["admin"]["images"] = "resources/emptyUser.png";
        echo("success");

    }else{
        echo("Nothing to remove!");
    }

}else{
    echo("Something went wrong");
}



?>