<?php 
require "connection.php";

$c_id = $_POST["c_id"];
$title = $_POST["title"];
$au = $_POST["au"];

$query = "SELECT * FROM `books` INNER JOIN `authors` ON books.authors_id = authors.id";

if($c_id=="no" && !empty($au) && !empty($title)){
        $query .= "WHERE `fname`='".$au."' OR `lname`='".$au."' AND `title`='".$title."'";
    // echo(1);
}else if ($c_id=="no" && empty($au) && !empty($title)){
    $query .= "WHERE `title`='".$title."'";
    // echo(2);
}else if ($c_id=="no" && empty($au) && empty($title)){
    echo("Give a keyword to search!");
}else if ($c_id!="no" && empty($au) && empty($title)){
    $query .= "WHERE `sub_categories_id` = '".$c_id."'";
    // echo(3);
}else if ($c_id!="no" && !empty($au) && empty($title)){
    
        $query .= "WHERE `fname`='".$au."' OR `lname`='".$au."' AND `sub_categories_id` = '".$c_id."'";
   
    // echo(4);
}else if($c_id!="no" && !empty($au) && !empty($title)){
   
        $query .= "WHERE `fname`='".$au."' OR `lname`='".$au."' AND `sub_categories_id` = '".$c_id."' AND 
        `title`='".$title."'";
   
}else if ($c_id=="no" && !empty($au) && empty($title)){
   
        $query .= "WHERE `fname`='".$au."' OR `lname`='".$au."'";
   
}else if($c_id!="no" && empty($au) && !empty($title)){
    $query .= "WHERE `sub_categories_id`='".$c_id."' AND `title`='".$title."'";
    // echo(7);
}
?>

<div class="col-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Book</th>
                            <th scope="col">Title</th>
                            <th scope="col">Copy</th>
                            <th scope="col">Author</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Seller</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                        $book_rs = Database::search($query);
                        $book_num = $book_rs->num_rows;
                        if($book_num!=0){

                            for ($y = 0; $y < $book_num; $y++) {
                                $book_data = $book_rs->fetch_assoc();
                                $copy_rs = Database::search("SELECT * FROM `copy` WHERE `copy_id`='" . $book_data["copy_copy_id"] . "'");
                                $copy_data = $copy_rs->fetch_assoc();
                                $au_rs = Database::search("SELECT * FROM `authors` WHERE `id`='" . $book_data["authors_id"] . "'");
                                $au_data = $au_rs->fetch_assoc();
                                $seller_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $book_data["seller_seller_mail"] . "'");
                                $seller_data = $seller_rs->fetch_assoc();
                                $book_id = $book_data["book_id"];
                            ?>
                                <tr>
                                    <td>
                                        <img src="<?php echo $book_data["image"] ?>" class="img-thumbnail" alt="..." style="height:60px;width:60px;">
                                    </td>
                                    <td><?php echo $book_data["title"] ?></td>
                                    <td><?php echo $copy_data["type"] ?></td>
                                    <td><?php echo $au_data["fname"] ?>&nbsp;&nbsp;<?php echo $au_data["lname"] ?></td>
                                    <td><?php echo $book_data["qty"] ?></td>
                                    <td><?php echo $book_data["price"] ?></td>
                                    <td><?php echo $seller_data["fname"] ?>&nbsp;&nbsp;<?php echo $seller_data["lname"] ?></td>
                                    <th scope="row">
                                        <button class="btn btn-secondary btn-sm" onclick="remove(<?php echo $book_id ?>);">Remove</button>
                                    </th>
                                </tr>
    
                            <?php
                            }
                            ?>
    
                        </tbody>
                    </table>
                </div>
                <div class="col-12 text-end mb-3">
                    <button class="btn btn-danger btn-sm" onclick="adminRemoveAllBooks();">Remove All</button>
                    <a class="btn btn-secondary btn-sm" href="manageProducts.php">Back</a>
                </div>
                <?php
                           
                        }else{
                            echo("No results found");
                        }
                        ?>
                        