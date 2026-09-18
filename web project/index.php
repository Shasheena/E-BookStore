<?php
require "connection.php";
session_start();

if (isset($_SESSION["user"]) && $_SESSION["user"]["status_id"] == 1) {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />

        <title>sBOOKS</title>
    </head>

    <body>
        <div class="container-fluid vh-100">
            <div class="row">
                <?php include "header.php"; ?>
            </div>

            <div class="row mt-3 d-flex justify-content-between" id="result">

                <div class="col-12 col-lg-4 bg-light">
                    <div class="jumbotron jumbotron-fluid">
                        <div class="container">
                            <h4 class="">Search for books & collections</h4>
                            <div class="row">
                                <div class="col-12 text-start mt-3">
                                    <span class="text-danger fw-bold">Search what you want</span>
                                    <input class="form-control" type="text" placeholder="Author,title or publisher" id="basicSearch" />
                                </div>
                                <!-- <div class="col-12 text-start mt-2">
                                    <span class="text-danger fw-bold">Title</span>
                                    <input class="form-control" type="text" placeholder="Enter title" id="title"/>
                                </div>
                                <div class="col-12 text-start mt-2">
                                    <span class="text-danger fw-bold">Keyword</span>
                                    <input class="form-control" type="text" placeholder="Enter keyword" id="keyword"/>
                                </div> -->
                                <div class="col-12 text-center mt-3">
                                    <button class="btn btn-primary" style="border-radius: 30px; width:25%;" onclick="basicSearch1();">Search</button>
                                </div>
                                <div class="col-12 mt-5">
                                    <div class="alert alert-success" role="alert">
                                        <h4 class="alert-heading">News Around The Book World!</h4>
                                        <div class="spinner-grow text-danger" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                        <?php
                                        $news_rs = Database::search("SELECT * FROM `news`");
                                        $news_num = $news_rs->num_rows;
                                        for ($x = 0; $x < $news_num; $x++) {
                                            $news_data = $news_rs->fetch_assoc();
                                        ?>
                                            <div id="no_news">
                                                <p><?php echo $news_data["news"] ?></p>
                                                <hr>
                                            </div>

                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-12 mt-2">
                                    <div class="alert alert-primary text-center">
                                        <h4 class="alert-heading">Discounts now available</h4>
                                        <div class="mt-4 text-center">
                                            <?php
                                            $discount = Database::search("SELECT * FROM `books` WHERE `discount`!=0");
                                            $discount_num = $discount->num_rows;
                                            for ($e = 0; $e < $discount_num; $e++) {
                                                $discount_data = $discount->fetch_assoc();
                                            ?>

                                                <label class=" fw-semibold text-bg-info"><?php echo $discount_data["title"] ?> - <?php echo $discount_data["discount"] ?>%</label><br /><br />

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
                <!-- carousal -->
                <div class="col-12 col-lg-8 mt-3 mt-lg-0" style="width:65%;">
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="resources/carousal book1.webp" class="d-block w-100">
                                <div class="carousel-caption d-none d-md-block poster-caption">
                                    <h1 class="poster-title">Welcome to sBOOKS</h1>
                                    <p class="poster-txt fs-4">Experience the best of ours.</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="resources/corousal book2.jpg" class="d-block w-100">
                                <div class="carousel-caption d-none d-md-block poster-caption">
                                    <h1 class="poster-title">Books of different languages.</h1>
                                    <p class="poster-txt fs-4">English & Sinhala especially.</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="resources/carousal book 3.jpeg" class="d-block w-100">
                                <div class="carousel-caption d-none d-md-block poster-caption">
                                    <h1 class="poster-title">Just a one click.</h1>
                                    <p class="poster-txt fs-4">Special discounts are available..</p>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <!-- carousal -->
                <div class="col-12 text-center mt-3 mt-lg-4">
                    <h3 class="fw-bold">Our new books</h3>
                    <div class="row">
                        <div class="col-12 text-center">
                            <p class="fw-bold">Explore newly arrived books in the world & be updated the big bangs in the books' world.</p>
                        </div>
                        <div class="col-12 text-center">
                            <a href="browse.php">See books here-></a>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="row d-flex justify-content-center">
                        <div class="jumbotron col-8  mt-5 shadow">
                            <img src="resources/eye image.jpeg" class="offset-3" />
                            <img src="resources/img1.jpeg" />

                            <p class="lead fw-bolder text-center">Time to collect most valuble local arts..</p>
                            <p class="text-center fw-bold">Newly arrived art & collectives are now on sale to decorate where you live!So,Buy now!</p>

                        </div>
                    </div>
                </div>

                <div class="col-12 mt-5 d-flex justify-content-center">
                    <div class="row d-flex justify-content-between">
                        <div class="col-lg-3 col-12">
                            <div class="card shadow-lg rounded" style="width: 18rem;">
                                <img src="resources/books.webp" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">Books</h5>
                                    <p class="card-text">Fill your bookshelves with many variety of books.</p>
                                    <!-- <a href="browse.php" class="btn btn-primary">See more..</a> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-12 mt-2 mt-lg-0">
                            <div class="card shadow-lg rounded" style="width: 18rem;">
                                <img src="resources/used books.webp" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">Used books</h5>
                                    <p class="card-text">Grab someone else's experience as yours.Give a new life to used books.</p>
                                    <!-- <a href="browse.php" class="btn btn-primary">See more..</a> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-12 mt-2 mt-lg-0">
                            <div class="card shadow-lg rounded" style="width: 18rem;">
                                <img src="resources/rare books.webp" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">Offers</h5>
                                    <p class="card-text">Each month, sellers give some best discounts on their products.See what's for you..</p>
                                    <!-- <a href="browse.php" class="btn btn-primary">See more..</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-5">
                    <div class="row">
                        <div class="col-12 text-center">
                            <p class="fw-bold fs-2">Trending books</p>
                        </div>
                    </div>

                    <div class="row mb-3 d-flex justify-content-between">
                        <?php
                        $trending_books = Database::search("SELECT `bk_id`, `title`, `image`, `fname`, `lname` FROM `invoice` INNER JOIN `books` ON `books`.book_id = `invoice`.bk_id
                        INNER JOIN `authors` ON `authors`.id = `books`.authors_id GROUP BY `bk_id`
                        ORDER BY COUNT(*) DESC
                        LIMIT 4");
                        $trending_books_num = $trending_books->num_rows;
                        for ($a = 0; $a < $trending_books_num; $a++) {
                            $trending_books_data = $trending_books->fetch_assoc();
                        ?>
                            <div class="col-lg-3 col-12  mt-3 mt-lg-0">
                                <div class="card shadow" style="width: 18rem;">
                                    <img src="<?php echo $trending_books_data["image"];?>" class="card-img-top">
                                    <div class="card-body">
                                        <a href="#" class="text-dark"><?php echo $trending_books_data["title"];?></a>
                                        <p class="card-text"><?php echo $trending_books_data["fname"];?> <?php echo $trending_books_data["lname"];?></p>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                    </div>

                    <div class="col-12 mt-4">
                        <div class="row">
                            <div class="jumbotron jumbotron-fluid">
                                <div class="container">
                                    <h1 class="display-4">More to explore....</h1>
                                    <p class="lead">We are publishing a huge vaiety of books of different publishers & authors.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-12">
                                <div class="row mb-3">
                                    <div class="card col-12  border-0 shadow">
                                        <div class="card-body">
                                            <div class="row  d-flex justify-content-between">
                                                <?php
                                                $category_rs = Database::search("SELECT * FROM `sub_categories`");
                                                $category_num = $category_rs->num_rows;
                                                for ($y = 0; $y < $category_num; $y++) {
                                                    $category_data = $category_rs->fetch_assoc();
                                                ?>
                                                    <div class="card col-12 col-lg-4 mb-3 border-0 shadow-lg" style="width: 18rem;">
                                                        <img src="<?php echo $category_data["images"] ?>" class="card-img-top">
                                                        <div class="card-body">
                                                            <a class="card-title text-danger" href="browse.php">Books</a>
                                                            <p class="card-text"><?php echo $category_data["name"] ?></p>
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
<?php
} else {
    echo ("sign in first");
}
?>