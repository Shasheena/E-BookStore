<?php
require "connection.php";

$atb = $_POST["atb"];
$mp = $_POST["mp"];
$mip = $_POST["mip"];
$mct = $_POST["mct"];
$sct = $_POST["sct"];
$con = $_POST["con"];
$copy = $_POST["copy"];
$cover = $_POST["cover"];
$sort = $_POST["sort"];

$query = "SELECT * FROM `books` INNER JOIN `sub_categories` ON
sub_categories.id = books.sub_categories_id INNER JOIN `publisher` ON
publisher.id=books.publisher_id INNER JOIN `authors` ON
authors.id=books.authors_id INNER JOIN `cover` ON 
cover.id = books.cover_id INNER JOIN `usage` ON 
usage.id = books.usage_id WHERE ";

if (!empty($atb)) {
    $query .= "`title` LIKE '%" . $atb . "%' OR `fname` LIKE '%" . $atb . "%' OR `lname` LIKE '%" . $atb . "%' OR `publisher` LIKE '%" . $atb . "%'";
}
// if($mp != 0){
//     $query .= " AND `price` BETWEEN '".$mip."' AND '".$mp."'";
// }

// else if($mip !=0 && $mp !=0){
//     $query .= "`price` BETWEEN '".$mip."' AND '".$mp."'";
// }else if($sct != 0 && $con==0 && $copy==0){
//     $query .= "`sub_categories_id`='".$sct."'";
// }else if($mct !=0 && $sct==0){
//     $query .= "`main_categories_id`='".$mct."'";

if($con!=0 && $mp==0 && empty($atb)){
    if($con==1){
        $query .= "`usage_id`='1'";
    }else if($con==2){
        $query .= "`usage_id`='2'";
    }else if($con==3){
        $query .= "`usage_id`='3'";
    }else if($con==4){
        $query .= "`usage_id`='4'";
    }
}
if(!empty($atb) && $mp !=0){
    $query .= " AND `price` BETWEEN '".$mip."' AND '".$mp."'";
}
if(!empty($atb) && $mp !=0 && $con!=0){
    $query .= " AND `price` BETWEEN '".$mip."' AND '".$mp."' AND `usage_id`='".$con."'";
}
if(!empty($atb) && $mp !=0 && $copy!=0){
    $query .= " AND `price` BETWEEN '".$mip."' AND '".$mp."'";
}
if(!empty($atb) && $mp !=0 && $cover!=0){
    $query .= " AND `price` BETWEEN '".$mip."' AND '".$mp."'";
}
if(!empty($atb) && $mp !=0 && $sort!=0 && $sort==0){
    $query .= " AND `price` BETWEEN '".$mip."' AND '".$mp."'";
}
if(!empty($atb) && $mp !=0 && $sct!=0){
    $query .= " AND `sub_categories_id`='".$sct."'";
}

//
if(!empty($atb) && $mp !=0 && $sct!=0 && $con !=0){
    $query .= "";
}
if(!empty($atb) && $mp !=0 && $sct!=0 && $copy !=0){
    $query .= "";
}
if(!empty($atb) && $mp !=0 && $sct!=0 && $cover !=0){
    $query .= "";
}
if(!empty($atb) && $mp !=0 && $sct!=0 && $sort !=0){
    echo("Np matched items");//this should be made
}
//
if($sct!=0 && $mp !=0 && empty($atb)){
    $query .= " `sub_categories_id`='".$sct."' AND `price` BETWEEN '".$mip."' AND '".$mp."'";
}
if(empty($atb) && $mp==0 && $sct!=0 && $con==0 && $copy==0 && $cover==0 && $sort==0){
    $query .= " `sub_categories_id`='".$sct."'";
}

if($copy != 0){
    if($copy==1){
        $query .= " AND `copy_copy_id`='1'";
       }else if($copy==2){
        $query .= " AND `copy_copy_id`='2'";
       }
}
if($cover != 0){
    if($cover==1){
        $query .= " AND `condition`='Hard cover'";
    }else if($cover==2){
        $query .= " AND `condition`='Soft cover'";
    }
}
if($sct!=0 && $con !=0){
    $query .= " AND `sub_categories_id`='".$sct."'";
}
if($sct!=0 && $con != 0 && $copy != 0){
   $query .= "";
}
if($sct!=0 && $con != 0 && $copy != 0 && $cover != 0 && $sort !=0){
    $query .= "";
}
if($sct != 0 && $sort !=0 && $con==0 && $copy==0 && $cover==0){
    $query .= "`sub_categories_id`='".$sct."'";
}
if(!empty($atb) && $sort!=0 && $mp==0){
    $query .= "";
}
if($sort != 0){
    if($sort==1){
        $query .= " ORDER BY `fname` ASC";
    }else if($sort==2){
        $query .= " ORDER BY `fname` DESC";
    }else if($sort == 3){
        $query .= " ORDER BY `title` ASC";
    }else if($sort == 4){
        $query .= " ORDER BY `title` DESC";
    }else if($sort==5){
        $query .= " ORDER BY `price` DESC";
    }else if($sort==6){
        $query .= " ORDER BY `price` ASC";
    }
}

$book_rs = Database::search($query);
$book_num = $book_rs->num_rows;

if($book_num>0){
    for ($x = 0; $x < $book_num; $x++) {
        $book_data = $book_rs->fetch_assoc();
    ?>
        <div class="d-flex justify-content-center mb-3">
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
                                        <span class="fw-bold fs-3">Rs.<?php echo $book_data["price"] ?>.00</span>&nbsp;&nbsp;<span class="text-danger"><?php echo $book_data["discount"] ?>% discount</span><br />
                                        <span><?php echo $book_data["name"] ?></span><br />
                                        <span><?php echo $book_data["qty"] ?>&nbsp; on stock</span><br />
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <button class="btn btn-outline-danger fs-4" onclick="addToWishlist(<?php echo $book_data['book_id'] ?>);"><i class="bi bi-heart"></i></button><br /><br />
                                        <button class="btn btn-outline-success fs-5" onclick="addToCart(<?php echo $book_data['book_id'] ?>);"><i class="bi bi-bag-plus"></i>Add to cart</button><br /><br />
                                        <a href='<?php echo "singleView.php?id=" . $book_data["book_id"]; ?>' class="btn btn-outline-secondary mb-3">Buy</a>
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

}else {
    echo ("No data matched!");
}
?>
