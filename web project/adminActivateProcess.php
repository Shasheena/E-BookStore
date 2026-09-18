<?php 
require "connection.php";
$email = $_GET["e"];

$admin_rs = Database::search("SELECT * FROM `admin` WHERE `admin_email`='".$email."'");
$admin_num = $admin_rs->num_rows;

if($admin_num>0){
    $admin_data = $admin_rs->fetch_assoc();
    if($admin_data["status_id"]==2){
        Database::iud("UPDATE `admin` SET `status_id`='1' WHERE `admin_email`='".$email."'");
        echo("success");
    }else{
        echo("This user has been activated");
    }
}else{
    echo("No user found on this email");
}
// echo($email);
?>