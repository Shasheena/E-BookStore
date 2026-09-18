<?php

require "connection.php";
session_start();
$email = $_SESSION["admin"]["admin_email"];

$title  = $_POST["title"];
$fname  = $_POST["fname"];
$lname  = $_POST["lname"];
$ct  = $_POST["ct"];
$copy  = $_POST["copy"];
$cg  = $_POST["cg"];
$qty  = $_POST["qty"];
$price  = $_POST["price"];
$shipping  = $_POST["shipping"];
$dfc  = $_POST["dfc"];
$dfo  = $_POST["dfo"];
$dsc  = $_POST["dsc"];
$image = $_FILES["image"];
$usage = $_POST["usage"];
$publisher = $_POST["pbl"];
$seller = $_POST["seller"];
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

                $cg_rs = Database::search("SELECT * FROM `sub_categories` WHERE `id`='".$cg."'");
                $cg_data = $cg_rs->fetch_assoc();
                $cg_name = $cg_data["name"];

                
                $new_image_file = "resources/".$cg_name."/".$title.$new_type;
                move_uploaded_file($image["tmp_name"],$new_image_file);

                $author_rs = Database::search("SELECT * FROM `authors` WHERE `fname`='".$fname."' AND `lname`='".$lname."'");
                $author_num = $author_rs->num_rows;
                if($author_num==0){
                    Database::iud("INSERT INTO `authors`(`fname`,`lname`) VALUES ('".$fname."','".$lname."')");
                }

                $publisher_rs = Database::search("SELECT * FROM `publisher` WHERE `publisher`='".$publisher."'");
                $publisher_num = $publisher_rs->num_rows;
                if($publisher_num==0){
                    Database::iud("INSERT INTO `publisher`(`publisher`) VALUES ('".$publisher."')");
                }

                $author_rs1 = Database::search("SELECT * FROM `authors` WHERE `fname`='".$fname."' AND `lname`='".$lname."'");
                $author_data1 = $author_rs1->fetch_assoc();
                $author_id = $author_data1["id"];
            
                $publisher_rs1 = Database::search("SELECT * FROM `publisher` WHERE `publisher`='".$publisher."'");
                $publisher_data1 = $publisher_rs1->fetch_assoc();
                $publisher_id = $publisher_data1["id"];

                $seller_rs = Database::search("SELECT * FROM `seller` WHERE `seller_mail` = '".$seller."'");
                $seller_num = $seller_rs->num_rows;

                if($seller_num==1){
                    Database::iud("INSERT INTO `books`(`title`,`authors_id`,`sub_categories_id`,`image`,`usage_id`,`publisher_id`,`qty`,`discount`,`shipping`,`delivery_fee_colombo`,`delivery_fee_other`,`copy_copy_id`,`cover_id`,`price`,`seller_seller_mail`) VALUES
                    ('".$title."','".$author_id."','".$cg."','".$new_image_file."','".$usage."','".$publisher_id."','".$qty."','".$dsc."','".$shipping."','".$dfc."','".$dfo."','".$copy."','".$ct."','".$price."','".$seller."')");
    
                    echo("success");
                }else{
                    echo("Sign in as a seller first");
                }
 
               
        
    }
   
}else{
    echo("Please Upload an Image preview!");
}



// application/pdf
