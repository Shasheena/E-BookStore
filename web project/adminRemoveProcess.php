<?php
require "connection.php";
session_start();
$email = $_GET["e"];

if(isset($_SESSION["admin"])){
    $admin_rs = Database::search("SELECT * FROM `admin` WHERE `admin_email`='".$email."'");
    $admin_num = $admin_rs->num_rows;

    if($admin_num>0){
        $admin_data = $admin_rs->fetch_assoc();
        Database::iud("INSERT INTO `removed_admins`(`admin_email`,`fname`,`lname`,`password`,`mobile`,`joined_date`,`images`,`removed_by`)
        VALUES ('".$admin_data["admin_email"]."','".$admin_data["fname"]."','".$admin_data["lname"]."','".$admin_data["password"]."','".$admin_data["mobile"]."','".$admin_data["joined_date"]."',
        '".$admin_data["images"]."','".$_SESSION["admin"]["admin_email"]."')");

        Database::iud("DELETE FROM `admin` WHERE `admin_email`='".$email."'");

        echo("success");
    }else{
        echo("No results found on this email!");
    }

}else{
    echo("Please Sign in first!");
}

// echo($email);

?>