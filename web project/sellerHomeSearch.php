<?php 
require "connection.php";
session_start();

$sr = $_GET["sr"];

$book = Database::search("SELECT * FROM `books` INNER JOIN `authors` ON `authors`.`id`=`books`.`authors_id` INNER JOIN `publisher`
ON `publisher`.`id`=`books`.`publisher_id` INNER JOIN `copy` ON `copy`.`copy_id`=`books`.`copy_copy_id` 
INNER JOIN `usage` ON `usage`.`id`=`books`.`usage_id` WHERE `seller_email` = '" . $_SESSION["seller"]["email"] . "' AND `title` LIKE '%".$sr."%' OR 
`fname` LIKE '%".$sr."%' OR `lname` LIKE '%".$sr."%' OR `publisher` LIKE '%".$sr."%'");

$book_num = $book->num_rows;

if ($book_num > 0) {
    for ($x = 0; $x < $book_num; $x++) {
        $book_data = $book->fetch_assoc();

        ?>
        <div class="col-12 col-lg-4">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4 border-end">
                        <img src="<?php echo $book_data["image"] ?>" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-12 text-center mt-3">
                                <?php
                                if ($book_data["qty"] == 0) {
                                ?>
                                    <p class="card-text text-danger">Out of stock</p>
                                <?php
                                } else {
                                ?>
                                    <p class="card-text text-success"><?php echo $book_data["qty"] ?> Available</p>
                                <?php
                                }
                                ?>
                                <h2 class="text-danger">Rs.<?php echo $book_data["price"] ?>.00</h2>
                                <?php
                                if ($book_data["discount"] > 0) {
                                ?>
                                    <h5><?php echo $book_data["discount"] ?> % discount</h5>
                                <?php
                                } else {
                                ?>
                                    <h5>0 % discount</h5>
                                <?php
                                }
                                if ($book_data["copy_copy_id"] == 1) {
                                ?>
                                    <p class="card-text text-muted"><small>Shipping fee:&nbsp;&nbsp;Rs. <?php echo $book_data["shipping"] ?> .00</small></p>
                                    <p class="card-text text-muted"><small>Delivery fee(Colombo):&nbsp;&nbsp;Rs. <?php echo $book_data["delivery_fee_colombo"] ?> .00</small></p>
                                    <p class="card-text text-muted"><small>Delivery fee(Other):&nbsp;&nbsp;Rs. <?php echo $book_data["delivery_fee_other"] ?> .00</small></p>
                                <?php
                                }
                                ?>
                                <button class="btn btn-outline-danger" onclick="remove(<?php echo $book_data['book_id'] ?>);">Remove</button>
                                <button class="btn btn-outline-dark" onclick="updateSellerBooks(<?php echo $book_data['book_id'] ?>);">Update</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="card-title"><?php echo $book_data["title"] ?></h5>
                                    <p class="card-text">Author:&nbsp;&nbsp;<mark><?php echo $book_data["fname"] ?>&nbsp;<?php echo $book_data["lname"] ?></mark></p>
                                    <p class="card-text text-muted"><small>Publisher:&nbsp;&nbsp;<?php echo $book_data["publisher"] ?></small></p>
                                    <p class="card-text"><?php echo $book_data["type"] ?> copy</p>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php

    }
}else {
    echo("No matched items");
}

?>