<?php 
require "connection.php";
$sc = $_GET["sc"];

$category = Database::search("SELECT `main_categories`.`id`, `main_categories`.`name` FROM `sub_categories` INNER JOIN `main_categories` ON
`main_categories`.`id`=`sub_categories`.`main_categories_id` WHERE `sub_categories`.`id` = '".$sc."'");

$category_data = $category->fetch_assoc();

// echo ($sc);
?>
<option value="<?php echo $category_data["id"] ?>"><?php echo $category_data["name"] ?></option>