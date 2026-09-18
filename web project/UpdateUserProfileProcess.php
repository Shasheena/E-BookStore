<?php 
require "connection.php";
session_start();

$email = $_POST["e"];
$line1 = $_POST["l1"];
$line2 = $_POST["l2"];
$pcode = $_POST["pc"];
$mobile = $_POST["mb"];
$city = $_POST["ci"];

if(isset($_SESSION["user"])){
    $address_rs = Database::search("SELECT * FROM `address` WHERE `user_email` = '".$email."'");
    $address_data = $address_rs->fetch_assoc();

    if($address_data["line1"] != $line1){
        if(strlen($line1)>50){
            echo("Address 1 is too long");
        }else{
            Database::iud("UPDATE `address` SET `line1` = '".$line1."' WHERE `user_email` = '".$email."'");
            echo("success");
        }
    }else if($address_data["line2"] != $line2){
        if(strlen($line2)>60){
            echo("Address 1 is too long");
        }else{
            Database::iud("UPDATE `address` SET `line2` = '".$line2."' WHERE `user_email` = '".$email."'");
            echo("success"); 
        }
    }else if($address_data["postal_code"] != $pcode){
        if(strlen($pcode)!=5){
            echo("Enter a valid postal code");
        }else if(!preg_match("/[0,1,2,3,4,5,6,7,8,9]/",$pcode)){
            echo("Enter a valid postal code");
        }else{
            Database::iud("UPDATE `address` SET `postal_code` = '".$pcode."' WHERE `user_email` = '".$email."'");
            echo("success"); 
        }

    }else if($_SESSION["user"]["mobile"] != $mobile){
        if(strlen($mobile)!=10){
            echo("Please enter a valid number");
        }else if(!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/",$mobile)){
            echo("Please enter a valid number"); 
        }else{
            Database::iud("UPDATE `user` SET `mobile` = '".$mobile."' WHERE `email` = '".$email."'");
            echo("success");  
        }

    }else if($city!=0){
        Database::iud("UPDATE `address` SET `ci_id` = '".$city."' WHERE `user_email` = '".$email."'");
        echo("success"); 
    } else{
        
        echo("Nothing to update!");
    }
    // echo($city);
}else{
    echo ("Please sign in first!");
}
// echo("success");
?>