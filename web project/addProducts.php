<?php
 require "connection.php";
 session_start();

if(isset($_SESSION["admin"])){
    ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <title>Add Products</title>
</head>

<body>
    <div class="container-fluid vh-100">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="row mt-3">
                    <img src="resources/emptyImg.jpg" class="img-fluid" style="height: 700px;" alt="..." id="book_img">
                </div>
                <div class="row mt-3">
                    <div class="input-group">
                        <input type="file" class="form-control" id="img" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                        <button class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon04" onclick="viewImg();">View</button>
                    </div>
                </div>
    
            </div>
            <div class="col-12 col-lg-6 mb-5">
                <div class="card mt-3 shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" placeholder="Enter the book title..">
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Author</label>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">First Name</label>
                                            <input type="text" class="form-control" id="fname" placeholder="Author's name">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label class="form-label">Last Name</label>
                                            <input type="text" class="form-control" id="lname" placeholder="Author's name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="pbl" class="form-label">Publisher</label>
                                    <input type="text" class="form-control" id="pbl" placeholder="Enter the publisher..">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="copy" class="form-label">Copy</label>
                                    <select class="form-select" id="copy">
                                        <option>Select a category</option>
                                        <?php
                                        $copy_rs = Database::search("SELECT * FROM `copy`");
                                        $copy_num = $copy_rs->num_rows;
                                        for ($a = 0; $a < $copy_num; $a++) {
                                            $copy_data = $copy_rs->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $copy_data["copy_id"] ?>"><?php echo $copy_data["type"] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12" id="cover_div">
                                <div class="mb-3">
                                    <label for="ct" class="form-label">Cover Type</label>
                                    <select class="form-select" id="ct">
                                        <option>Select a cover type</option>
                                        <?php
                                        $cover_rs = Database::search("SELECT * FROM `cover`");
                                        $cover_num = $cover_rs->num_rows;
                                        for ($z = 0; $z < $cover_num; $z++) {
                                            $cover_data = $cover_rs->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $cover_data["id"] ?>"><?php echo $cover_data["condition"] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="cg" class="form-label">Category</label>
                                    <select class="form-select" id="cg">
                                        <option>Select the category</option>
                                        <?php
                                        $category_rs = Database::search("SELECT * FROM `sub_categories`");
                                        $category_num = $category_rs->num_rows;
                                        for ($x = 0; $x < $category_num; $x++) {
                                            $category_data = $category_rs->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $category_data["id"] ?>"><?php echo $category_data["name"] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="usage" class="form-label">Usage</label>
                                    <select class="form-select" id="usage">
                                        <option>Select the condition</option>
                                        <?php
                                        $usage_rs = Database::search("SELECT * FROM `usage`");
                                        $usage_num = $usage_rs->num_rows;
                                        for ($y = 0; $y < $usage_num; $y++) {
                                            $usage_data = $usage_rs->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $usage_data["id"] ?>"><?php echo $usage_data["usage_type"] ?></option>
                                        <?php
                                        }
                                        ?>

                                    </select>
                                </div>
                            </div>
                            <div class="col-12" id="qty_div">
                                <div class="mb-3">
                                    <label for="qty" class="form-label">Quantity</label>
                                    <input type="number" class="form-control" id="qty" value="1" min="1">
                                </div>
                            </div>
                            <div class="col-12">
                        <script>
                            document.getElementById("copy").onchange = function() {
                                if (document.getElementById("copy").value == 2) {
                                    document.getElementById("copy_div").classList = "d-block";
                                    document.getElementById("soft_button").classList = "d-block";
                                    document.getElementById("hard_button").classList = "d-none";
                                    document.getElementById("cover_div").classList = "d-none";
                                    document.getElementById("shipping_div").classList = "d-none";
                                    document.getElementById("dfc_div").classList = "d-none";
                                    document.getElementById("dfo_div").classList = "d-none";
                                    document.getElementById("qty_div").classList = "d-none";
                                }else if(document.getElementById("copy").value == 1){
                                    document.getElementById("copy_div").classList = "d-none";
                                    document.getElementById("soft_button").classList = "d-none";
                                    document.getElementById("hard_button").classList = "d-block";
                                    document.getElementById("cover_div").classList = "d-block";
                                    document.getElementById("shipping_div").classList = "d-block";
                                    document.getElementById("dfc_div").classList = "d-block";
                                    document.getElementById("dfo_div").classList = "d-block";
                                    document.getElementById("qty_div").classList = "d-block";
                                }
                            }
                        </script>
                        <div class="mb-3 d-none" id="copy_div">
                            <label class="form-label">Upload soft copy</label>
                            <input type="file" class="form-control" id="s_copy"/>
                            
                        </div>
                    </div>
                            <div class="col-12">
                                <label class="form-label">Price(Rs.)</label>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <span class="input-group-text">Rs.</span>
                                                        </div>
                                                        <div class="col-6">
                                                            <input type="number" class="form-control" id="price" aria-label="Amount (to the nearest rupee)">
                                                        </div>
                                                        <div class="col-3">
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
                                                            <input type="number" class="form-control" id="dsc" value="0" min="0"/>
                                                        </div>
                                                        <div class="col-6" id="shipping_div">
                                                            <label class="form-label">Shipping</label>
                                                            <div class="row">
                                                                <div class="col-3">
                                                                    <span class="input-group-text">Rs.</span>
                                                                </div>
                                                                <div class="col-6">
                                                                    <input type="number" class="form-control" id="shipping" aria-label="Amount (to the nearest rupee)" value="0">
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
                                                                    <input type="number" class="form-control" id="dfc" aria-label="Amount (to the nearest rupee)">
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
                                                                    <input type="number" class="form-control" id="dfo" aria-label="Amount (to the nearest rupee)">
                                                                </div>
                                                                <div class="col-3">
                                                                    <span class="input-group-text">.00</span>
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
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="seller" class="form-label">Seller's Email</label>
                                    <input type="email" class="form-control" id="seller" placeholder="Enter the seller..">
                                </div>
                            </div>
                            <div class="col-12 text-center" id="hard_button">
                                <button class="btn btn-success" style="width: 25%;" onclick="addProducts();">Add</button>
                            </div>
                            <div class="col-12 text-center d-none" id="soft_button">
                                <button class="btn btn-danger"  style="width: 25%;" onclick="uploadPdf();">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include "footer.php" ?>
        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>
    
    <?php
}
?>
