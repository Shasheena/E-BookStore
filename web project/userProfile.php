<?php
session_start();
require "connection.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <title> Student Profile</title>
</head>

<body>
    <div class="container-fluid vh-100" style="background-color: #f0ffff;">
        <div class="row">
            <div class="col-12 bg-gradient shadow-lg text-center">
                <h1 class="fw-bold p-3">My Profile</h1>
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-6 text-start">
                            <a class="text-danger text-decoration-underline" href="index.php">Home</a>
                            </div>
                            <div class="col-6 text-start">
                                <a class="text-danger text-decoration-underline" href="signIn.php">Sign In</a>
                            </div>
                        </div>                       
                    </div>
                </div>
            </div>
        </div>

        <?php 
        $user_rs = Database::search("SELECT * FROM `user` WHERE `email` = '".$_SESSION["user"]["email"]."'");
        $user_data = $user_rs->fetch_assoc();

        $address_rs = Database::search("SELECT * FROM `address` WHERE `user_email` = '".$user_data["email"]."'");
        $address_data = $address_rs->fetch_assoc();

       
        ?>

        <!-- profile -->
        <div class="row mt-5">
            <div class="col-12" style="background-color: #C0C0C0;">
                <div class="row">
                    <div class="col-12 col-lg-5 offset-lg-4 mt-5 mb-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 mt-3">
                                        <label class="fs-4 fw-bold">First name</label>
                                        <input type="text" class="form-control"  readonly value="<?php echo $user_data["fname"]; ?>" />
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label class="fs-4 fw-bold">Last name</label>
                                        <input type="text" class="form-control"  readonly value="<?php echo $user_data["lname"]; ?>" />
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label class="fs-4 fw-bold">Email</label>
                                        <input type="email" class="form-control" readonly  value="<?php echo $user_data["email"]; ?>" id="email" />
                                    </div>
                                    <div class="col-12 mt-3 mb-3">
                                        <label class="fs-4 fw-bold">Password</label>
                                        <input type="password" class="form-control" readonly value="<?php echo $user_data["password"]; ?>" />
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label class="fs-4 fw-bold">Address line 1</label>
                                        <input type="text" class="form-control" id="line1" value="<?php echo $address_data["line1"]; ?>" />
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label class="fs-4 fw-bold">Address line 2</label>
                                        <input type="text" class="form-control" id="line2" value="<?php echo $address_data["line2"]; ?>" />
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label class="fs-4 fw-bold">Postal code</label>
                                        <input type="text" class="form-control" id="pcode" value="<?php echo $address_data["postal_code"]; ?>" />
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label class="fs-4 fw-bold">Mobile</label>
                                        <input type="text" class="form-control" id="mb" value="<?php echo $user_data["mobile"]; ?>" />
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label class="fs-4 fw-bold">City</label>
                                        <?php 
                                        $city = Database::search("SELECT * FROM `city` WHERE `city_id` = '".$address_data["ci_id"]."'");
                                        $city_data1 = $city->fetch_assoc();

                                        $city_rs = Database::search("SELECT * FROM `city`");
                                        ?>
                                        <select class="form-select" id="city">
                                            <option value="0"><?php echo $city_data1["city_name"]?></option>
                                            <?php 
                                            $city_num = $city_rs->num_rows;
                                            for($x=0;$x<$city_num;$x++){
                                                $city_data = $city_rs->fetch_assoc();
                                                
                                                ?>
                                                <option value="<?php echo $city_data["city_id"]?>"><?php echo $city_data["city_name"]?></option>
                                                <?php
                                            }
                                            ?>
                                            
                                        </select>
                                    </div>
                                    <div class="col-12 mt-3 mb-3 text-center">
                                        <button class="btn btn-danger fs-3" onclick="updatingUser();">Update Profile</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include "footer.php";?>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>