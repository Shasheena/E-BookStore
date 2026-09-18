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
    <title>Manage Products</title>
</head>

<?php
if(isset($_SESSION["admin"])){
?>
<body>
    <div class="container-fluid">
        <div class="row" id="return">
            <div class="col-12 text-center">
                <nav class="navbar bg-info">
                    <div class="">
                        <button class="navbar-brand btn btn-primary mx-2" href="addProducts.php">
                            All
                        </button>
                        <button class="navbar-brand btn btn-light" href="addProducts.php">
                            Out of Stock(0)
                        </button>
                        <button class="navbar-brand btn btn-light" href="addProducts.php">
                            Sold
                        </button>
                        <button class="navbar-brand btn btn-light" href="addProducts.php">
                            Pending
                        </button>
                    </div>
                </nav>
            </div>
            <div class="col-12">
                <nav class="navbar navbar-expand-lg bg-light">
                    <div class="container-fluid d-flex justify-content-end">
                        <div class="" id="navbarScroll">
                            <div class="d-flex" role="search">
                                <select class="form-select me-2" id="ctgy">
                                    <option value="no">Category</option>
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
                                <input placeholder="Author's first or last name" id="au" class="form-control me-2"/>
                                <input class="form-control me-2" type="search" placeholder="title" aria-label="Search" id="title">
                                <button class="btn btn-outline-success" type="submit" onclick="adminSeachBooks();">Search</button>
                            </div>
                        </div>
                        <div></div>
                    </div>
                </nav>
            </div>
            <div class="col-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Book</th>
                            <th scope="col">Title</th>
                            <th scope="col">Copy</th>
                            <th scope="col">Author</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Seller</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                        $book_rs = Database::search("SELECT * FROM `books`");
                        $book_num = $book_rs->num_rows;
                        for ($y = 0; $y < $book_num; $y++) {
                            $book_data = $book_rs->fetch_assoc();
                            $copy_rs = Database::search("SELECT * FROM `copy` WHERE `copy_id`='" . $book_data["copy_copy_id"] . "'");
                            $copy_data = $copy_rs->fetch_assoc();
                            $au_rs = Database::search("SELECT * FROM `authors` WHERE `id`='" . $book_data["authors_id"] . "'");
                            $au_data = $au_rs->fetch_assoc();
                            $seller_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $book_data["seller_seller_mail"] . "'");
                            $seller_data = $seller_rs->fetch_assoc();
                            $book_id = $book_data["book_id"];
                        ?>
                            <tr>
                                <td>
                                    <img src="<?php echo $book_data["image"] ?>" class="img-thumbnail" alt="..." style="height:60px;width:60px;">
                                </td>
                                <td><?php echo $book_data["title"] ?></td>
                                <td><?php echo $copy_data["type"] ?></td>
                                <td><?php echo $au_data["fname"] ?>&nbsp;&nbsp;<?php echo $au_data["lname"] ?></td>
                                <td><?php echo $book_data["qty"] ?></td>
                                <td><?php echo $book_data["price"] ?></td>
                                <td><?php echo $seller_data["fname"] ?>&nbsp;&nbsp;<?php echo $seller_data["lname"] ?></td>
                                <th scope="row">
                                    <button class="btn btn-secondary btn-sm" onclick="remove(<?php echo $book_id ?>);">Remove</button>
                                </th>
                                <th scope="row">
                                    <button onclick="editProducts(<?php echo $book_data['book_id'] ?>)"><i class="bi bi-pencil-fill"></i></button>
                                </th>
                            </tr>

                        <?php
                        }
                        ?>

                    </tbody>
                </table>
            </div>
            <div class="col-12 text-end mb-3">
                <button class="btn btn-danger btn-sm" onclick="adminRemoveAllBooks();">Remove All</button>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>
<?php
}else{
    echo("Sign in first!");
}
?>



</html>