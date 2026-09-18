<?php 
require "connection.php";

$id = $_POST["id"];
$price = $_POST["prc"];
$dsc = $_POST["dsc"]; 
$image = $_FILES["img"];
$cg = $_POST["cg"];
$title = $_POST["title"];

if(isset($image)){
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

        Database::iud("UPDATE `books` SET `price`='".$price."',`image`='".$new_image_file."',
        `discount`='".$dsc."' WHERE `book_id`='".$id."'");

        echo("Successfully updated");

        
    }
}else{
        Database::iud("UPDATE `books` SET `price`='".$price."',
        `discount`='".$dsc."' WHERE `book_id`='".$id."'");

        echo("Successfully updated");
}

?>