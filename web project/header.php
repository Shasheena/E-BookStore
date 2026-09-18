<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />

    <title></title>
</head>

<body>

    <div class="container-fluid 100vh " role="banner">
        <div class="col-12">
            <!-- large -->
            <div class="row d-none d-lg-block shadow-sm bg-body rounded">
            <div class="row">
                <div class="col-3">
                    <p class="fs-3 fw-bold text-primary text-center mt-2">sBOOKS</p>
                </div>
                <!-- <div class="col-4">
                    <div class="row">
                        <div class="col-8">
                            <input type="text" class="form-control mt-3 border-dark" placeholder="Enter keyword,title or author" />
                        </div>
                        <div class="col-4">
                            <button class="btn btn-danger text-white mt-3 ">Search</button>
                        </div>
                    </div>
                </div> -->
                <div class="col-8">
                    <div class="row">
                        <div class="col-3">
                            <button class="btn btn-light text-dark  border-dark mt-3 mb-1" onclick="window.location.href='signIn.php';">Sign in</button>
                        </div>
                        <div class="col-4">
                            <a class="btn btn-light text-dark  border-dark mt-3 mb-1" href="userProfile.php">My profile</a>
                        </div>
                        <div class="col-4">
                            <a type="button" class="btn btn-light text-dark  border-dark mt-3" href="basket.php"><i class="bi bi-cart3"></i>Basket</a>
                        </div>
                        <div class="col-1">
                            <a class="btn btn-light text-dark  border-dark mt-3" href="help.php">Help</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row py-2">
                <div class="col-3 text-center">
                    <a class="fs-6 text-dark text-decoration-none" href="advancedSearch.php">Advanced search</a>
                </div>
                <div class="col-3 text-start">
                    <a class="fs-6 text-dark text-decoration-none" href="wishlist.php">Wishlist</a>
                </div>
                <div class="col-3 text-start">
                    <a class="fs-6 text-dark text-decoration-none" href="browse.php">Browse collections</a>
                </div>
                <div class="col-2 text-start">
                    <a class="fs-6 text-dark text-decoration-none" href="startSelling.php">Sell</a>
                </div>
                <div class="col-1 text-start">
                    <a class="fs-6 text-dark text-decoration-none"href="myPurchases.php">My Purchases</a>
                </div>
            </div>
            </div>

            <!-- large -->
            <!-- small -->
            <div class="row d-block d-lg-none shadow">
                
            <div class="row mt-2">
                <div class="col-6 mt-2">
                    <p class="fs-3 fw-bold text-primary text-center">sBOOKS</p>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-8 text-end">
                            <button class="btn btn-light text-dark  border-dark mt-2 mb-1">Sign in</button>
                        </div>
                        <div class="col-4">
                            <button class="btn btn-light text-dark  border-dark mt-2"><i class="bi bi-cart3"></i></button>
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="row ">
                <div class="col-4 mt-2 mb-2">
                    <button class="btn btn-light border-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <i class="bi bi-list text-danger"></i> &nbsp;Menu
                    </button>
                    <div class="collapse" id="collapseExample">
                        <div class=" col-12">
                            <ul >
                                <li><a class="dropdown-item" href="userProfile.php">My account</a></li>
                                <li><a class="dropdown-item" href="#">My purchases</a></li>
                                <li><a class="dropdown-item" href="advancedSearch.php">Advanced search</a></li>
                                <li><a class="dropdown-item" href="browse.php">Browse collections</a></li>
                                <li><a class="dropdown-item" href="startSelling.php">Sell</a></li>
                                <li><a class="dropdown-item" href="myPurchases.php">My purchases</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-5 mb-3">
                    <input type="text" class="form-control mt-2 border-dark" placeholder="search books.." />
                </div>
                <div class="col-3 mb-3">
                    <button class="btn btn-dark text-white mt-2  border-dark">Search</button>
                </div>
            </div>
            <!-- small -->
            </div>
        </div>

    </div>

    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>