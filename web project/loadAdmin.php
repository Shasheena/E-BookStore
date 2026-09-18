<?php
require "connection.php";
session_start();
$admin_email = $_GET["admin"];

$admin = Database::search("SELECT * FROM `admin` WHERE `admin_email`='" . $admin_email . "'");

$admin_data = $admin->fetch_assoc();
$_SESSION["chat_admin"] = $admin_data;

if (!empty($admin_data["images"])) {
?>
    <img src="<?php echo $_SESSION["chat_admin"]["images"] ?>" style="border-radius: 100%;height:100px;width:100px;" />
    <label><?php echo $_SESSION["chat_admin"]["fname"]?>&nbsp;<?php echo $_SESSION["chat_admin"]["lname"]?></label><br/>
    <label id="a_email"><?php echo $_SESSION["chat_admin"]["admin_email"]?></label>

<?php
}else{
    ?>
    <img src="resources/emptyUser.png" style="border-radius: 100%;height:100px;width:100px;" />
    <label><?php echo $_SESSION["chat_admin"]["fname"]?>&nbsp;<?php echo $_SESSION["chat_admin"]["lname"]?></label><br/>
    <label id="a_email"><?php echo $_SESSION["chat_admin"]["admin_email"]?></label>
    <?php
}

?>