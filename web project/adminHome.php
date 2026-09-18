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
    <title>Home</title>
</head>

<?php
if (isset($_SESSION["admin"]) && $_SESSION["admin"]["status_id"] == 1) {
?>

    <body>
        <div class="container-fluid vh-100">
            <div class="row">
                <div class="col-12 adminHome" style="height: 200px;">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="row mt-5">
                                <div class="col-4" style="color: red;border-radius:100%;height: 30px;width:30px;">
                                    <?php if (isset($_SESSION["admin"]["images"])) {
                                    ?>
                                        <img src="<?php echo $_SESSION["admin"]["images"] ?>" style="height: 100px;width:100px;border-radius:100%;" />
                                    <?php
                                    } else {
                                    ?>
                                        <img src="resources/emptyUser.png" style="height: 100px;width:100px;border-radius:100%;" />
                                    <?php
                                    } ?>

                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row mt-5">
                                <div class="col-12">
                                    <?php if (isset($_SESSION["admin"]["lname"])) {
                                    ?>
                                        <label class="fw-bold fs-4"><?php echo $_SESSION["admin"]["fname"] ?>&nbsp;<?php echo $_SESSION["admin"]["lname"] ?></label>
                                    <?php
                                    } else {
                                    ?>
                                        <label class="fw-bold fs-4"><?php echo $_SESSION["admin"]["fname"] ?></label>
                                    <?php
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-12 mt-3 mb-3">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="adminHome.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="adminProfile.php">My Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="manageAdmin.php">Manage Admin</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="manageProducts.php">Manage Products</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="manageUsers.php">Manage Users</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="addProducts.php">Add Products</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="help.php">Help</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12" style="background-image: linear-gradient(to bottom right,red,yellow);">
                <div class="row">
                    <div class="d-flex d-flex justify-content-around">
                        <div class="col-12 col-lg-3">
                            <div class="card" style="width: 18rem;">
                                <div class="card-body text-center">
                                    <?php
                                    $month = date("Y");
                                    $best_seller = Database::search("SELECT `bk_id`, COUNT(`bk_id`) AS `freq` FROM `invoice` WHERE `date` LIKE '%" . $month . "%'
                                    GROUP BY `bk_id` ORDER BY `freq` DESC LIMIT 1");
                                    $best_seller_num = $best_seller->num_rows;
                                    if ($best_seller_num > 0) {
                                        $best_seller_data = $best_seller->fetch_assoc();
                                        $best_seller_name = Database::search("SELECT * FROM `user` INNER JOIN `books` ON 
                                        `books`.`seller_email`=`user`.`email` INNER JOIN `publisher` ON `publisher`.`id`=`books`.`publisher_id` INNER JOIN `usage` ON `usage`.`id`=`books`.`usage_id` WHERE `book_id`='" . $best_seller_data["bk_id"] . "'");
                                        $best_selling_au = Database::search("SELECT * FROM `authors` INNER JOIN `books` ON `authors`.`id`=`books`.`authors_id`
                                        WHERE `book_id`='" . $best_seller_data["bk_id"] . "'");

                                        $best_selling_au_data = $best_selling_au->fetch_assoc();

                                        $best_seller_name_data = $best_seller_name->fetch_assoc();
                                    }
                                    ?>
                                    <div class="card-header mb-3">
                                        <h5 class="card-title fw-bold">Best Seller</h5>
                                    </div>
                                    <h5 class="card-title fw-bold text-bg-danger"><?php echo $best_seller_name_data["fname"] ?> <?php echo $best_seller_name_data["lname"] ?></h5>
                                    <h5 class="card-title fw-bold text-bg-dark"><strong class="text-secondary">Sales</strong> : <?php echo $best_seller_data["freq"] ?></li>
                                    </h5>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong class="text-secondary">email</strong> : <?php echo $best_seller_name_data["email"] ?></li>
                                        <li class="list-group-item"><strong class="text-secondary">No</strong> : 0<?php echo $best_seller_name_data["mobile"] ?></li>
                                        <li class="list-group-item"><strong class="text-secondary">Joined date</strong> : <?php echo $best_seller_name_data["joined_date"] ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3 mb-3">
                            <div class="card" style="width: 18rem;">
                                <div class="card-body text-center">
                                    <div class="card-header mb-3">
                                        <h5 class="card-title fw-bold">Best Selling Product</h5>
                                    </div>
                                    <img src="<?php echo $best_seller_name_data["image"] ?>" class="card-img-top mb-3" alt="...">
                                    <h5 class="card-title fw-bold text-bg-success"><?php echo $best_seller_name_data["title"] ?></h5>
                                    <h5 class="card-title fw-bold text-bg-warning"><strong class="text-secondary">Sales</strong> : <?php echo $best_seller_data["freq"] ?></li>
                                    </h5>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong class="text-secondary">Author</strong> : <?php echo $best_selling_au_data["fname"] ?> <?php echo $best_selling_au_data["lname"] ?></li>
                                        <li class="list-group-item"><strong class="text-secondary">Publisher</strong> : <?php echo $best_seller_name_data["publisher"] ?></li>
                                        <li class="list-group-item"><?php echo $best_seller_name_data["usage_type"] ?></li>
                                        <li class="list-group-item"><strong class="text-secondary">Remaining quantity :</strong> : <?php echo $best_seller_name_data["qty"] ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3 mb-5">
                            <div class="card mx-5" style="width: 18rem;">
                                <div class="card-body text-center">
                                    <div class="card-header mb-3">
                                        <h5 class="card-title fw-bold">Discounts</h5>
                                    </div>
                                    <?php
                                    $discount = Database::search("SELECT * FROM `books` WHERE `discount`!='0'");
                                    $discount_num = $discount->num_rows;
                                    ?>
                                    <ul class="list-group list-group-flush">
                                        <?php
                                        for ($x = 0; $x < $discount_num; $x++) {
                                            $discount_data = $discount->fetch_assoc();
                                        ?>
                                            <li class="list-group-item"><?php echo $discount_data["title"] ?> : <?php echo $discount_data["discount"] ?>%</li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            
                            
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="card" style="width: 18rem;">
                                <div class="card-body text-center">
                                    <div class="card-header mb-3">
                                        <h5 class="card-title fw-bold">Incomes</h5>
                                    </div>
                                    <?php
                            $today = date("Y-m-d");
                            $income_today = Database::search("SELECT SUM(`total`) AS 'income_today' FROM `invoice` WHERE `date` LIKE '%" . $today . "%'");
                            $income_today_data = $income_today->fetch_assoc();

                            $year_month = date("Y-m");
                            $monthly_income = Database::search("SELECT SUM(`total`) AS 'monthly_income' FROM `invoice` WHERE `date` LIKE '%" . $year_month . "%'");
                            $monthly_income_data = $monthly_income->fetch_assoc();

                            $year = date("Y");
                            $yearly_income = Database::search("SELECT SUM(`total`) AS 'yearly_income' FROM `invoice` WHERE `date` LIKE '%" . $year . "%'");
                            $yearly_income_data = $yearly_income->fetch_assoc();

                            ?>
                            <div class="alert alert-secondary text-center" role="alert">
                                <?php 
                                if(empty($income_today_data["income_today"])){
                                    ?>
                                    <h3>Today Income   <strong class=" text-bg-danger">Rs.0.00</strong></h3>
                                    <?php
                                }else{
                                    ?>
                                    <h3>Today Income   <strong class="text-bg-danger">Rs.<?php echo $income_today_data["income_today"]; ?></strong></h3>
                                    <?php
                                }
                                ?>
                                
                            </div><br />
                            <div class="alert alert-secondary text-center" role="alert">
                            <?php 
                                if(empty($income_today_data["income_today"])){
                                    ?>
                                    <h3>Monthly Income   <strong class=" text-bg-danger">Rs.0.00</strong></h3>
                                    <?php
                                }else{
                                    ?>
                                    <h3>Monthly Income   <strong class=" text-bg-danger">Rs.<?php echo $monthly_income_data["monthly_income"]; ?></strong></h3>
                                    <?php
                                }
                                ?>
                                
                            </div><br />
                            <div class="alert alert-secondary text-center" role="alert">
                            <?php 
                                if(empty($yearly_income_data["yearly_income"])){
                                    ?>
                                    <h3>Yearly Income   <strong class=" text-bg-danger">Rs.0.00</strong></h3>
                                    <?php
                                }else{
                                    ?>
                                    <h3>Yearly Income   <strong class=" text-bg-danger">Rs.<?php echo $yearly_income_data["yearly_income"]; ?></strong></h3>
                                    <?php
                                }
                                ?>
                                
                            </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-12 mt-3 mb-5">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Product quantity
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-3">
                                                    <?php 
                                                    $total_product = Database::search("SELECT * FROM `books`");
                                                    $total_product_num  = $total_product->num_rows;

                                                    $year_sold_product = Database::search("SELECT * FROM `invoice` WHERE `date` LIKE '%".$year."%'");
                                                    $year_sold_product_num = $year_sold_product->num_rows;

                                                    $month_sold_product = Database::search("SELECT * FROM `invoice` WHERE `date` LIKE '%".$year_month."%'");
                                                    $month_sold_product_num = $month_sold_product->num_rows;

                                                    $out_of_stock = Database::search("SELECT * FROM `books` WHERE `qty` = '0'");
                                                    $out_of_stock_num = $out_of_stock->num_rows;
                                                    ?>
                                                    <div class="alert alert-primary text-center" role="alert">
                                                        <h3>Total products |  <?php echo $total_product_num;?></h3>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="alert alert-secondary text-center" role="alert">
                                                        <h3>Sold products(this year) | <?php echo $year_sold_product_num;?></h3>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="alert alert-success text-center" role="alert">
                                                        <h3>Sellings(This month) |  <?php echo $month_sold_product_num;?></h3>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="alert alert-primary text-center" role="alert">
                                                        <h3>Out of stock |  <?php echo $out_of_stock_num;?></h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Number of members
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-4">
                                                    <?php 
                                                    $admin = Database::search("SELECT * FROM `admin`");
                                                    $user = Database::search("SELECT * FROM `user`");
                                                    $seller = Database::search("SELECT * FROM `user` WHERE `seller_states_status_id`='1'");
                                                    ?>
                                                    <div class="alert alert-primary text-center" role="alert">
                                                        <h3>Total Admins |  <?php echo $admin->num_rows;?></h3>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="alert alert-success text-center" role="alert">
                                                        <h3>Total Users |  <?php echo $user->num_rows;?></h3>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="alert alert-secondary text-center" role="alert">
                                                        <h3>Active Sellers |  <?php echo $seller->num_rows;?></h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Status
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-6">
                                                    <?php 
                                                    $inactive_admin = Database::search("SELECT * FROM `admin` WHERE `status_id`='2'");
                                                    $inactive_user = Database::search("SELECT * FROM `user` WHERE `status_id`='2'");
                                                    ?>
                                                    <div class="alert alert-primary text-center" role="alert">
                                                        <h3>Inactive Admins |  <?php echo $inactive_admin->num_rows;?></h3>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="alert alert-success text-center" role="alert">
                                                        <h3>Inactive Users |  <?php echo $inactive_user->num_rows;?></h3>
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
            <?php include "footer.php"; ?>
        </div>

        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>
    </body>

<?php
} else {
    echo ("Sign in first!!");
}
?>



</html>