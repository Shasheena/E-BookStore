<?php
require "connection.php";
?>
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
            <label class="form-label fs-6" style="font-family: Arial;">Enter one of author, title or publisher to search.</label>
        </div>
    </div>
    <div class="row  d-flex justify-content-center  mt-3" id="result1">
        <div class="card col-12  mb-5" style="width: 75%; background-color:aliceblue; border-radius:10px;">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-2 text-center">
                        <label class="form-label">Search</label>
                    </div>
                    <div class="col-12 col-lg-8">
                        <input type="text" class="form-control" id="atb" />
                    </div>
                </div>
                <!-- <div class="row  mt-3">
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
                </div> -->
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
                                    <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" id="min_price" value="0">
                                </div>
                            </div>
                            <div class="col-lg-4 col-12">
                                <div class="input-group mb-3">
                                    <span class="input-group-text">max</span>
                                    <span class="input-group-text">Rs.</span>
                                    <input type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)" id="max_price" value="0">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row  mt-3">
                    <div class="col-12 col-lg-2 text-center">
                        <label class="form-label">Sub categories</label>
                    </div>
                    <div class="col-12 col-lg-8">
                        <select class="form-select" id="sct" onchange="loadCategory();">
                            <option value="0">Select a category</option>
                            <?php
                            $category = Database::search("SELECT * FROM `sub_categories`");
                            $category_num = $category->num_rows;
                            for ($y = 0; $y < $category_num; $y++) {
                                $category_data = $category->fetch_assoc();
                            ?>
                                <option value="<?php echo $category_data["id"] ?>"><?php echo $category_data["name"] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row  mt-3">
                    <div class="col-12 col-lg-2 text-center">
                        <label class="form-label">Main categories</label>
                    </div>
                    <div class="col-12 col-lg-8">
                        <select class="form-select" id="mct">
                            <option value="0">Select a category</option>
                            <?php
                            $category = Database::search("SELECT * FROM `main_categories`");
                            $category_num = $category->num_rows;
                            for ($x = 0; $x < $category_num; $x++) {
                                $category_data = $category->fetch_assoc();
                            ?>
                                <option value="<?php echo $category_data["id"] ?>"><?php echo $category_data["name"] ?></option>
                            <?php
                            }
                            ?>
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
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="bnew">
                                    <label class="form-check-label fs-6" for="bnew">
                                        Brand new
                                    </label>
                                </div>
                                <div class="form-check col-12 col-lg-2">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="used">
                                    <label class="form-check-label fs-6" for="used">
                                        Used
                                    </label>
                                </div>
                                <div class="form-check col-12 col-lg-2">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="new">
                                    <label class="form-check-label fs-6" for="new">
                                        New
                                    </label>
                                </div>
                                <div class="form-check col-12 col-lg-2">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="old">
                                    <label class="form-check-label fs-6" for="old">
                                        Old
                                    </label>
                                </div>

                        </div>
                    </div>
                </div>
                <div class="row  mt-3">
                    <div class="col-12 col-lg-2 text-center">
                        <label class="form-label">Copy</label>
                    </div>
                    <div class="col-12 col-lg-8">
                        <div class="row border">
                                <div class="form-check col-12 col-lg-2">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault1" id="hard">
                                    <label class="form-check-label fs-6" for="hard">
                                        Hard
                                    </label>
                                </div>
                                <div class="form-check col-12 col-lg-2">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault1" id="soft">
                                    <label class="form-check-label fs-6" for="soft">
                                        Soft
                                    </label>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="row  mt-3">
                    <div class="col-12 col-lg-2 text-center">
                        <label class="form-label">Cover</label>
                    </div>
                    <div class="col-12 col-lg-8">
                        <div class="row border">
                        
                                <div class="form-check col-12 col-lg-2">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault2" id="hard_cover">
                                    <label class="form-check-label fs-6" for="hard_cover">
                                        Hard
                                    </label>
                                </div>
                                <div class="form-check col-12 col-lg-2">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault2" id="soft_cover">
                                    <label class="form-check-label fs-6" for="soft_cover">
                                        Soft
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
                                <input class="form-check-input" type="radio" name="flexRadioDefault3" id="aaz">
                                <label class="form-check-label fs-6" for="aaz">
                                    Author/A-Z
                                </label>
                            </div>
                            <div class="form-check col-lg-4 col-12">
                                <input class="form-check-input" type="radio" name="flexRadioDefault3" id="aza">
                                <label class="form-check-label fs-6" for="aza">
                                    Author/Z-A
                                </label>
                            </div>
                            <div class="form-check col-4  col-lg-4 col-12">
                                <input class="form-check-input" type="radio" name="flexRadioDefault3" id="taz">
                                <label class="form-check-label fs-6" for="taz">
                                    Title/A-Z
                                </label>
                            </div>
                            <div class="form-check  col-lg-4 col-12">
                                <input class="form-check-input" type="radio" name="flexRadioDefault3" id="tza">
                                <label class="form-check-label fs-6" for="tza">
                                    Title/Z-A
                                </label>
                            </div>
                            <div class="form-check  col-lg-4 col-12">
                                <input class="form-check-input" type="radio" name="flexRadioDefault3" id="htl">
                                <label class="form-check-label fs-6" for="htl">
                                    Highest price
                                </label>
                            </div>
                            <div class="form-check  col-lg-4 col-12">
                                <input class="form-check-input" type="radio" name="flexRadioDefault3" id="lth">
                                <label class="form-check-label fs-6" for="lth">
                                    Lowest price
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <button class="btn btn-danger" onclick="advancedSearch();">Search</button>
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