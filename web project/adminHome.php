<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <title>Home</title>
</head>

<?php
if (isset($_SESSION["admin"])) {
?>

    <body>
        <div class="container-fluid vh-100">
            <div class="row">
                <div class="col-12 adminHome" style="height: 200px;">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="row mt-5">
                                <div class="col-4" style="color: red;border-radius:100%;height: 30px;width:30px;">
                                    <?php if (isset($_SESSION["admin"]["images"])) {
                                    ?>
                                        <img src="<?php echo $_SESSION["admin"]["images"] ?>" style="height: 100px;width:100px;border-radius:100%;" />
                                    <?php
                                    } else {
                                    ?>
                                        <img src="resources/emptyUser.png" style="height: 100px;width:100px;border-radius:100%;" />
                                    <?php
                                    } ?>

                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row mt-5">
                                <div class="col-12">
                                    <?php if (isset($_SESSION["admin"]["lname"])) {
                                    ?>
                                        <label class="fw-bold fs-4"><?php echo $_SESSION["admin"]["fname"] ?>&nbsp;<?php echo $_SESSION["admin"]["lname"] ?></label>
                                    <?php
                                    } else {
                                    ?>
                                        <label class="fw-bold fs-4"><?php echo $_SESSION["admin"]["fname"] ?></label>
                                    <?php
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-12 mt-3 mb-3">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="adminHome.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="adminProfile.php">My Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="manageAdmin.php">Manage Admin</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="manageProducts.php">Manage Products</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="addProducts.php">Add Products</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>
    </body>

<?php
} else {
    echo ("Sign in first!!");
}
?>



</html>