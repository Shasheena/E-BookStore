<?php require "connection.php";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />

    <title>sBOOKS | Invoice</title>
</head>
<?php
if (isset($_GET["oid"])) {
    $oid = $_GET["oid"];
    $book_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id`='" . $oid . "'");
    $book_data = $book_rs->fetch_assoc();

    $book_rs1 = Database::search("SELECT * FROM `books` INNER JOIN `copy` ON 
    `copy`.copy_id = `books`.copy_copy_id INNER JOIN `cover` ON `cover`.id = `books`.cover_id 
    WHERE `book_id`='" . $book_data["bk_id"] . "'");
    $book_data1 = $book_rs1->fetch_assoc();

    $address_rs = Database::search("SELECT * FROM `address` INNER JOIN `city` ON 
    `city`.city_id = `address`.ci_id WHERE `user_email`='" . $book_data["user_email"] . "'");
    $address_data = $address_rs->fetch_assoc();

?>

    <body>
        <div class="container-fluid vh-100 d-flex justify-content-center align-items-center">
            <?php
            if ($book_data["copy_copy_id"] == 1) {
            ?>
                <div class="row">
                    <div class="col-12 mt-3">
                        <div class="card" style="width: 1000px;" id="invoice">
                            <div class="card-body shadow">
                                <div class="row">
                                    <div class="col-4 text-end">
                                        <h1 class="fw-bold text-decoration-underline">Invoice No:</h1><br />
                                        <h6 class="fw-bold text-decoration-underline">Order Id: <?php echo $book_data["order_id"] ?></h6>
                                    </div>
                                    <div class="col-2 text-start mt-3">
                                        <h4>#<?php echo $book_data["id"] ?></h4>
                                    </div>
                                    <div class="col-6 text-end mt-3">
                                        <h3 class="fw-bold text-primary">sBooks</h3><br />
                                        <label>Welmilla Junction</label><br />
                                        <label>Welmilla.</label>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-2 text-end">
                                                <h2 class="fw-bold">To:</h2>
                                            </div>
                                            <div class="col-7 text-start text-decoration-none mt-3">
                                                <label><?php echo $address_data["line1"]; ?>,</label><br />
                                                <label><?php echo $address_data["line2"]; ?>.</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-7 text-end">
                                                <h4 class="fw-bold"><?php echo $book_data["user_email"]; ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-5">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr class="text-primary">
                                                    <th scope="col">Title</th>
                                                    <th scope="col">Type</th>
                                                    <th scope="col">Cover</th>
                                                    <th scope="col">Qty</th>
                                                    <th scope="col">Unit Prize(LKR)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row"><?php echo $book_data1["title"]; ?></th>
                                                    <td><?php echo $book_data1["type"]; ?></td>
                                                    <td><?php echo $book_data1["condition"]; ?></td>
                                                    <td><?php echo $book_data["qty"]; ?></td>
                                                    <td><?php echo $book_data1["price"]; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-9 text-start bg-info bg-opacity-25">
                                                <td>Dilevery fee:</td><br /><br />
                                                <td>Shipping:</td><br /><br />
                                                <td>Discount</td><br /><br />
                                                <td>Total</td>
                                            </div>
                                            <div class="col-3 text-start bg-light">
                                                <?php
                                                if ($address_data["di_id"] == 1) {
                                                ?>
                                                    <td>Rs.<?php echo $book_data1["delivery_fee_colombo"]; ?>.00</td><br /><br />
                                                <?php
                                                } else {
                                                ?>
                                                    <td>Rs.<?php echo $book_data1["delivery_fee_other"]; ?>.00</td><br /><br />

                                                <?php
                                                }
                                                ?>

                                                <td>Rs.<?php echo $book_data1["shipping"]; ?>.00</td><br /><br />
                                                <td><?php echo $book_data1["discount"]; ?>%</td><br /><br />
                                                <label class="fs-6 text-bg-danger text-white"><?php echo $book_data["total"]; ?></label>
                                            </div>
                                        </div>

                                    </div>
                                    <hr />
                                    <div class="text-center">Thank you!</div>
                                    <div class="col-12 text-end mt-5">
                                        <div class="row">
                                            <div class="col-6 text-start">
                                                <label>sBooks</label><br />
                                                <label>All rights reserved&copy;</label>
                                            </div>
                                            <div class="col-6 text-end">
                                                <!-- <a href="window" download="window" class="fs-4"><i class="bi bi-filetype-pdf"></i></a> -->
                                                <button class="btn btn-link fs-4" onclick="printInvoice();"><i class="bi bi-printer-fill"></i></button><br />
                                                <label><i class="bi bi-telephone-fill"></i>&nbsp;0774564566</label><br />
                                                <label>Date:<?php echo $book_data["date"]; ?></label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row"></div>

            <?php
            } else {
            ?>
                <div class="row">
                    <div class="col-12 mt-3">
                        <div class="card" style="width: 1000px;" id="invoice">
                            <div class="card-body shadow">
                                <div class="row">
                                    <div class="col-4 text-end">
                                        <h1 class="fw-bold text-decoration-underline">Invoice No:</h1>
                                        <h6 class="fw-bold text-decoration-underline">Order Id: <?php echo $book_data["order_id"] ?></h6>
                                    </div>
                                    <div class="col-2 text-start mt-3">
                                        <h4>#<?php echo $book_data["id"] ?></h4>
                                    </div>
                                    <div class="col-6 text-end mt-3">
                                        <h3 class="fw-bold text-primary">sBooks</h3><br />
                                        <label>Welmilla Junction,</label><br />
                                        <label>Welmilla.</label>
                                    </div>
                                    <!-- <div class="col-12">
                                        <div class="row">
                                            <div class="col-2 text-end">
                                                <h2 class="fw-bold">To:</h2>
                                            </div>
                                            <div class="col-7 text-start text-decoration-none mt-3">
                                                <label>line1,</label><br />
                                                <label>line2.</label>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-7 text-end">
                                                <h4 class="fw-bold"><?php echo $book_data["user_email"]; ?></h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-5">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr class="text-primary">
                                                    <th scope="col">Title</th>
                                                    <th scope="col">Type</th>
                                                    <th scope="col">Cover</th>
                                                    <th scope="col">Unit Prize(LKR)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row"><?php echo $book_data1["title"]; ?></th>
                                                    <td><?php echo $book_data1["type"]; ?></td>
                                                    <td><?php echo $book_data1["condition"]; ?></td>
                                                    <td><?php echo $book_data1["price"]; ?></td>
                                                </tr>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-9 text-start bg-info bg-opacity-25">
                                                <!-- <td>Dilevery fee:</td><br /><br />
                                                <td>Shipping:</td><br /><br /> -->
                                                <td>Discount</td><br /><br />
                                                <td>Total</td>
                                            </div>
                                            <div class="col-3 text-start bg-light">
                                                <!-- <td>200</td><br /><br />
                                                <td>100</td><br /><br /> -->
                                                <td><?php echo $book_data1["discount"]; ?>%</td><br /><br />
                                                <label class="fs-6 text-bg-danger text-white"><?php echo $book_data["total"]; ?></label>
                                            </div>
                                        </div>

                                    </div>
                                    <hr />
                                    <div class="text-center">Thank you!</div>
                                    <div class="col-12 text-end mt-5">
                                        <div class="row">
                                            <div class="col-6 text-start">
                                                <label>sBooks</label><br />
                                                <label>All rights reserved&copy;</label>
                                            </div>
                                            <div class="col-6 text-end">
                                                <!-- <a href="window" download="window" class="fs-4"><i class="bi bi-filetype-pdf"></i></a> -->
                                                <button class="btn btn-link fs-4" onclick="printInvoice();"><i class="bi bi-printer-fill"></i></button><br />
                                                <label><i class="bi bi-telephone-fill"></i>&nbsp;0774564566</label><br />
                                                <label>Date:<?php echo $book_data["date"]; ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-center mt-3">
                            <a class="btn btn-outline-danger" href="<?php echo $book_data1["pdf"] ?>" download="<?php echo $book_data1["pdf"] ?>">Download pdf</a>
                        </div>
                    </div>
                </div>
                <div class="row"></div>
            <?php
            }
            ?>

        </div>

        <script src="script.js"></script>
        <script src="bootstrap.js"></script>
    </body>

<?php

}
?>


</html>