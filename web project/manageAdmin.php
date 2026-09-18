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
    <title>Admin</title>
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
                            $adminA = Database::search("SELECT * FROM `admin` WHERE `status_id`='1'");
                            $adminA_num = $adminA->num_rows;
                            $adminI = Database::search("SELECT * FROM `admin` WHERE `status_id`='2'");
                            $adminI_num = $adminI->num_rows;
                            $admin = Database::search("SELECT * FROM `admin`");
                            $admin_num = $admin->num_rows;
                            ?>
                            <span class="navbar-brand mb-0 h1">All(<?php echo $admin_num?>)</span>
                            <span class="navbar-brand mb-0 h1">Active(<?php echo $adminA_num?>)</span>
                            <span class="navbar-brand mb-0 h1">Inactive(<?php echo $adminI_num?>)</span>
                            <div class="row">
                                <div class="col-9">
                                    <input class="form-control me-2" type="search" placeholder="Admin's first or last name" aria-label="Search" id="name">
                                </div>
                                <div class="col-2">
                                    <button class="btn btn-outline-success" type="submit" onclick="adminSearch();">Search</button>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
                <div class="col-12" id="search_result">
                    <table class="table table-success table-striped">
                        <thead>
                            <tr>
                                <th scope="col" class="text-danger">Email</th>
                                <th scope="col" class="text-danger">First Name</th>
                                <th scope="col" class="text-danger">Last Name</th>
                                <th scope="col" class="text-danger">Mobile</th>
                                <th scope="col" class="text-danger">Joined Date</th>
                                <th scope="col" class="text-danger">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            for($x=0;$x<$admin_num;$x++){
                                $admin_data = $admin->fetch_assoc();
                                $status = Database::search("SELECT * FROM `status` WHERE `id`='".$admin_data["status_id"]."'");
                                $status_data = $status->fetch_assoc();
                                ?>
                                <tr>
                                <th scope="row"><?php echo $admin_data["admin_email"]?></th>
                                <td><?php echo $admin_data["fname"]?></td>
                                <td><?php echo $admin_data["lname"]?></td>
                                <td>0<?php echo $admin_data["mobile"]?></td>
                                <td><?php echo $admin_data["joined_date"]?></td>
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
                                            <h2 class="accordion-header" id="flush-headingThree">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                                    Remove
                                                </button>
                                            </h2>
                                            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                                <div class="mb-3">
                                                    <label for="email2" class="form-label">Email address</label>
                                                    <input type="email" class="form-control" id="email2" placeholder="name@example.com">
                                                </div>
                                                <div class="mb-3">
                                                    <button class="btn btn-outline-success" onclick="removeAdmin();">Update</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingThree">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                                    Invite
                                                </button>
                                            </h2>
                                            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                                <div class="mb-3">
                                                    <label for="email3" class="form-label">Email address</label>
                                                    <input type="email" class="form-control" id="email3" placeholder="name@example.com">
                                                </div>
                                                <div class="mb-3">
                                                    <button class="btn btn-outline-success" onclick="InviteAdmin();">Invite</button>
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