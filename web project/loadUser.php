<?php
require "connection.php";
session_start();
$user_email = $_GET["user"];

$user = Database::search("SELECT * FROM `user` WHERE `email`='" . $user_email . "'");

$user_data = $user->fetch_assoc();
$_SESSION["chat_user"] = $user_data;

?>
    
    <label><?php echo $_SESSION["chat_user"]["fname"]?>&nbsp;<?php echo $_SESSION["chat_user"]["lname"]?></label><br/>
    <label id="u_email"><?php echo $_SESSION["chat_user"]["email"]?></label>
    


