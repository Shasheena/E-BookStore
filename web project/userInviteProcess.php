<?php 
require "connection.php";
$email = $_GET["e"];

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

$user_rs = Database::search("SELECT * FROM `user` WHERE `email`='".$email."'");
$user_num = $user_rs->num_rows;

if($user_num==0){
    $code = uniqid();
    Database::iud("INSERT INTO `user`(`email`,`joining_uv_code`,`status_id`) VALUES ('".$email."','".$code."','2')");

    $mail = new PHPMailer;
    $mail->IsSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'shasheenanethmini2@gmail.com';
    $mail->Password = 'zsxfzdoxnyvmevpt';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom('shasheenanethmini2@gmail.com','User Invitation');
    $mail->addReplyTo('shasheenanethmini2@gmail.com','User Invitation');
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = 'User Invitation verification code.';
    $bodyContent = '<h1 style="color:red">Your verificaion code is '.$code.'.Use the code when joining.</h1>';
    $mail->Body = $bodyContent;

    if(!$mail->send()){
        echo'Sending failed';
        // echo("success");
    }else{
        echo ("success");
    }
}else{
    echo("This email user is already an user");
}

// echo($email);
?>