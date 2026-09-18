

<?php 

session_start();
require "connection.php";

if(isset($_SESSION["user"])){
    $oid = $_POST["oid"];
    $bid = $_POST["bid"];
    $email = $_POST["e"];
    $amount = $_POST["a"];
    $qty = $_POST["qty"];

    $book_rs = Database::search("SELECT * FROM `books` WHERE `book_id` = '".$bid."'");
    $book_data = $book_rs->fetch_assoc();

    $current_qty = $book_data["qty"];
    $new_qty = $current_qty - $qty;

    Database::iud("UPDATE `books` SET `qty`='".$new_qty."' WHERE `book_id` = '".$bid."'");

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    if($book_data["copy_copy_id"]==1){
        Database::iud("INSERT INTO `invoice`(`order_id`,`date`,`total`,`qty`,`copy_copy_id`,`bk_id`,`user_email`) VALUES
    ('".$oid."','".$date."','".$amount."','".$qty."','1','".$bid."','".$email."')");
    }else{
        Database::iud("INSERT INTO `invoice`(`order_id`,`date`,`total`,`copy_copy_id`,`bk_id`,`user_email`) VALUES
    ('".$oid."','".$date."','".$amount."','2','".$bid."','".$email."')");
    }

    echo("Success");
}else{
    echo("Sign in first!");
}

?>