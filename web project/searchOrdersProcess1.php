<?php
require "connection.php";

$bid = $_GET["bid"];

$invoice_data = Database::search("SELECT * FROM `invoice` INNER JOIN `address` ON 
`address`.`user_email`=`invoice`.`user_email` WHERE `bk_id`='" . $bid . "'");
$book_data = Database::search("SELECT * FROM `books` INNER JOIN `authors` ON 
`authors`.`id`=`books`.`authors_id` INNER JOIN `publisher` ON 
`publisher`.`id`=`books`.`publisher_id` INNER JOIN `copy` ON `copy`.`copy_id`=`books`.`copy_copy_id` WHERE `book_id`='" . $bid . "'");


$invoice_data1 = $invoice_data->fetch_assoc();
$book_data1 = $book_data->fetch_assoc();



?>
<div class="row">
    <div class="col-12 mb-3">
        <h5 class="modal-title text-center fw-bold text-dark"><?php echo $book_data1["title"] ?></h5>
    </div>
    <div class="col-6 mb-3">
        <img src="<?php echo $book_data1["image"] ?>" class="img-thumbnail" alt="...">
    </div>
    <div class="col-6">
        <div class="row">
            <div class="col-12 text-center mb-3">
                <label>QTY : <?php echo $invoice_data1["qty"] ?></label>
            </div>
            <div class="col-12 text-center mb-3">
                <label>Author : <?php echo $book_data1["fname"] ?> <?php echo $book_data1["lname"] ?></label>
            </div>
            <div class="col-12 text-center mb-3">
                <label>Publisher : <?php echo $book_data1["publisher"] ?></label>
            </div>
            <div class="col-12 text-center mb-3">
                <label>Copy : <?php echo $book_data1["type"] ?></label>
            </div>
            <div class="col-12 text-center mb-3">
                <label>Shipping : <?php echo $book_data1["shipping"] ?></label>
            </div>
            <div class="col-12 text-center mb-3">
                <label>Delivery fee (Colombo) / Delivery fee (Other): Rs. <?php echo $book_data1["delivery_fee_colombo"] ?> / Rs. <?php echo $book_data1["delivery_fee_other"] ?></label>
            </div>
            <div class="col-12 text-center mb-3">
                <label>Discount : <?php echo $book_data1["discount"] ?>%</label>
            </div>
            <?php
            if ($book_data1["type"] == "Hard") {
            ?>
                <div class="col-12 text-center mb-3">
                    <label>Delivered Address : <?php echo $invoice_data1["line1"] ?> / <?php echo $invoice_data1["line2"] ?></label>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>