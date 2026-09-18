<?php
require "connection.php";

$fdate = $_GET["fdate"];
$tdate = $_GET["tdate"];

if (empty($fdate) && empty($tdate)) {
    echo ("Select a date !");
} else {
    if (!empty($fdate) && !empty($tdate)) {
        $book_rs = Database::search("SELECT `books`.`image`, `books`.`title`, `invoice`.`qty`, `books`.`price`, `books`.`discount`, `invoice`.`total`, `books`.`seller_email`, `invoice`.`user_email`, `copy`.`type`, `authors`.`fname`, `authors`.`lname`
        FROM `invoice` INNER JOIN `books` ON `invoice`.`bk_id`=`books`.`book_id` INNER JOIN `copy` ON `copy`.`copy_id`=`books`.`copy_copy_id` INNER JOIN `authors` ON `authors`.`id`=`books`.`authors_id`
        WHERE `date` BETWEEN '" . $fdate . "' AND '" . $tdate . "'");
        
    }else if(!empty($fdate) && empty($tdate)){
        $book_rs = Database::search("SELECT `books`.`image`, `books`.`title`, `invoice`.`qty`, `books`.`price`, `books`.`discount`, `invoice`.`total`, `books`.`seller_email`, `invoice`.`user_email`, `copy`.`type`, `authors`.`fname`, `authors`.`lname`
        FROM `invoice` INNER JOIN `books` ON `invoice`.`bk_id`=`books`.`book_id` INNER JOIN `copy` ON `copy`.`copy_id`=`books`.`copy_copy_id` INNER JOIN `authors` ON `authors`.`id`=`books`.`authors_id`
        WHERE `date` >= '" . $fdate . "'");
    }else if(empty($fdate) && !empty($tdate)){
        $book_rs = Database::search("SELECT `books`.`image`, `books`.`title`, `invoice`.`qty`, `books`.`price`, `books`.`discount`, `invoice`.`total`, `books`.`seller_email`, `invoice`.`user_email`, `copy`.`type`, `authors`.`fname`, `authors`.`lname`
        FROM `invoice` INNER JOIN `books` ON `invoice`.`bk_id`=`books`.`book_id` INNER JOIN `copy` ON `copy`.`copy_id`=`books`.`copy_copy_id` INNER JOIN `authors` ON `authors`.`id`=`books`.`authors_id`
        WHERE `date` <= '" . $tdate . "'");
    }

?>
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-lg-5 col-12">
                    <label for="fdate">From</label>
                    <input type="date" id="fdate" class="form-control" />
                </div>
                <div class="col-lg-5 col-12">
                    <label for="tdate">To</label>
                    <input type="date" id="tdate" class="form-control" />
                </div>
                <div class="col-lg-2 mt-3 col-12">
                    <button class="btn btn-success" onclick="searchAdminSold();">Serach</button>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-hover mt-5">
    <thead>
        <tr>
            <th scope="col">Book</th>
            <th scope="col">Title</th>
            <th scope="col">Copy</th>
            <th scope="col">Author</th>
            <th scope="col">Quantity</th>
            <th scope="col">Unit Price</th>
            <th scope="col">Discount</th>
            <th scope="col">Total</th>
            <th scope="col">Seller</th>
            <th scope="col">Buyer</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
        <?php
        $book_num = $book_rs->num_rows;
        for ($y = 0; $y < $book_num; $y++) {
            $book_data = $book_rs->fetch_assoc();
            // $book_id = $book_data["book_id"];
        ?>
            <tr>
                <td>
                    <img src="<?php echo $book_data["image"] ?>" class="img-thumbnail" alt="..." style="height:60px;width:60px;">
                </td>
                <td><?php echo $book_data["title"] ?></td>
                <td><?php echo $book_data["type"] ?></td>
                <td><?php echo $book_data["fname"] ?>&nbsp;&nbsp;<?php echo $book_data["lname"] ?></td>
                <td><?php echo $book_data["qty"] ?></td>
                <td><?php echo $book_data["price"] ?></td>
                <td><?php echo $book_data["discount"] ?> %</td>
                <td><?php echo $book_data["total"] ?></td>
                <td><?php echo $book_data["seller_email"] ?></td>
                <td><?php echo $book_data["user_email"] ?></td>
                <!-- <th scope="row">
                    <button class="btn btn-secondary btn-sm" onclick="removeInvoice(<?php echo $book_id ?>);">Remove</button>
                </th> -->
                <!-- <th scope="row">
                    <button onclick="editProducts(<?php echo $book_data['book_id'] ?>)"><i class="bi bi-pencil-fill"></i></button>
                </th> -->
            </tr>

        <?php
        }
        ?>

    </tbody>
</table>
<?php
}
?>