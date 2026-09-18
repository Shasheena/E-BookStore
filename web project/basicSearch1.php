<?php 
require "connection.php";

$b_search = $_POST["b_search"];

$query = "SELECT * FROM `books` INNER JOIN `sub_categories` ON
sub_categories.id = books.sub_categories_id INNER JOIN `publisher` ON
publisher.id=books.publisher_id INNER JOIN `authors` ON
authors.id=books.authors_id INNER JOIN `cover` ON 
cover.id = books.cover_id INNER JOIN `usage` ON 
usage.id = books.usage_id WHERE ";

if(isset($b_search)){
    $query .= "`fname` LIKE '%".$b_search."%' OR `lname` LIKE '%".$b_search."%' OR `title` LIKE '%".$b_search."%'
    OR `publisher`='%".$b_search."%'";
}else if(!isset($b_search)){
    echo("Search something!");
}

$book = Database::search($query);
$book_num = $book->num_rows;

if($book_num>0){
    $book_data = $book->fetch_assoc();
    for($x=0;$x<$book_num;$x++){
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

}else{
    echo("No matched results!");
}
?>

