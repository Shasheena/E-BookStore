<?php
require "connection.php";

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
        $book_rs = Database::search("SELECT * FROM `invoice` INNER JOIN `books` ON `invoice`.`bk_id`=`books`.`book_id`");
        $book_num = $book_rs->num_rows;
        $invoice = Database::search("SELECT * FROM `invoice`");
        for ($y = 0; $y < $book_num; $y++) {
            $book_data = $book_rs->fetch_assoc();
            $copy_rs = Database::search("SELECT * FROM `copy` WHERE `copy_id`='" . $book_data["copy_copy_id"] . "'");
            $copy_data = $copy_rs->fetch_assoc();
            $au_rs = Database::search("SELECT * FROM `authors` WHERE `id`='" . $book_data["authors_id"] . "'");
            $au_data = $au_rs->fetch_assoc();
            $seller_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $book_data["seller_email"] . "'");
            $seller_data = $seller_rs->fetch_assoc();
            $book_id = $book_data["book_id"];
            $invoice_data = $invoice->fetch_assoc();
        ?>
            <tr>
                <td>
                    <img src="<?php echo $book_data["image"] ?>" class="img-thumbnail" alt="..." style="height:60px;width:60px;">
                </td>
                <td><?php echo $book_data["title"] ?></td>
                <td><?php echo $copy_data["type"] ?></td>
                <td><?php echo $au_data["fname"] ?>&nbsp;&nbsp;<?php echo $au_data["lname"] ?></td>
                <td><?php echo $invoice_data["qty"] ?></td>
                <td><?php echo $book_data["price"] ?></td>
                <td><?php echo $book_data["discount"] ?> %</td>
                <td><?php echo $invoice_data["total"] ?></td>
                <td><?php echo $seller_data["email"] ?></td>
                <td><?php echo $invoice_data["user_email"] ?></td>
                <th scope="row">
                    <button class="btn btn-secondary btn-sm" onclick="removeInvoice(<?php echo $book_id ?>);">Remove</button>
                </th>
                <!-- <th scope="row">
                    <button onclick="editProducts(<?php echo $book_data['book_id'] ?>)"><i class="bi bi-pencil-fill"></i></button>
                </th> -->
            </tr>

        <?php
        }
        ?>

    </tbody>
</table>