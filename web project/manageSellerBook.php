<?php
require "connection.php";
session_start();

if (isset($_GET["info"])) {
    $modal_info = $_GET["info"];
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <title>sBooks</title>
</head>
<?php if (isset($_SESSION["seller"])) {
?>

    <body>
        <div class="container-fluid vh-100">
            <div class="col-12">
                <div class="row">
                    <h1 class="text-center">Order History</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-2 border-end">
                    <div class="row">
                        <div class="col-12 text-center">
                            <a class="text-decoration-none" href="sellerHome.php">Home</a><br /><br />
                            <a class="text-decoration-none" href="userProfile.php">Profile</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-10 mt-5">
                    <div class="row">
                        <div class="col-5">
                            <label>Order no:</label>
                            <input class=" border-top-0 border-end-0 border-start-0 border-bottom-1 form-control" id="orderId" />
                        </div>
                        <div class="col-5">
                            <label>From:</label>
                            <input class=" border-top-0 border-end-0 border-start-0 border-bottom-1 form-control" type="date" id="dFrom" />
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-2">
                    <div class="row">
                        <div class="col-12 text-center">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-10 mt-5">
                    <div class="row">
                        <div class="col-5">

                        </div>
                        <div class="col-5">
                            <label>To:</label>
                            <input class=" border-top-0 border-end-0 border-start-0 border-bottom-1 form-control" type="date" id="dTo" />
                        </div>
                    </div>
                </div>
                <div class="col-12 text-center mt-3">
                    <button class="btn btn-primary btn-sm" onclick="searchOrders();">Search ></button>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-2"></div>
                        <div class="col-10">
                            <table class="table caption-top">
                                <caption>Orders</caption>
                                <thead class="border-primary">
                                    <tr>
                                        <th scope="col" class="text-primary">Order no:</th>
                                        <th scope="col" class="text-primary">Order date</th>
                                        <th scope="col" class="text-primary">Buyer</th>
                                        <th scope="col" class="text-primary">Total(Rs.)</th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody id="result">
                                    <?php
                                    $order_rs = Database::search("SELECT * FROM `invoice` INNER JOIN `books` ON `books`.`book_id`=`invoice`.`bk_id` INNER JOIN `authors` ON `authors`.`id`=`books`.`authors_id` 
                                    INNER JOIN `copy` ON `copy`.`copy_id`=`books`.`copy_copy_id` INNER JOIN `publisher` ON `publisher`.`id`=`books`.`publisher_id` WHERE `seller_email`='" . $_SESSION["seller"]["email"] . "'");
                                    $order_num = $order_rs->num_rows;
                                    if ($order_num > 0) {
                                        for ($x = 0; $x < $order_num; $x++) {
                                            $order_data = $order_rs->fetch_assoc();
                                    ?>
                                            <tr>
                                                <td scope="row"><?php echo $order_data["order_id"] ?></td>
                                                <td><?php echo $order_data["date"] ?></td>
                                                <td><?php echo $order_data["user_email"] ?></td>
                                                <td><?php echo $order_data["total"] ?></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><button class="btn btn-link" onclick="showModal(<?php echo $order_data['book_id'] ?>);">View details</button></td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?> <tr>
                                            <th scope="row">No orders yet</th>
                                            <td>No orders yet</td>
                                            <td>No orders yet</td>
                                            <td>No orders yet</td>
                                            <td><button class="btn btn-link">View details</button></td>
                                        </tr>
                                    <?php

                                    }

                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>


            <script src="script.js"></script>
            <script src="bootstrap.bundle.js"></script>
    </body>

    <!-- modal -->
    <div class="modal" tabindex="-1" id="mdDetails">
        <div class="modal-dialog modal-dialog-centered  modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="mBody">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>
    <!-- modal -->
<?php
} else {
    echo ("Sign in first!");
} ?>


</html>