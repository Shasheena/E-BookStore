<?php 
require "connection.php";

$email = $_POST["e"];
$fname = $_POST["f"];
$lname = $_POST["l"];
$password = $_POST["pw"];
$mb = $_POST["mb"];
$vc = $_POST["vc"];

if (empty($email)) {
    echo ("Please enter your Email");
} else if (strlen($email) > 50) {
    echo ("Email is too long!");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid Email");
} else if (empty($fname)) {
    echo ("Please enter your first name!");
} else if (strlen($fname) > 45) {
    echo ("First Name must have less than 50 characters!");
} else if (strlen($lname) > 45) {
    echo ("Last Name must have  less than  50 characters!");
} else if (empty($password)) {
    echo ("Please enter your Password");
} else if (strlen($password) > 20) {
    echo ("Password should have less than 20 characters.");
} else if(strlen($password) < 6){
    echo("Password should have more than 6 characters");
}else if(empty($mb)){
    echo ("Enter your mobile");
}else if(strlen($mb)!=10){
    echo ("Enter a valid mobile");
}else if(!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/",$mb)){
    echo ("Enter a valid mobile");
}else if(empty($vc)){
    echo("Enter the Verification code");
}
else {
    $user = Database::search("SELECT * FROM `admin` WHERE `admin_email`='" . $email . "' AND `joining_v_code`='".$vc."'");
    $n = $user->num_rows;

    if ($n==0) {
        echo ("Enter the correct v.code or Enter the email where you have been invited");
    } else {
        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        Database::iud("UPDATE `admin` SET `fname`='".$fname."',`lname`='".$lname."',`password`='".$password."',`mobile`='".$mb."',`joined_date`='".$date."',`status_id`='1'
        WHERE `admin_email`='".$email."' AND `joining_v_code`='".$vc."'");

        echo ("Successfully Added to be an admin..");
    }
}


?>