<?php
require "connection.php";
session_start();
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
                <nav class="navbar bg-light">
                    <div class="container-fluid">
                        <span class="navbar-brand mb-0 h1">Welcome!&nbsp; <strong><?php echo $_SESSION["seller"]["fname"] ?>&nbsp;<?php echo $_SESSION["seller"]["lname"] ?></strong></span>
                        <span class="navbar-brand text-end" onclick="logOutSeller();">Log Out&nbsp;</span>
                    </div>
                </nav>
            </div>
            <div class="col-12">
                <nav class="navbar bg-light">
                    <div class="container-fluid">
                        <a class="btn btn-outline-primary btn-sm" href="sellerHome.php"><i class="bi bi-house-door-fill"></i></a>
                        <a class="btn btn-outline-primary btn-sm" href="addProducts.php">Add Poducts</a>
                        <a class="btn btn-outline-primary btn-sm" href="manageSellerBook.php">Manage</a>
                        <div class="d-flex">
                            <input class="form-control me-2" type="search" placeholder="Book Title,Autor,Publisher" aria-label="Search" id="searchSellerHome">
                            <button class="btn btn-outline-success" type="submit" onclick="searchSellerHome();">Search</button>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="col-12">
                <div class="row" id="sortRow">
                    <div class="col-12 col-lg-2 mt-3 mb-3">
                        <h4>QTY</h4>
                        <input class="form-check-input" type="radio" name="s" id="htlq">
                        <label class="form-check-label" for="s">
                            High to Low
                        </label>
                        <input class="form-check-input" type="radio" name="s" id="lthq">
                        <label class="form-check-label" for="s">
                            Low to High
                        </label>
                    </div>
                    <div class="col-12 col-lg-3 mt-3 mb-3">
                        <h4>PRICE</h4>
                        <input class="form-check-input" type="radio" name="s" id="phtl">
                        <label class="form-check-label" for="s">
                            High to Low
                        </label>
                        <input class="form-check-input" type="radio" name="s" id="plth">
                        <label class="form-check-label" for="s">
                            Low to High
                        </label>
                    </div>
                    <div class="col-12 col-lg-3 mt-3 mb-3">
                        <h4>QUALITY</h4>
                        <input class="form-check-input" type="radio" name="bnew" id="bnew">
                        <label class="form-check-label" for="bnew">
                            brand new
                        </label>
                        <input class="form-check-input" type="radio" name="bnew" id="new">
                        <label class="form-check-label" for="new">
                            new
                        </label>
                        <input class="form-check-input" type="radio" name="bnew" id="used">
                        <label class="form-check-label" for="used">
                            Used
                        </label>
                        <input class="form-check-input" type="radio" name="bnew" id="old">
                        <label class="form-check-label" for="old">
                            Old
                        </label>
                    </div>
                    <div class="col-12 col-lg-2 mt-3 mb-3">
                        <h4>COPY</h4>
                        <input class="form-check-input" type="radio" name="hard" id="hard">
                        <label class="form-check-label" for="hard">
                            Hard
                        </label>
                        <input class="form-check-input" type="radio" name="hard" id="soft">
                        <label class="form-check-label" for="soft">
                            Soft
                        </label>
                    </div>
                    <div class="col-12 col-lg-2">
                        <button class="btn btn-outline-success mt-4" onclick="sellerSortProcess();">Sort</button>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-12">
                            <div class="row" id="return">
                                <?php
                                $book_rs = Database::search("SELECT * FROM `books` INNER JOIN `authors` ON 
                                `authors`.`id`=`books`.`authors_id` INNER JOIN `publisher` ON 
                                `publisher`.`id`=`books`.`publisher_id` INNER JOIN `copy` ON 
                                `copy`.`copy_id`=`books`.`copy_copy_id` WHERE `seller_email`='" . $_SESSION["seller"]["email"] . "'");
                                $book_num = $book_rs->num_rows;
                                for ($x = 0; $x < $book_num; $x++) {
                                    $book_data = $book_rs->fetch_assoc();
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
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include "footer.php";?>
        </div>

        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>
    </body>
<?php
} else {
    echo ("Sign in first!");
} ?>


</html>