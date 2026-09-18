<?php
session_start();
require "connection.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <title> Admin Profile</title>
</head>

<body>
    <div class="container-fluid vh-100" style="background-color: #f0ffff;">
        <div class="row">
            <div class="col-12 bg-gradient shadow-lg text-center">
                <h1 class="fw-bold p-3">My Profile</h1>
            </div>
        </div>

        <!-- profile -->
        <div class="row mt-5">
            <div class="col-12" style="background-color: #C0C0C0;">
                <div class="row">
                    <div class="col-12 col-lg-5 offset-lg-4 mt-5 mb-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div style="height:100px; width:100px; border-radius:100%" class="mt-3 offset-5" id="photo">

                                            <?php if (empty($_SESSION["admin"]["images"])) {
                                            ?>
                                                <img src="resources/emptyUser.png" style="height:100px; width:100px;border-radius:100%;" />
                                            <?php
                                            } else {
                                            ?>
                                                <img src="<?php echo $_SESSION["admin"]["images"]; ?>" style="height:100px; width:100px;border-radius:100%;" />
                                            <?php
                                            } ?>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <div class="input-group mb-3">
                                            <button class="btn btn-secondary" type="button" onclick="updateAdminImage();">Update Profile picture</button>
                                            <button class="btn btn-danger" type="button" onclick="removeAdminImage();">Remove</button>
                                            <input type="file" class="form-control" id="aImage" aria-describedby="inputGroupFileAddon03" aria-label="Upload">
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label class="fs-4 fw-bold">First name</label>
                                        <input type="text" class="form-control" placeholder="Enter your first name...." readonly value="<?php echo $_SESSION["admin"]["fname"]; ?>" />
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label class="fs-4 fw-bold">Last name</label>
                                        <input type="text" class="form-control" placeholder="Enter your last name...." readonly value="<?php echo $_SESSION["admin"]["lname"]; ?>" />
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label class="fs-4 fw-bold">Email</label>
                                        <input type="email" class="form-control" readonly placeholder="name@example.com" value="<?php echo $_SESSION["admin"]["admin_email"]; ?>" />
                                    </div>
                                    <div class="input-group  mt-3 d-none" id="alertDiv">
                                        <label id="alert" class="text-danger" ></label>
                                    </div>
                                    <div class="col-12 mt-3" id="phone">
                                        <label class="fs-4 fw-bold">Mobile</label>
                                        <input type="text" class="form-control" value="<?php echo $_SESSION["admin"]["mobile"]; ?>" id="mobile" />
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label class="fs-4 fw-bold">Password</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" aria-describedby="button-addon2" value="<?php echo $_SESSION["admin"]["password"]; ?>" id="pwd">
                                            <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="toggleButton();"><i class="bi bi-eye"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3 mb-3 text-center" id="update">
                                        <button class="btn btn-danger fs-3" onclick="updatingAdmin();">Update Profile</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>