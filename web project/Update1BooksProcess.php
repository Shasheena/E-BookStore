<?php 
require "connection.php";

$id = $_POST["id"];
$qty = $_POST["qty"];
$price = $_POST["prc"];
$shipping = $_POST["shipng"];
$dfc = $_POST["dfc"];
$dfo = $_POST["dfo"];
$dsc = $_POST["dsc"]; 


Database::iud("UPDATE `books` SET `qty`='".$qty."',`price`='".$price."',`shipping`='".$shipping."',`delivery_fee_colombo`='".$dfc."',
`delivery_fee_other`='".$dfo."',`discount`='".$dsc."' WHERE `book_id`='".$id."'");

echo("Successfully updated");
?>