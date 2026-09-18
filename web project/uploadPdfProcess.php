<?php 
require "connection.php";

$scopy = $_FILES["scopy"];
$image = $_FILES["image"];
$title = $_POST["title"];
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$cg = $_POST["cg"];
$usage = $_POST["usage"];
$price = $_POST["price"];
$copy = $_POST["copy"];
$publisher = $_POST["pbl"];
$dsc = $_POST["dsc"];

if($scopy["type"] == "application/pdf"){
    if(isset($image)){
        $img_type_array = array ("image/jpg", "image/jpeg", "image/png", "image/svg+xml");
        if(!in_array($image["type"],$img_type_array)){
            echo("Insert a jpg/jpeg/png/svg type file.");
        }else{
            $new_name = "resources/s_copies/".$title.".pdf";
            move_uploaded_file($scopy["tmp_name"],$new_name);
                    
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
        
            $new_image_file = "resources/".$cg_name."/".$title."_".$new_type;
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

            Database::iud("INSERT INTO `books`(`title`,`authors_id`,`sub_categories_id`,`image`,`usage_id`,`publisher_id`,`discount`,`pdf`,`copy_copy_id`,`price`) VALUES
            ('".$title."','".$author_id."','".$cg."','".$new_image_file."','".$usage."','".$publisher_id."','".$dsc."','".$new_name."','".$copy."','".$price."')");
        
            echo("success");
        
        }
    }else{
        echo("Choose a an image");
    }
   
}else{
    echo("Select a pdf file");
}

?>