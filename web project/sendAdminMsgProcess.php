<?php 
require "connection.php";
session_start();

$msg = $_POST["msg"];
$to = $_POST["to"];
$from = $_SESSION["admin"]["admin_email"];

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

if(!empty($to)){
    Database::iud("INSERT INTO `chat`(`content`,`date_time`,`to`,`from`) VALUES
('".$msg."','".$date."','".$to."','".$from."')");

echo("success");

}else{
    echo("Select a person to chat!");
}

?>