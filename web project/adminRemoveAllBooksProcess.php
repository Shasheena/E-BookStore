<?php
require "connection.php";

Database::iud("DELETE FROM `books`");
echo("success");
// echo("remove all");
?>