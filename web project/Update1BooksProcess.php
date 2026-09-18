<?php 
require "connection.php";

$id = $_POST["id"];
$qty = $_POST["qty"];
$price = $_POST["prc"];
$shipping = $_POST["shipng"];
$dfc = $_POST["dfc"];
$dfo = $_POST["dfo"];
$dsc = $_POST["dsc"]; 
$cg = $_POST["cg"];
$title = $_POST["title"];

if(isset($_FILES["img"])){
    $image = $_FILES["img"];
    $img_type_array = array ("image/jpg", "image/jpeg", "image/png", "image/svg+xml");
    if(!in_array($image["type"],$img_type_array)){
        echo("Please select a jpg/jpeg/png/svg type image!");
    }else{
        $new_type;

        if($image["type"] == "image/jpg"){
            $new_type = ".jpg";
        }else if($image["type"]=="image/jpeg"){
            $new_type = ".jpeg";
        }else if($image["type"] == "image/png"){
            $new_type = ".png";
        }else if($image["type"] == "image/svg+xml"){
            $new_type = ".svg";
        }
 
        $new_image_file = "resources/".$cg."/".$title.$new_type;
        move_uploaded_file($image["tmp_name"],$new_image_file);

        Database::iud("UPDATE `books` SET `qty`='".$qty."',`price`='".$price."',`shipping`='".$shipping."',`delivery_fee_colombo`='".$dfc."',
        `delivery_fee_other`='".$dfo."',`image`='".$new_image_file."',`discount`='".$dsc."' WHERE `book_id`='".$id."'");

        echo("Successfully updated");
        // echo($image);
    }
}else{
    Database::iud("UPDATE `books` SET `qty`='".$qty."',`price`='".$price."',`shipping`='".$shipping."',`delivery_fee_colombo`='".$dfc."',
    `delivery_fee_other`='".$dfo."',`discount`='".$dsc."' WHERE `book_id`='".$id."'");
    
    echo("Successfully updated");
}


?>