<?php 
require "connection.php";
session_start();

$image = $_FILES["f"];

if(isset($_SESSION["admin"])){
    if(isset($_FILES["f"])){
        $image_extensions = array ("image/jpg", "image/jpeg", "image/png", "image/svg+xml");
        $type = $image["type"];

        if(!in_array($type,$image_extensions)){
            echo("file type not valid");
        }else{
            $new_extension;
    
            if($type == "image/jpg"){
                $new_extension = ".jpg";
            }else if($type =="image/jpeg"){
                $new_extension = ".jpeg";
            }else if($type == "image/png"){
                $new_extension = ".png";
            }else if($type == "image/svg+xml"){
                $new_extension = ".svg";
            }
    
            $file_name = "resources/admin_images/".$_SESSION["admin"]["fname"]."_".uniqid().$new_extension;
            move_uploaded_file($image["tmp_name"],$file_name);
    
            Database::iud("UPDATE `admin` SET `images` = '".$file_name."' WHERE `admin_email` = '".$_SESSION["admin"]["admin_email"]."'");
    
            $_SESSION["admin"]["images"] = $file_name;
    
            echo ("success");
        }

    }else{
        echo("Choose an image!");
    }
}else{
    echo("Something went wrong!");
}
?>