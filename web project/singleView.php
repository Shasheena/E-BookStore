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

    <title>sBOOKS | Single View</title>
</head>

<body>
    <?php
    if (isset($_GET["id"])) {
    ?>
        <div class="container-fluid vh-100">
            <?php
            $book_id = $_GET["id"];
            $book_rs = Database::search("SELECT * FROM `books` INNER JOIN `authors` ON 
            authors.id = books.authors_id INNER JOIN `cover` ON cover.id = books.cover_id 
            INNER JOIN `usage` ON usage.id = books.usage_id INNER JOIN `publisher` ON publisher.id = books.publisher_id
            INNER JOIN `copy` ON copy.copy_id = books.copy_copy_id
            WHERE `book_id` = '" . $book_id . "'");
            $book_data = $book_rs->fetch_assoc();

            $cart_rs = Database::search("SELECT * FROM `cart` WHERE `book_id` = '" . $book_id . "'");
            $cart_num = $cart_rs->num_rows;
            $cart_data = $cart_rs->fetch_assoc();
            ?>
            <div class="row">
                <?php include "header.php"; ?>
            </div>
            <div class="row py-5">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-lg-3 offset-1">
                            <img src="<?php echo $book_data["image"] ?>" class="img-thumbnail" />
                        </div>
                        <div class="col-12 col-lg-5 mx-2 mx-lg-0">
                            <label class="form-label text-start fs-4" style="font-family: Arial;"><?php echo $book_data["title"] ?></label>
                            <div class="row">
                                <div class="col-12 col-lg-5 mx-2 mx-lg-0">
                                    <label class="form-label text-start fs-6 text-info" style="font-family: Arial;"><?php echo $book_data["fname"] ?>&nbsp;<?php echo $book_data["lname"] ?></label>
                                </div>
                                <div class="col-12  mx-2 mx-lg-0">
                                    <div class="row">
                                        <div class="col-12 col-lg-6">
                                            <button class="btn btn-dark btn-sm border-dark mt-1">Condition:<?php echo $book_data["usage_type"] ?></button>
                                            <button class="btn btn-light btn-sm border-dark mt-1"><?php echo $book_data["condition"] ?></button>
                                            <button class="btn btn-light btn-sm border-dark mt-1"><?php echo $book_data["type"]?>&nbsp;Copy</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mx-2 mx-lg-0 mt-4">
                                    <label class="form-label">Discount&nbsp;<?php echo $book_data["discount"]; ?>%</label>
                                </div>
                                <?php
                                if ($cart_num > 0) {
                                ?>
                                    <div class="col-12 mx-2 mx-lg-0 mt-2">
                                        <label class="form-label">Quantity:&nbsp;</label>
                                        <input type="number" min="1" max="<?php echo $book_data["qty"] ?>" value="<?php echo $cart_data["qty"] ?>" id="qty" />
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="col-12 mx-2 mx-lg-0 mt-2">
                                        <label class="form-label">Quantity:&nbsp;</label>
                                        <input type="number" min="1" max="<?php echo $book_data["qty"] ?>" value="1" id="qty" />
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <hr />
                        </div>
                        <div class="col-12 col-lg-3 mt-4 mt-lg-0 mx-4 mx-lg-0">
                            <div class="card border-0 shadow-lg" style="width: 18rem;">
                                <?php
                                $user_rs = Database::search("SELECT * FROM `address` INNER JOIN `city` ON 
                            city.city_id = address.ci_id WHERE `user_email` = '" . $_SESSION["user"]["email"] . "'");
                                $user_data = $user_rs->fetch_assoc();

                                if ($user_data["di_id"] == 1) {
                                    $d_fee = $book_data["delivery_fee_colombo"];
                                    $shipping = $book_data["shipping"];
                                    $price = $book_data["price"];
                                    $discount = $book_data["discount"];

                                    $d_value = $price / 100 * $discount;
                                    $new_price = $price - $d_value;
                                    $total = $d_fee + $shipping + $new_price;
                                } else {
                                    $d_fee = $book_data["delivery_fee_other"];
                                    $shipping = $book_data["shipping"];
                                    $price = $book_data["price"];
                                    $discount = $book_data["discount"];

                                    $d_value = $price / 100 * $discount;
                                    $new_price = $price - $d_value;
                                    $total = $d_fee + $shipping + $new_price;
                                }
                                ?>
                                <div class="card-body text-center">

                                    <?php
                                    if ($book_data["discount"] > 0) {
                                    ?>
                                        <h3 class="card-subtitle mb-2 text-success text-decoration-line-through">Rs.<?php echo $price ?>.00</h3>
                                        <h3 class="card-subtitle mb-2 text-danger" id="amount">Rs.<?php echo $new_price ?>.00</h3>
                                    <?php
                                    } else {
                                    ?>
                                        <h3 class="card-subtitle mb-2 text-success" id="amount">Rs.<?php echo $price ?>.00</h3>
                                    <?php
                                    }
                                    ?>

                                    <button type="button" class="btn btn-danger" onclick="addToWishlist(<?php echo $book_data['book_id'] ?>);"><i class="bi bi-cart3"></i>&nbsp;Add to wishlist</a>
                                        <button class="card-link btn btn-success" id="payhere-payment" onclick="buyNow(<?php echo $book_id; ?>);">Buy now</button>
                                        <label class="form-label text-dark mt-2"><i class="bi bi-patch-check-fill text-success fs-5"></i>&nbsp;&nbsp;30 day return policy</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-lg-1 text-start text-lg-end offset-1">
                            <label class="form-label fs-4 text-muted">Details</label>
                        </div>
                        <div class="col-12 col-lg-6 text-start">
                            <label class="form-label text-muted mx-2 mx-lg-0">Publisher:<?php echo $book_data["publisher"] ?> </label><br>
                            <label class="form-label text-muted mx-2 mx-lg-0">Copy type:<?php echo $book_data["type"] ?> </label><br>
                            <label class="form-label text-muted mx-2 mx-lg-0">Binding:<?php echo $book_data["condition"] ?> </label><br>
                            <label class="form-label text-muted mx-2 mx-lg-0">Book Condition: <?php echo $book_data["usage_type"] ?></label><br>
                        </div>
                    </div>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-12 col-lg-4 offset-1 text-start text-lg-end">
                    <label class="form-label fs-4 text-muted">Payment methods</label>
                </div>
                <div class="col-12 col-lg-7 mx-4 mx-lg-0 text-start">
                    <label class="form-label fs-4 text-muted"><img src="resources/american_express_img.png" /></label>&nbsp;
                    <label class="form-label fs-4 text-muted"><img src="resources/mastercard_img.png" /></label>&nbsp;
                    <label class="form-label fs-4 text-muted"><img src="resources/paypal_img.png" /></label>&nbsp;
                    <label class="form-label fs-4 text-muted"><img src="resources/visa_img.png" /></label>
                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-12 col-lg-2 offset-1 text-start text-lg-end">
                    <label class="form-label fs-4">Related items</label>
                </div>
                <?php
                $related_rs = Database::search("SELECT * FROM `books` WHERE `sub_categories_id` = '" . $book_data["sub_categories_id"] . "'");
                $related_num = $related_rs->num_rows;
                ?>
                <div class="col-12">
                    <div class="row">
                        <?php
                        for ($x = 0; $x < $related_num; $x++) {
                            $related_data = $related_rs->fetch_assoc();
                        ?>
                            <div class="col-md-4 col-lg-2 col-sm-12 mx-3 mt-3">
                                <div class="card" style="width: 18rem;">
                                    <img class="card-img-top" src="<?php echo $related_data["image"] ?>" alt="Card image cap">
                                    <div class="card-body">
                                        <a class="form-label" style="color: darkblue;" href='<?php echo "singleView.php?id=" . $related_data["book_id"]; ?>'><?php echo $related_data["title"] ?></a>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php include "footer.php"; ?>
            </div>
        </div>
        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>
        <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
</body>

</html>
<?php
    } else {
        echo ("Something went wrong");
    }
?>