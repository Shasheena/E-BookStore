<?php require "connection.php";
session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />


    <title>sBOOKS | Shopping_Basket</title>
</head>

<body>
    <div class="container-fluid 100vh">
        <div class="row">
            <?php include "header.php"; ?>
        </div>
        <div class="d-block">
            <div class="row">
                <div class="col-12 text-start  mt-3 mt-lg-0">
                    <span class="fs-4" style="font-family: Arial;">Wishlist</span>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-end mt-lg-0 mt-3">
                    <a type="button" class="btn btn-danger text-end" href="signIn.php">Sign in if you are not</a>
                </div>
                <?php
                $wishlist_rs = Database::search("SELECT * FROM `wishlist` WHERE `user_email` = '" . $_SESSION["user"]["email"] . "'");
                $wishlist_num = $wishlist_rs->num_rows;

                if ($wishlist_num == 0) {
                ?>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                <h2 class="text-center text-secondary">No items in your wishlist yet</h2>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <a class="btn btn-outline-danger fs-1" href="browse.php">Start shopping</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                } else {
                ?>

                    <?php
                    $book_rs = Database::search("SELECT * FROM `wishlist` INNER JOIN `books` ON
                    books.book_id = wishlist.books_book_id INNER JOIN `authors` ON authors.id = books.authors_id WHERE `user_email` = '" . $_SESSION["user"]["email"] . "'");
                    $book_num = $book_rs->num_rows;
                    for ($x = 0; $x < $book_num; $x++) {
                        $book_data = $book_rs->fetch_assoc();
                    ?>
                        <!-- large -->
                        <div class="col-12 px-4 px-lg-5 mt-3 d-none d-lg-block mb-4">
                            <div class="card border-1 border-info " style="border-radius: 10px; background-color: #f0f8ff">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-8 text-start">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <label class="form-label">Basket items(<?php echo $book_num ?>)</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4 text-start">
                                                    <label class="form-label">Price(Rs.00)</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-8">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <a class="form-label" style="color: darkblue;" href='<?php echo "singleView.php?id=" . $book_data["book_id"]; ?>'><?php echo $book_data["title"] ?></a>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="row">
                                                                            <div class="col-4">
                                                                                <img src="<?php echo $book_data["image"] ?>" style="width: 200px; height: 200px;" class="img-thumbnail">
                                                                            </div>
                                                                            <div class="col-4 text-start mt-2">
                                                                                <span class="form-label text-info">Author&nbsp;:&nbsp;<?php echo $book_data["fname"] ?>&nbsp;<?php echo $book_data["lname"] ?></span>
                                                                                <div class="row mt-2">
                                                                                    <div class="col-12">
                                                                                        <div class="row">
                                                                                            <div class="col-7">
                                                                                                <a type="button" class="btn btn-sm border" onclick="addToCart1(<?php echo $book_data['book_id']?>);"><i class="bi bi-bookmark-heart"></i>Add to cart</a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-12 mt-2">
                                                                                        <div class="row">
                                                                                            <div class="col-5">
                                                                                                <button class="btn btn-sm border" style="background-color: orange;" onclick="removeWishlist(<?php echo $book_data['book_id'] ?>);">Remove</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="col-4 text-start" id="price">
                                                                <span><?php echo $book_data["unit_prize"] ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="row">
                                                                    <div class="col-8"></div>
                                                                    <div class="col-4 text-start">
                                                                        <span style="font-family: Arial">Shipping:&nbsp;Rs.<?php echo $book_data["shipping"] ?>.00</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 mt-3">
                                                                <?php
                                                                $district_rs = Database::search("SELECT * FROM `address` INNER JOIN `city` ON 
                                                                city.city_id = address.ci_id WHERE `user_email` = '" . $_SESSION["user"]["email"] . "'");
                                                                $district_data = $district_rs->fetch_assoc();
                                                                if ($district_data["di_id"] == 1) {
                                                                ?>
                                                                    <div class="row">
                                                                        <div class="col-8"></div>
                                                                        <div class="col-4 text-start">
                                                                            <span style="font-family: Arial">Delivery fee:&nbsp;Rs.<?php echo $book_data["delivery_fee_colombo"] ?>.00</span>
                                                                        </div>
                                                                    </div>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <div class="row">
                                                                        <div class="col-8"></div>
                                                                        <div class="col-4 text-start">
                                                                            <span style="font-family: Arial">Delivery fee:&nbsp;Rs.<?php echo $book_data["delivery_fee_other"] ?>.00</span>
                                                                        </div>
                                                                    </div>
                                                                <?php
                                                                }
                                                                ?>

                                                            </div>
                                                        </div>
                                                        <hr />
                                                        <?php

                                                        if ($district_data["di_id"] == 1) {
                                                            $d_fee = $book_data["delivery_fee_colombo"];
                                                            $shipping = $book_data["shipping"];
                                                            $price = $book_data["unit_prize"];
                                                            $discount = $book_data["discount"];

                                                            $total = $d_fee + $shipping + $price;
                                                            $d_value = ($price / 100) * $discount;
                                                            $new_total = $total - $d_value;
                                                        } else {
                                                            $d_fee = $book_data["delivery_fee_other"];
                                                            $shipping = $book_data["shipping"];
                                                            $price = $book_data["unit_prize"];
                                                            $discount = $book_data["discount"];

                                                            $total = $d_fee + $shipping + $price;
                                                            $d_value = ($price / 100) * $discount;
                                                            $new_total = $total - $d_value;
                                                        }
                                                        ?>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="row">
                                                                    <div class="col-8">
                                                                        <div class="row">
                                                                            <div class="col-4 text-start">
                                                                                <span class="text-muted" style="font-family: Arial;">Discounts&nbsp;: &nbsp;<?php echo $book_data["discount"] ?>%</span>
                                                                            </div>
                                                                            <div class="col-4 text-end">
                                                                                <span class="text-danger text-decoration-underline" style="font-family: Arial;">New total&nbsp;: &nbsp;Rs.<?php echo $new_total ?>.00</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-4 text-center">
                                                                        <span class="text-danger text-decoration-underline" style="font-family: Arial">Total:&nbsp;<span>Rs.<?php echo $total ?>.00</span></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- large -->
                        <!-- small -->
                        <div class="col-12 px-4  mt-3 mb-4 d-block d-lg-none">
                            <div class="card border-1 border-info  bg-info" style="border-radius: 10px;">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <label class="form-label">Basket items(<?php echo $book_num ?>)</label>
                                    </div>
                                </div>
                                <!-- part1 -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <img src="<?php echo $book_data["image"] ?>" class="img-thumbnail" />
                                                        </div>
                                                        <div class="col-12">
                                                            <a class="form-label" style="color: darkblue;" href='<?php echo "singleView.php?id=" . $book_data["book_id"]; ?>'><?php echo $book_data["title"] ?></a>
                                                        </div>
                                                        <div class="col-12">
                                                            <span class="text-info">Author&nbsp;:&nbsp;<?php echo $book_data["fname"] ?>&nbsp;<?php echo $book_data["lname"] ?></span>
                                                        </div>
                                                        <div class="col-12 mt-2">
                                                            <span>Price(Rs.00)&nbsp;:</span>
                                                        </div>
                                                        <div class="col-12 mt-1 text-center">
                                                            <span class="text-danger"><?php echo $book_data["unit_prize"] ?></span>
                                                        </div>
                                                        <div class="col-12">
                                                            <span class="text-muted">Discounts&nbsp;:&nbsp;&nbsp;<?php echo $book_data["discount"] ?>%</span>
                                                        </div>
                                                        <div class="col-12 mt-2">
                                                            <span>Shipping(Rs.00)&nbsp;:</span>
                                                        </div>
                                                        <div class="col-12 mt-1 text-center">
                                                            <span class="text-danger"><?php echo $book_data["shipping"] ?></span>
                                                        </div>
                                                        <div class="col-12 mt-2">
                                                            <span>Delivery fee(Rs.00)&nbsp;:</span>
                                                        </div>
                                                        <?php
                                                        if ($district_data["di_id"] == 1) {
                                                        ?>
                                                            <div class="col-12 mt-1 text-center">
                                                                <span class="text-danger"><?php echo $book_data["delivery_fee_colombo"]; ?></span>
                                                            </div>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <div class="col-12 mt-1 text-center">
                                                                <span class="text-danger"><?php echo $book_data["delivery_fee_other"]; ?></span>
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>
                                                        <div class="col-12 mt-2">
                                                            <span class="text-success">Total(Rs.00)&nbsp;:</span>
                                                        </div>
                                                        <div class="col-12 mt-1 text-center">
                                                            <span class="text-danger text-decoration-underline"><?php echo $total ?></span>
                                                        </div>
                                                        <div class="col-12 mt-2">
                                                            <span class="text-success">New total(Rs.00)&nbsp;:</span>
                                                        </div>
                                                        <div class="col-12 mt-1 text-center">
                                                            <span class="text-danger text-decoration-underline"><?php echo $new_total ?></span>
                                                        </div>
                                                        <div class="col-12 mt-2 text-center">
                                                            <button class="btn btn-sm border border-dark" onclick="addToCart1(<?php echo $book_data['book_id']?>);"><i class="bi bi-bookmark-heart"></i>Add to cart</button>
                                                        </div>
                                                        <div class="col-12 mt-2 text-center">
                                                            <button class="btn btn-sm border" style="background-color: orange;" onclick="removeWishlist(<?php echo $book_data['book_id'] ?>);">Remove</button>
                                                        </div>
                                                        <div class="col-12 mt-1">
                                                            <hr />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- part1 -->
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="row">
            <?php include "footer.php"; ?>
        </div>

    </div>
    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>


</body>

</html>