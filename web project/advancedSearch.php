<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />

    <title>sBOOKS | Advanced search</title>
</head>

<body>
    <div class="row">
        <?php include "header.php"; ?>
    </div>
    <div class="row">
        <div class="col-12  mt-4 text-center">
            <label class="form-label fs-3" style="font-family: Arial;">Advanced Search</label>
        </div>
        <div class="col-12 mt-2 text-center">
            <label class="form-label fs-6" style="font-family: Arial;">Enter at least one of author, title, keyword, or publisher to search.</label>
        </div>
        <div class="col-12 text-center">
            <a type="text" class=" text-decoration-none text-dark fs-5" style="font-family: Arial;" href="#"><i class="bi bi-gear fs-4"></i>Search Preferences</label>
        </div>
    </div>
    <div class="row  d-flex justify-content-center  mt-3">
        <div class="card col-12  mb-5" style="width: 75%; background-color:aliceblue; border-radius:10px;">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-2 text-center">
                        <label class="form-label">Author</label>
                    </div>
                    <div class="col-12 col-lg-8">
                        <input type="text" class="form-control" />
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 col-lg-2 text-center">
                        <label class="form-label">Title</label>
                    </div>
                    <div class="col-12 col-lg-8">
                        <input type="text" class="form-control" />
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 col-lg-2 text-center">
                        <label class="form-label">Keywords</label>
                    </div>
                    <div class="col-12 col-lg-8">
                        <input type="text" class="form-control" />
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 col-lg-2 text-center">
                        <label class="form-label">Publisher</label>
                    </div>
                    <div class="col-12 col-lg-8">
                        <input type="text" class="form-control" />
                    </div>
                </div>
                <div class="row  mt-3">
                    <div class="col-12 col-lg-2 text-center">
                        <label class="form-label">Published date</label>
                    </div>
                    <div class="col-12 col-lg-8">
                        <div class="row">
                            <div class="col-lg-4 col-12">
                                <div class="row">
                                    <div class="col-lg-4 col-6">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">From</span>
                                    </div>
                                    <div class="col-lg-8 col-12 mt-1 mt-lg-0">
                                        <input type="date" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-12 mt-3 mt-lg-0">
                                <div class="row">
                                    <div class="col-lg-3 col-6">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">To</span>
                                    </div>
                                    <div class="col-lg-9 col-12 mt-1 mt-lg-0">
                                        <input type="date" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row  mt-3">
                    <div class="col-12 col-lg-2 text-center">
                        <label class="form-label">Price</label>
                    </div>
                    <div class="col-12 col-lg-8">
                        <div class="row">
                            <div class="col-lg-4 col-12">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">min</span>
                                    <span class="input-group-text">Rs.</span>
                                    <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
                                </div>
                            </div>
                            <div class="col-lg-4 col-12">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">max</span>
                                    <span class="input-group-text">Rs.</span>
                                    <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row  mt-3">
                    <div class="col-12 col-lg-2 text-center">
                        <label class="form-label">Product type</label>
                    </div>
                    <div class="col-12 col-lg-8">
                        <select class="form-select">
                            <option>Art & collections</option>
                            <option>Fiction</option>
                            <option>Non-Fiction</option>
                        </select>
                    </div>
                </div>
                <hr />
                <div class="row  mt-3">
                    <div class="col-12 col-lg-2 text-center">
                        <label class="form-label">Condition</label>
                    </div>
                    <div class="col-12 col-lg-8">
                        <div class="row border">
                            <div class="form-check col-12 col-lg-2">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label fs-6" for="flexRadioDefault1">
                                    Any
                                </label>
                            </div>
                            <div class="form-check col-12 col-lg-2">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label fs-6" for="flexRadioDefault1">
                                    New
                                </label>
                            </div>
                            <div class="form-check col-12 col-lg-2">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label fs-6" for="flexRadioDefault1">
                                    Used
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row  mt-3">
                    <div class="col-12 col-lg-2 text-center">
                        <label class="form-label">Binding</label>
                    </div>
                    <div class="col-12 col-lg-8">
                        <div class="row border">
                            <div class="form-check col-12 col-lg-2">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label fs-6" for="flexRadioDefault1">
                                    Any
                                </label>
                            </div>
                            <div class="form-check col-12 col-lg-2">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label fs-6" for="flexRadioDefault1">
                                    Hardcover
                                </label>
                            </div>
                            <div class="form-check col-12 col-lg-2">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label fs-6" for="flexRadioDefault1">
                                    Softcover
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 col-lg-2 text-center">
                        <label class="form-label">Sort By</label>
                    </div>
                    <div class="col-12 col-lg-8">
                        <div class="row border">
                            <div class="form-check col-lg-4 col-12">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label fs-6" for="flexRadioDefault1">
                                    Author/A-Z
                                </label>
                            </div>
                            <div class="form-check col-lg-4 col-12">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label fs-6" for="flexRadioDefault1">
                                    Author/Z-A
                                </label>
                            </div>
                            <div class="form-check col-4  col-lg-4 col-12">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label fs-6" for="flexRadioDefault1">
                                    Title/A-Z
                                </label>
                            </div>
                            <div class="form-check  col-lg-4 col-12">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label fs-6" for="flexRadioDefault1">
                                    Title/Z-A
                                </label>
                            </div>
                            <div class="form-check  col-lg-4 col-12">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label fs-6" for="flexRadioDefault1">
                                   Highest price
                                </label>
                            </div>
                            <div class="form-check  col-lg-4 col-12">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label fs-6" for="flexRadioDefault1">
                                    Lowest price
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <a type="button" class="btn btn-danger" href="singleView.php">Search</a>
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