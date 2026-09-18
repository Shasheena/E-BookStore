<?php require "connection.php";?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />

    <title>sBOOKS | Browse collections</title>
</head>

<body>
    <div class="container-fluid 100vh">
        <div class="row">
            <?php include "header.php"; ?>
        </div>
        <hr />
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-lg-2 shadow">
                    <div class="row">
                        <div class="col-12 mb-2">
                            <a type="text" class="text-decoration-none text-secondary" href="index.php"><i class="bi bi-house-door-fill text-danger"></i>&nbsp;Home</a>
                        </div>
                        <hr />
                        <div class="col-12 shadow bg-light mb-3">
                            <div class="input-group mb-3 mt-3">
                                <input type="text" class="form-control" placeholder="search.." aria-label="Recipient's username" aria-describedby="button-addon2">
                                <button class="btn btn-outline-secondary bg-dark" type="button" id="button-addon2"><i class="bi bi-search text-light"></i></button>
                            </div>
                        </div>
                        <hr />
                        <?php
                        $main_c = Database::search("SELECT * FROM `main_categories`");
                        $main_cnum = $main_c->num_rows;
                        for ($x = 0; $x < $main_cnum; $x++) {
                            $main_cdata = $main_c->fetch_assoc();
                            $sub_rs = Database::search("SELECT * FROM `sub_categories` WHERE `main_categories_id` = '" . $main_cdata["id"] . "'");
                            $sub_num = $sub_rs->num_rows;
                        ?>
                            <div class="col-12  mb-2">
                                <label class="form-label"><?php echo $main_cdata["name"] ?></label>
                                <div class="row text-start mt-3">
                                    <?php
                                    for ($y = 0; $y < $sub_num; $y++) {
                                        $sub_data = $sub_rs->fetch_assoc();
                                    ?>
                                        <a type="text" class="text-secondary text-decoration-none" href="#"><?php echo $sub_data["name"] ?></a><br /><br />
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <hr />

                        <?php
                        }
                        ?>
                    </div>
                </div>

                <div class="col-12 col-lg-10">
                    <!-- row1-->
                    <?php
                    $main_rs = Database::search("SELECT * FROM `main_categories`");
                    $main_num = $main_rs->num_rows;
                    for ($z = 0; $z < $main_num; $z++) {
                        $main_data = $main_rs->fetch_assoc();
                    ?>
                        <div class="row text-start">
                            <a type="text" class="text-dark fs-2 text-decoration-none" href="#"><?php echo $main_data["name"] ?></a>
                        </div>
                        <div class="row mt-3 mb-2 d-flex justify-content-between">
                            <?php
                            $book_rs = Database::search("SELECT * FROM `books` INNER JOIN `sub_categories` ON
                            sub_categories.id = books.sub_categories_id INNER JOIN `publisher` ON
                            publisher.id=books.publisher_id INNER JOIN `authors` ON
                            authors.id=books.authors_id INNER JOIN `cover` ON 
                            cover.id = books.cover_id INNER JOIN `usage` ON 
                            usage.id = books.usage_id WHERE sub_categories.main_categories_id='" . $main_data["id"] . "' 
                            ");
                            $book_num = $book_rs->num_rows;
                            if ($book_num > 4) {
                                for ($a = 0; $a < 4; $a++) {
                                    $book_data = $book_rs->fetch_assoc();
                            ?>
                                <div class="d-flex justify-content-center">
                                        <div class="flex-shrink-0">
                                            <img src="<?php echo $book_data["image"] ?>" alt="...">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h5 class="card-title"><?php echo $book_data["title"] ?></h5><br />
                                                </div>
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-12 col-lg-6">
                                                            <span class="card-text text-danger">Author</span><br />
                                                            <span><?php echo $book_data["fname"] ?>&nbsp;<?php echo $book_data["lname"] ?></span><br /><br />
                                                            <span class="card-text text-danger">Publisher</span><br />
                                                            <span><?php echo $book_data["publisher"] ?></span><br /><br />
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                            <div class="row">
                                                                <div class="col-12 col-lg-6">
                                                                    <span><?php echo $book_data["usage_type"] ?></span><br />
                                                                    <span><?php echo $book_data["condition"] ?></span><br />
                                                                    <span class="fw-bold fs-3">Rs.<?php echo $book_data["unit_prize"] ?>.00</span>&nbsp;&nbsp;<span class="text-danger"><?php echo $book_data["discount"] ?>% discount</span><br />
                                                                    <span><?php echo $book_data["name"] ?></span><br />
                                                                    <span><?php echo $book_data["qty"] ?>&nbsp; on stock</span><br />
                                                                </div>
                                                                <div class="col-12 col-lg-6">
                                                                    <button class="btn btn-outline-danger fs-4" onclick="addToWishlist(<?php echo $book_data['book_id'] ?>);"><i class="bi bi-heart"></i></button><br /><br />
                                                                    <button class="btn btn-outline-success fs-5"><i class="bi bi-bag-plus" onclick="addToCart(<?php echo $book_data['book_id'] ?>);"></i>Add to cart</button><br/><br/>
                                                                    <a href='<?php echo "singleView.php?id=" . $book_data["book_id"]; ?>' class="btn btn-outline-secondary mb-3">Buy Now</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr />
                                <?php
                                }
                            } else {
                                for ($b = 0; $b < $book_num; $b++) {
                                    $book_data = $book_rs->fetch_assoc();
                                ?>
                                    <div class="d-flex justify-content-center">
                                        <div class="flex-shrink-0">
                                            <img src="<?php echo $book_data["image"] ?>" alt="...">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h5 class="card-title"><?php echo $book_data["title"] ?></h5><br />
                                                </div>
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-12 col-lg-6">
                                                            <span class="card-text text-danger">Author</span><br />
                                                            <span><?php echo $book_data["fname"] ?>&nbsp;<?php echo $book_data["lname"] ?></span><br /><br />
                                                            <span class="card-text text-danger">Publisher</span><br />
                                                            <span><?php echo $book_data["publisher"] ?></span><br /><br />
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                            <div class="row">
                                                                <div class="col-12 col-lg-6">
                                                                    <span><?php echo $book_data["usage_type"] ?></span><br />
                                                                    <span><?php echo $book_data["condition"] ?></span><br />
                                                                    <span class="fw-bold fs-3">Rs.<?php echo $book_data["unit_prize"] ?>.00</span>&nbsp;&nbsp;<span class="text-danger"><?php echo $book_data["discount"] ?>% discount</span><br />
                                                                    <span><?php echo $book_data["name"] ?></span><br />
                                                                    <span><?php echo $book_data["qty"] ?>&nbsp; on stock</span><br />
                                                                </div>
                                                                <div class="col-12 col-lg-6">
                                                                    <button class="btn btn-outline-danger fs-4" onclick="addToWishlist(<?php echo $book_data['book_id'] ?>);"><i class="bi bi-heart"></i></button><br /><br />
                                                                    <button class="btn btn-outline-success fs-5" onclick="addToCart(<?php echo $book_data['book_id'] ?>);"><i class="bi bi-bag-plus"></i>Add to cart</button><br/><br/>
                                                                    <a href='<?php echo "singleView.php?id=" . $book_data["book_id"]; ?>' class="btn btn-outline-secondary mb-3">Buy Now</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr />
                            <?php
                                }
                            }
                            ?>

                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <?php include "footer.php"; ?>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>