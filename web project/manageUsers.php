<?php
require "connection.php";
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <title>Users</title>
</head>

<?php
if (isset($_SESSION["admin"])) {
?>

    <body>
        <div class="container-fluid vh-100">
            <div class="row">
                <div class="col-12">
                    <nav class="navbar bg-light">
                        <div class="container-fluid">
                            <?php
                            $userA = Database::search("SELECT * FROM `user` WHERE `status_id`='1'");
                            $userA_num = $userA->num_rows;
                            $userI = Database::search("SELECT * FROM `user` WHERE `status_id`='2'");
                            $userI_num = $userI->num_rows;
                            $user = Database::search("SELECT * FROM `user`");
                            $user_num = $user->num_rows;
                            ?>
                            <span class="navbar-brand mb-0 h1">All(<?php echo $user_num?>)</span>
                            <span class="navbar-brand mb-0 h1">Active(<?php echo $userA_num?>)</span>
                            <span class="navbar-brand mb-0 h1">Inactive(<?php echo $userI_num?>)</span>
                            <div class="row">
                                <div class="col-9">
                                    <input class="form-control me-2" type="search" placeholder="User's first or last name" aria-label="Search" id="name">
                                </div>
                                <div class="col-2">
                                    <button class="btn btn-outline-success" type="submit" onclick="userSearch();">Search</button>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
                <div class="col-12" id="search_result">
                    <table class="table table-primary table-striped">
                        <thead>
                            <tr>
                                <th scope="col" class="text-danger">Email</th>
                                <th scope="col" class="text-danger">First Name</th>
                                <th scope="col" class="text-danger">Last Name</th>
                                <th scope="col" class="text-danger">Mobile</th>
                                <th scope="col" class="text-danger">Joined Date</th>
                                <th scope="col" class="text-danger">Address</th>
                                <th scope="col" class="text-danger">City</th>
                                <th scope="col" class="text-danger">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            for($x=0;$x<$user_num;$x++){
                                $user_data = $user->fetch_assoc();
                                $status = Database::search("SELECT * FROM `status` WHERE `id`='".$user_data["status_id"]."'");
                                $status_data = $status->fetch_assoc();
                                $address_rs = Database::search("SELECT * FROM `address` WHERE `user_email`='".$user_data["email"]."'");
                                $address_data = $address_rs->fetch_assoc();
                                $city_rs = Database::search("SELECT * FROM `city` WHERE `city_id`='".$address_data["ci_id"]."'");
                                $city_data = $city_rs->fetch_assoc();
                                ?>
                                <tr>
                                <th scope="row"><?php echo $user_data["email"]?></th>
                                <td><?php echo $user_data["fname"]?></td>
                                <td><?php echo $user_data["lname"]?></td>
                                <td>0<?php echo $user_data["mobile"]?></td>
                                <td><?php echo $user_data["joined_date"]?></td>
                                <td><?php echo $address_data["line1"]?>,<?php echo $address_data["line2"]?></td>
                                <td><?php echo $city_data["city_name"]?></td>
                                <td><?php echo $status_data["name"]?></td>
                            </tr>
                                <?php
                            }
                            ?>                     
                        </tbody>
                    </table>
                </div>
                <div class="col-12 d-flex justify-content-start align-items-center">
                    <div></div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingOne">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                    Remove
                                                </button>
                                            </h2>
                                            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                <div class="mb-3">
                                                    <label for="email1" class="form-label">Email address</label>
                                                    <input type="email" class="form-control" id="email1" placeholder="name@example.com">
                                                </div>
                                                <div class="mb-3">
                                                    <button class="btn btn-outline-success" onclick="removeUser();">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingTwo">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                                    Invite
                                                </button>
                                            </h2>
                                            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                                <div class="mb-3">
                                                    <label for="email2" class="form-label">Email address</label>
                                                    <input type="email" class="form-control" id="email2" placeholder="name@example.com">
                                                </div>
                                                <div class="mb-3">
                                                    <button class="btn btn-outline-success" onclick="InviteUser();">Invite</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingThree">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                                    Block user
                                                </button>
                                            </h2>
                                            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                                <div class="mb-3">
                                                    <label for="email3" class="form-label">Email address</label>
                                                    <input type="email" class="form-control" id="email3" placeholder="name@example.com">
                                                </div>
                                                <div class="mb-3">
                                                    <button class="btn btn-outline-success" onclick="inactivateAdmin();">Block</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingFour">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                                    Unlock user
                                                </button>
                                            </h2>
                                            <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                                                <div class="mb-3">
                                                    <label for="email4" class="form-label">Email address</label>
                                                    <input type="email" class="form-control" id="email4" placeholder="name@example.com">
                                                </div>
                                                <div class="mb-3">
                                                    <button class="btn btn-outline-success" onclick="activateAdmin();">Unblock</button>
                                                </div>
                                            </div>
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
        <script src="bootstrap.bundle.js"></script>
    </body>
<?php
} else {
    echo ("Sign in first!");
}
?>

</html>