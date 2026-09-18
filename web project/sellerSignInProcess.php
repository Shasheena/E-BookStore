<?php 
require "connection.php";
session_start();

$email = $_GET["e"];
$pw = $_GET["pw"];
$rmb = $_GET["rmb"];

$user_rs = Database::search("SELECT * FROM `user` WHERE `email`='".$email."' AND `password`='".$pw."'");
$user_num = $user_rs->num_rows;

if($user_num==1){
    $user_data = $user_rs->fetch_assoc();
    $_SESSION["seller"] = $user_data;
    
    if($user_data["seller_states_status_id"]=='2'){
        Database::iud("UPDATE `user` SET `seller_states_status_id`='1' WHERE `email`='".$email."' AND `password`='".$pw."'");

    }
    if($rmb==true){
        setcookie("email",$email,time()+ (60*60*24*365));
        setcookie("password",$pw,time()+ (60*60*24*365));
    }else{
        setcookie("email","",-1);
        setcookie("password","",-1);
    }
    echo("Success");

}else{
    echo("Invalid user!!");
}

// echo($email);echo($pw);echo($rmb);
?>