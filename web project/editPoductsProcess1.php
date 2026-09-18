<?php
require "connection.php";
$book_id = $_GET["id"];

$book_rs = Database::search("SELECT * FROM `books` WHERE `book_id`='" . $book_id . "'");
$book_data = $book_rs->fetch_assoc();

$au_rs = Database::search("SELECT * FROM `authors` WHERE `id`='" . $book_data["authors_id"] . "'");
$au_data = $au_rs->fetch_assoc();

$pb_rs = Database::search("SELECT * FROM `publisher` WHERE `id`='" . $book_data["publisher_id"] . "'");
$pb_data = $pb_rs->fetch_assoc();
?>

    <div class="d-flex justify-content-center align-items-center">
        <div class="col-12 col-lg-6 mb-5">
            <div class="card mt-3 shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" value="<?php echo $book_data["title"] ?>" id="title" readonly>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Author</label>
                            <div class="row">
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">First Name</label>
                                        <input type="text" class="form-control" value="<?php echo $au_data["fname"] ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label">Last Name</label>
                                        <input type="text" class="form-control" value="<?php echo $au_data["lname"] ?>" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="pbl" class="form-label">Publisher</label>
                                <input type="text" class="form-control" value="<?php echo $pb_data["publisher"] ?>" readonly>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="copy" class="form-label">Copy</label>


                                <?php
                                $copy_rs = Database::search("SELECT * FROM `copy` WHERE `copy_id`='" . $book_data["copy_copy_id"] . "'");

                                $copy_data = $copy_rs->fetch_assoc();
                                ?>
                                <input type="text" class="form-control" id="copy" value="<?php echo $copy_data["type"] ?>" readonly />


                            </div>
                        </div>
                        <div class="col-12" id="cover_div">
                            <div class="mb-3">
                                <label class="form-label">Cover Type</label>
                                
                                <?php
                               
                                    $cover_rs = Database::search("SELECT * FROM `cover` WHERE `id`='" . $book_data["cover_id"] . "'");
                                    $cover_data = $cover_rs->fetch_assoc();
                                ?>
                                    <input type="text" class="form-control" value="<?php echo $cover_data["condition"] ?>" readonly />
                               

                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Category</label>


                                <?php
                                $category_rs = Database::search("SELECT * FROM `sub_categories` WHERE `id`='" . $book_data["sub_categories_id"] . "'");
                                $category_data = $category_rs->fetch_assoc();
                                ?>
                                <input type="text" class="form-control" value="<?php echo $category_data["name"] ?>" id="cg" readonly  />


                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Usage</label>


                                <?php
                                $usage_rs = Database::search("SELECT * FROM `usage` WHERE `id`='" . $book_data["usage_id"] . "'");

                                $usage_data = $usage_rs->fetch_assoc();
                                ?>
                                <input type="text" class="form-control" value="<?php echo $usage_data["usage_type"] ?>" readonly />



                            </div>
                        </div>
                        <?php
                        if ($book_data["copy_copy_id"] == 1) {
                        ?>
                            <div class="col-12" id="qty_div">

                                <div class="mb-3">
                                    <label for="qty" class="form-label">Quantity</label>
                                    <input type="number" class="form-control" id="qty" value="<?php echo $book_data["qty"] ?>" min="1">
                                </div>

                            </div>

                        <?php
                        }
                        ?>
                        <div class="col-12">
                            <label class="form-label">Price(Rs.)</label>
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-2">
                                                        <span class="input-group-text">Rs.</span>
                                                    </div>
                                                    <div class="col-5">
                                                        <input class="form-control" id="price" aria-label="Amount (to the nearest rupee)" value="<?php echo $book_data["price"] ?>" />
                                                    </div>
                                                    <div class="col-2">
                                                        <span class="input-group-text">.00</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label class="form-label">Discounts</label>
                                                        <input type="number" class="form-control" id="dsc" value="<?php echo $book_data["discount"] ?>" min="0" />
                                                    </div>
                                                    <?php
                                                    if ($book_data["copy_copy_id"] == 1) {
                                                    ?>
                                                        <div class="col-6" id="shipping_div">
                                                            <label class="form-label">Shipping</label>
                                                            <div class="row">
                                                                <div class="col-3">
                                                                    <span class="input-group-text">Rs.</span>
                                                                </div>
                                                                <div class="col-6">
                                                                    <input type="number" class="form-control" id="shipping" aria-label="Amount (to the nearest rupee)" value="<?php echo $book_data["shipping"] ?>">
                                                                </div>
                                                                <div class="col-3">
                                                                    <span class="input-group-text">.00</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6" id="dfc_div">
                                                            <label class="form-label">Delivery fee Colombo</label>
                                                            <div class="row">
                                                                <div class="col-3">
                                                                    <span class="input-group-text">Rs.</span>
                                                                </div>
                                                                <div class="col-6">
                                                                    <input type="number" class="form-control" id="dfc" aria-label="Amount (to the nearest rupee)" value="<?php echo $book_data["delivery_fee_colombo"] ?>">
                                                                </div>
                                                                <div class="col-3">
                                                                    <span class="input-group-text">.00</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6" id="dfo_div">
                                                            <label class="form-label">Delivery fee other</label>
                                                            <div class="row">
                                                                <div class="col-3">
                                                                    <span class="input-group-text">Rs.</span>
                                                                </div>
                                                                <div class="col-6">
                                                                    <input type="number" class="form-control" id="dfo" aria-label="Amount (to the nearest rupee)" value="<?php echo $book_data["delivery_fee_other"] ?>">
                                                                </div>
                                                                <div class="col-3">
                                                                    <span class="input-group-text">.00</span>
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
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">Update Image</label>
                                <input type="file" class="form-control" id="img" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="seller" class="form-label">Seller's Email</label>
                                <input type="email" class="form-control" value="<?php echo $book_data["seller_email"] ?>" readonly>
                            </div>
                        </div>
                        <?php
                        if ($book_data["copy_copy_id"] == 1) {
                        ?>
                            <div class="col-12 text-center">
                                <button class="btn btn-success" style="width: 25%;" onclick="update1(<?php echo $book_id ?>);">Update</button>
                            </div>
                        <?php
                        } else if ($book_data["copy_copy_id"] == 2){
                        ?>
                            <div class="col-12 text-center">
                                <button class="btn btn-danger" style="width: 25%;" onclick="update2(<?php echo $book_id ?>);">Update</button>
                            </div>

                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div></div>
