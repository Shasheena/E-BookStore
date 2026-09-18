<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <title>Join</title>
</head>

<body>
    <div class="container-fluid vh-100">
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="card mt-5 border-0 shadow">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <h2 class="fw-bold text-info">sBooks</h2>
                                </div>
                                <div class="col-12 mt-5">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link active" aria-current="page" href="adminJoin.php">Join</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="adminSignUp.php">Sign Up</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="adminSignIn.php">Sign In</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-12 mt-5">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email address</label>
                                        <input type="email" class="form-control" id="email" placeholder="name@example.com">
                                    </div>
                                    <div class="mb-4 text-center">
                                        <button class="btn btn-outline-info" onclick="adminSendingEmail();">Send</button>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 text-center text-danger">
                                            <label>Welcome!</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12 text-center">
                            <label>sBooks&trade;</label><br />
                            <label>All rights reserved&copy;</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block adminSignup" style="background-color: green;"></div>
            </div>
        </div>
    </div>
    <!-- forgot password modal -->
    <div class="modal" tabindex="-1" id="fpmd2">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Setting up a new password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="vc" class="form-label">Verification Code</label>
                        <input type="text" class="form-control" id="vc" placeholder="Enter the verification code sent by the email">
                    </div>
                    <div class="mb-4">
                        <label for="p" class="form-label">Suggest a new Password</label>
                        <input type="password" class="form-control" id="p" placeholder="Paasword should have at least 6 characters..">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="adminNewPassword2();">Add new password</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" id="fpmd1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Sending the Verifivation <code></code></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="e1" placeholder="name@example.com">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="adminNewPassword1();">Add new password</button>
                </div>
            </div>
        </div>
    </div>
    <!-- forgot password modal -->
    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>