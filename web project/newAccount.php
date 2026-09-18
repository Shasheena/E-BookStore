<?php require "connection.php"; ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />

    <title>sBOOKS | Registration</title>
</head>

<body>
    <div class="container-fluid vh-100 d-flex justify-content-center" style="background-image: linear-gradient(to bottom, #33ccff, white);">
        <div class="row">
            <div class="col-12">
                <div class="row text-center mt-5">
                    <p class="fs-1 fw-bold text-light text-center mt-1">sBOOKS</p>
                </div>
            </div>
            <div class="col-12 text-center  mt-3">
                <div class="row">
                    <div class="card  border border-dark bg-light">
                        <div class="card-body">
                            <div class="col-12">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" aria-current="page" href="newAccount.php">Create Account</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="verification.php">Verify</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="row  text-center">
                                <p class="fs-2 text-dark text-decoration-underline">Create a new account</p>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="email" placeholder="name@example.com">
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="mb-3">
                                    <label for="fname" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="fname" placeholder="Enter your name..">
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="mb-3">
                                    <label for="lname" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="lname" placeholder="Enter your name..">
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="mb-3">
                                    <label for="pw" class="form-label">Password</label>
                                    <input type="text" class="form-control" id="pw" placeholder="suggest a suitable password..">
                                </div>
                            </div>
                            <div class="col-12 text-start">
                                <p class="text-dark" style="font-family: Arial;">Password must contain at least 6 characters.</p>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="mb-3">
                                    <label class="form-label">Address</label>
                                    <input type="text" class="form-control" id="line1" placeholder="line1">
                                    <input type="text" class="form-control" id="line2" placeholder="line2">
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="mb-3">
                                    <label for="pc" class="form-label">Postal code</label>
                                    <input type="text" class="form-control" id="pc" placeholder="Enter your postal code..">
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="mb-3">
                                    <label for="mobile" class="form-label">Mobile</label>
                                    <input type="text" class="form-control" id="mobile" placeholder="Enter your mobile number..">
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="mb-3">
                                    <label for="vc" class="form-label">Verification code</label>
                                    <input type="text" class="form-control" id="vc" placeholder="Enter the verification code sent by email after verifying your email..">
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="mb-3">
                                    <label class="form-label">City</label>
                                    <?php
                                    $city_rs = Database::search("SELECT * FROM `city`");
                                    $city_num = $city_rs->num_rows;
                                    ?>
                                    <select class="form-select" id="city">
                                        <?php
                                        for ($x = 0; $x < $city_num; $x++) {
                                            $city_data = $city_rs->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $city_data["city_id"] ?>"><?php echo $city_data["city_name"] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12">
                                <hr />
                            </div>

                            <div class="col-12 mt-3 mb-5">
                                <button class="btn btn-secondary" onclick="newAccount();">Create a new account</button>
                            </div>
                            <div class="col-12 text-start">
                                <a class="text-dark" style="font-family: Arial;" href="signIn.php">Already have an account?sign in</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-12 mt-5">
                <footer>
                    <div class="pt-4 bg-light pb-4">
                        <div class="row">
                            <div class="col-12 text-center mt-3">
                                <p class="fs-3 fw-bold text-primary text-center mt-2">sBOOKS</p>
                            </div>

                            <div class="col-12 text-center mt-3">
                                <p> &copy; 2023 sBOOKS All Rights Reserved.</p>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

    </div>





    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>