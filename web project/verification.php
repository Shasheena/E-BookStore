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

<body style="background-image: linear-gradient(to bottom, #33ccff, white);">
    <div class="container-fluid vh-100 d-flex justify-content-center">
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
                                        <a class="nav-link active" aria-current="page" href="verification.php">Join</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="newAccount.php">Create Account</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="row  text-center">
                                <p class="fs-2 text-dark text-decoration-underline">Sending the verification code</p>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="email" placeholder="name@example.com">
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary" onclick="sendUserVerification();">Send</button>
                                </div>
                            </div>
                            <div class="col-12">
                                <hr />
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