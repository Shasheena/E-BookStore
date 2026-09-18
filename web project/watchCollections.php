<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />

    <title>sBOOKS | Watch collections</title>
</head>

<body>
    <div class="row">
        <?php include "header.php"; ?>
    </div>
    <hr />
    <div class="container-fluid d-flex 100vh">
        <div class="col-12">
            <div class="row">
                <div class="col-2 shadow">
                    <div class="row">
                        <div class="col-12 mb-2">
                            <a type="text" class="text-decoration-none text-secondary" href="browse.php"><i class="bi bi-house-door-fill text-danger"></i>&nbsp;Browse collections</a>
                        </div>
                        <hr />
                        <div class="col-12 shadow bg-light mb-3">
                            <div class="input-group mb-3 mt-3">
                                <input type="text" class="form-control" placeholder="search.." aria-label="Recipient's username" aria-describedby="button-addon2">
                                <button class="btn btn-outline-secondary bg-dark" type="button" id="button-addon2"><i class="bi bi-search text-light"></i></button>
                            </div>
                        </div>
                        <hr />
                        <div class="col-12  mb-2">
                            <label class="form-label">Art & collectibles</label>
                            <div class="row text-start mt-3">
                                <a type="text" class="text-secondary text-decoration-none" href="#">Fine art</a><br /><br />
                                <a type="text" class="text-secondary text-decoration-none" href="#">Comic books</a><br /><br />
                                <a type="text" class="text-secondary text-decoration-none" href="#">Graphic novels</a><br /><br />
                                <a type="text" class="text-secondary text-decoration-none" href="#">Photography</a><br />
                            </div>
                        </div>
                        <hr />
                        <div class="col-12  mb-2">
                            <label class="form-label">Fiction</label>
                            <div class="row text-start mt-3">
                                <a type="text" class="text-secondary text-decoration-none" href="#">Crime fiction & mysterious</a><br /><br />
                                <a type="text" class="text-secondary text-decoration-none" href="#">Children</a><br /><br />
                                <a type="text" class="text-secondary text-decoration-none" href="#">Horror</a><br /><br />
                                <a type="text" class="text-secondary text-decoration-none" href="#">Science fiction</a><br /><br />
                                <a type="text" class="text-secondary text-decoration-none" href="#">Literature</a><br /><br />
                                <a type="text" class="text-secondary text-decoration-none" href="#">Romance</a><br />
                            </div>
                        </div>
                        <hr />
                        <div class="col-12 mb-2">
                            <label class="form-label">Non-Fiction</label>
                            <div class="row text-start mt-3">
                                <a type="text" class="text-secondary text-decoration-none" href="#">Arts & photography</a><br /><br />
                                <a type="text" class="text-secondary text-decoration-none" href="#">Biographies</a><br /><br />
                                <a type="text" class="text-secondary text-decoration-none" href="#">Domestic</a><br /><br />
                                <a type="text" class="text-secondary text-decoration-none" href="#">Educational</a><br /><br />
                                <a type="text" class="text-secondary text-decoration-none" href="#">Self-help</a><br /><br />
                                <a type="text" class="text-secondary text-decoration-none" href="#">Spirituality</a><br />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-10">
                    <div class="row text-start">
                        <div class="col-1">
                            <label class="text-dark">Sort by -></label>
                        </div>
                        <div class="col-6">
                        <button class="btn btn-light btn-sm border-dark">Lowest price</button>
                        <button class="btn btn-light btn-sm border-dark"> Highest price</button>
                        </div>                     
                    </div>
                    <!-- row1-->
                    <div class="row text-start">
                        <a type="text" class="text-dark fs-2 text-decoration-none" href="watchCollections.php">Fine art</a>
                    </div>
                    <div class="row mt-3 mb-2">
                        <div class="col-3 mt-3">
                            <div class="card" style="width: 18rem;">
                                <img src="resources/biographies.webp" class="card-img-top">
                                <div class="card-body">
                                    <a type="text" class="card-title text-danger text-decoration-none" href="singleView.php">Card title</h5>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 mt-3">
                            <div class="card" style="width: 18rem;">
                                <img src="resources/biographies.webp" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 mt-3">
                            <div class="card" style="width: 18rem;">
                                <img src="resources/biographies.webp" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 mt-3">
                            <div class="card" style="width: 18rem;">
                                <img src="resources/biographies.webp" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                        <!-- row 2 -->
                        <div class="row text-start mt-4">
                            <a type="text" class="text-dark fs-2 text-decoration-none" href="#">Comic books</a>
                        </div>
                        <div class="col-3 mt-3">
                            <div class="card" style="width: 18rem;">
                                <img src="resources/biographies.webp" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 mt-3">
                            <div class="card" style="width: 18rem;">
                                <img src="resources/biographies.webp" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 mt-3">
                            <div class="card" style="width: 18rem;">
                                <img src="resources/biographies.webp" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 mt-3">
                            <div class="card" style="width: 18rem;">
                                <img src="resources/biographies.webp" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                        <!-- row3-->
                        <div class="row text-start mt-4">
                            <a type="text" class="text-dark fs-2 text-decoration-none" href="#">Graphic novels</a>
                        </div>
                        <div class="col-3 mt-3">
                            <div class="card" style="width: 18rem;">
                                <img src="resources/biographies.webp" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 mt-3">
                            <div class="card" style="width: 18rem;">
                                <img src="resources/biographies.webp" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 mt-3">
                            <div class="card" style="width: 18rem;">
                                <img src="resources/biographies.webp" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 mt-3">
                            <div class="card" style="width: 18rem;">
                                <img src="resources/biographies.webp" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
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

    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>