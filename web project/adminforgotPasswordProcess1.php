<?php 
require "connection.php";
$email = $_GET["e"];

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

$user_rs = Database::search("SELECT * FROM `admin` WHERE `admin_email`= '".$email."'");
$user_num = $user_rs->num_rows;


if($user_num>0){
    $code = uniqid();
    Database::iud("UPDATE `admin` SET `verification_code`= '".$code."' WHERE `admin_email`='".$email."'");

    $mail = new PHPMailer;
    $mail->IsSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'worklearnmu@gmail.com';
    $mail->Password = 'lckcajwvmvsrldpk';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom('worklearnmu@gmail.com', 'Reset Password');
    $mail->addReplyTo('worklearnmu@gmail.com', 'Reset Password');
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = 'forgot password verification code.';
    $bodyContent = '<h1 style="color:green">Your verificaion code is '.$code.'</h1>';
    $mail->Body    = $bodyContent;

    if(!$mail->send()){
        // echo'Sending failed';
        echo("success");
    }else{
        echo ("success");
    }
}else{
    echo("Invalid user!");
}
?>