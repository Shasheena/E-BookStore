<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <title>Start Selling</title>
</head>

<body>
    <div class="container-fluid vh-100">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-6 mb-5 shadow">
                <div class="card mt-5 mb-2 shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <h1 class="text-primary">sBooks</h1>
                            </div>
                            <div class="col-12 mb-3 text-center">
                                <label class="text-uppercase">New to sBooks?&nbsp;<a href="newAccount.php">sign In first</a></label>
                            </div>
                            <div class="col-12 mb-3 text-center">
                                <label class="text-uppercase">Already a user? sign in here to be a seller!</label>
                            </div>
                            <?php 
                                    
                                    $email = "";
                                    $password = "";
                                    if(isset($_COOKIE["email"])){
                                        $email = $_COOKIE["email"];
                                    }
                                    if(isset($_COOKIE["password"])){
                                        $password = $_COOKIE["password"];
                                    }
                                    
                                    ?>
                            <div class="col-12 mb-3">
                                <div class="mb-3">
                                    <label for="email" class="form-label">User Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="name@example.com" value="<?php echo $email?>">
                                </div>
                                <label for="pwd" class="form-label">Password</label>
                                <div class=" input-group mb-3">
                                    <input type="password" class="form-control" id="pwd" placeholder="Enter your user password" value="<?php echo $password?>">
                                    <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="toggleButton();"><i class="bi bi-eye"></i></button>
                                </div>
                            </div>
                            <div class="mb-3 text-end">
                                <a href="signIn.php">Forgot password?</a>
                            </div>
                            <div class="mb-3 text-start">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="rmb">
                                    <label class="form-check-label" for="rmb">
                                        Keep me signed in
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3 text-center">
                                <button class="btn btn-outline-dark" onclick="sellerSignIn();">Start selling</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <?php include "footer.php" ?>
        </div>
    </div>
    </div>
    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>