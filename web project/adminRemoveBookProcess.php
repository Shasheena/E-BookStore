<?php
require "connection.php";

$book_id = $_GET["id"];

Database::iud("DELETE FROM `books` WHERE `book_id`='".$book_id."'");
echo("success");
// echo($_GET["id"]);

?>