<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <title>Sign Up</title>
</head>

<body>
    <div class="container-fluid vh-100">
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="card my-4 border-0 shadow">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <h2 class="fw-bold text-info">sBooks</h2>
                                </div>
                                <div class="col-12 mt-5">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link active" aria-current="page" href="adminSignUp.php">Sign Up</a>
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
                                    <div class="mb-3">
                                        <label for="fname" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="fname" placeholder="Enter your name..">
                                    </div>
                                    <div class="mb-3">
                                        <label for="lname" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="lname" placeholder="Enter your name..">
                                    </div>
                                    <div class="mb-3">
                                        <label for="pwd" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="pwd" placeholder="Password should have at least 6 characters">
                                    </div>
                                    <div class="mb-3">
                                        <label for="mb" class="form-label">Mobile</label>
                                        <input type="text" class="form-control" id="mb" placeholder="Enter your mobile..">
                                    </div>
                                    <div class="mb-3">
                                        <label for="vc" class="form-label">Verificaion Code</label>
                                        <input type="text" class="form-control" id="vc" placeholder="Enter the verification code..">
                                    </div>
                                    <div class="mb-3 text-center">
                                        <button class="btn btn-outline-danger fs-4" onclick="adminSignUp();">Sign up</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-3 text-center">
                        <label class="fw-bold">sBooks&trade;</label><br/>
                        <label>All rights reserved&copy;</label>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block adminSignup" style="background-color: green;"></div>     
            </div>
        </div>
    </div>
    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>