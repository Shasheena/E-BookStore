<?php 
require "connection.php";

$id = $_POST["id"];
$price = $_POST["prc"];
$dsc = $_POST["dsc"]; 


Database::iud("UPDATE `books` SET `price`='".$price."',
`discount`='".$dsc."' WHERE `book_id`='".$id."'");

echo("Successfully updated");
?>