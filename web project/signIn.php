<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />

    <title>sBOOKS | Sign in</title>
</head>

<body style="background-image: linear-gradient(to bottom, #33ccff, white);">
    <div class="container-fluid vh-100 d-flex justify-content-center">
        <div class="row">
            <div class="col-12 text-center mt-5">
                <p class="fs-1 fw-bold text-primary text-center mt-1">sBOOKS</p>
            </div>
            <div class="col-12 text-center mt-3">
                <div class="row">
                    <div class="card  border border-dark bg-light">
                        <div class="card-body">
                            <div class="col-12 text-center">
                                <p class="fs-2 text-dark text-decoration-underline">Sign In</p>
                            </div>
                            <?php

                            $email = "";
                            $password = "";
                            if (isset($_COOKIE["email"])) {
                                $email = $_COOKIE["email"];
                            }
                            if (isset($_COOKIE["password"])) {
                                $password = $_COOKIE["password"];
                            }

                            ?>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="email" placeholder="name@example.com" value="<?php echo $email ?>">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="pw" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="pw" placeholder="" value="<?php echo $password ?>">
                                </div>
                            </div>
                            <div class=" col-12 text-end">
                                <button class="text-dark" style="font-family: Arial;" onclick="forgotPasswordMd();">Forgot password?</button>
                            </div>
                            <div class="col-12 mt-3">
                                <button class="btn btn-info" onclick="signIn();">Sign In</button>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="form-check text-start">
                                    <input class="form-check-input" type="checkbox" value="" id="rememberMe">
                                    <label class="form-check-label" style="font-family: Arial;" for="rememberMe">
                                        Keep me signed in
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <hr />
                            </div>
                            <div class="col-12 mt-3 text-center">
                                <div class="col-6">
                                    <p class="text-secondary">New to sBOOKS?</p>
                                </div>
                            </div>
                            <div class="col-12 mt-3  mb-5">
                                <a type="button" class="btn btn-secondary" href="newAccount.php">Create a new account</a>
                            </div>
                            <div class="col-12 text-start">
                                <a class="text-dark" style="font-family: Arial;" href="index.php"> go Back</a>
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

    <!-- forgot password modal -->
    <div class="modal" tabindex="-1" id="fpm">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Setting a new password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="e" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="e" placeholder="name@example.com">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="sendCode();">Send the code</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" id="fpm1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Setting a new password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="code" class="form-label">code</label>
                        <input type="text" class="form-control" id="code">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="verifyCode();">Verify and updte</button>
                </div>
            </div>
        </div>
    </div>
    <!-- forgot password modal -->

    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>