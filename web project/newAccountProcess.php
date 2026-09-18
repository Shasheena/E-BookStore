<?php

require "connection.php";

$email = $_POST["e"];
$fname = $_POST["f"];
$lname = $_POST["l"];
$password = $_POST["p"];
$line1 = $_POST["l1"];
$line2 = $_POST["l2"];
$pc = $_POST["pc"];
$mb = $_POST["mb"];
$city = $_POST["ci"];
$vc = $_POST["vc"];

if (empty($email)) {
    echo ("Please enter your Email");
} else if (strlen($email) > 50) {
    echo ("Email must have less than 50 characters");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid Email");
} else if (empty($fname)) {
    echo ("Please enter your first name!");
} else if (strlen($fname) > 45) {
    echo ("First Name must have less than 50 characters!");
} else if (empty($lname)) {
    echo ("Please enter your last name!");
} else if (strlen($lname) > 45) {
    echo ("Last Name must have  less than  50 characters!");
} else if (empty($password)) {
    echo ("Please enter your Password");
} else if (strlen($password) > 18) {
    echo ("Password should have less than 18 characters.");
} else if(strlen($password) < 6){
    echo("Password should have more than 6 characters");
}else if(empty($line1)){
    echo("Enter your address");
}else if(empty($line2)){
    echo ("Enter your address");
}else if(strlen($line1)>50){
    echo("Address is too long");
}else if(strlen($line2)>60){
    echo("Address is too long");
}else if(empty($pc)){
    echo("Enter your postal code");
}else if(strlen($pc)!==5 ){
    echo("Enter a valid postal code");
}else if(!preg_match("/[0,1,2,3,4,5,6,7,8,9]/",$pc)){
    echo("Enter a valid postal code");
}else if(empty($mb)){
    echo ("Enter your mobile");
}else if(strlen($mb)!=10){
    echo ("Enter a valid mobile");
}else if(!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/",$mb)){
    echo ("Enter a valid mobile");
}else if(empty($city)){
    echo("Select your city");
}else if(empty($vc)){
    echo("Enter the verification code!");
}
else {
    $user = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "' AND `joining_uv_code`='".$vc."'");
    $n = $user->num_rows;

    if ($n > 0) {
        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        Database::iud("UPDATE `user` SET `fname`='".$fname."',`lname`='".$lname."',`password`='".$password."',`joined_date`='".$date."',`status_id`='1',`mobile`='".$mb."',`seller_states_status_id`='2'
        WHERE `email`='".$email."' AND `joining_uv_code`='".$vc."'");

        Database::iud("INSERT INTO `address`(`line1`,`line2`,`postal_code`,`ci_id`,`user_email`) VALUES
        ('".$line1."','".$line2."','".$pc."','".$city."','".$email."')");

        echo ("success");
        
    } else {
        echo ("Enter the correct verification code or The email address where you get the verification code");
    }
}

?>