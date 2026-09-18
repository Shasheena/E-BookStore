<?php 
require "connection.php";
$msg_id = $_GET["id"];

Database::iud("DELETE FROM `chat` WHERE `id`='".$msg_id."'");
echo("success");

?>