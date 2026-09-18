<?php 
require "connection.php";
$email = $_GET["e"];

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

$user_rs = Database::search("SELECT * FROM `admin` WHERE `admin_email`= '".$email."'");
$user_num = $user_rs->num_rows;

if($user_num==0){
    $code = uniqid();
    Database::iud("INSERT INTO `admin`(`admin_email`,`joining_v_code`,`status_id`) VALUES ('".$email."','".$code."','2')");

    $mail = new PHPMailer;
    $mail->IsSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'shasheenanethmini2@gmail.com';
    $mail->Password = 'zsxfzdoxnyvmevpt';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom('shasheenanethmini2@gmail.com','Admin Invitation');
    $mail->addReplyTo('shasheenanethmini2@gmail.com','Admin Invitation');
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = 'Admin Invitation verification code.';
    $bodyContent = '<h1 style="color:green">Your verificaion code is '.$code.'</h1>';
    $mail->Body = $bodyContent;

    if(!$mail->send()){
        echo'Sending failed';
        // echo("success");
    }else{
        echo ("success");
    }
}else{
    echo("This email user is already an admin");
}

// echo($email);
?>