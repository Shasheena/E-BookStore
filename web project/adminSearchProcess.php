<?php
require "connection.php";
$name = $_GET["n"];

$admin  = Database::search("SELECT * FROM `admin` WHERE `fname` LIKE '%" . $name . "%' OR `lname` LIKE '%" . $name . "%'");
$admin_num = $admin->num_rows;

if ($admin_num > 0) {
?>
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
            for ($x = 0; $x < $admin_num; $x++) {
                $admin_data = $admin->fetch_assoc();
                $status = Database::search("SELECT * FROM `status` WHERE `id`='" . $admin_data["status_id"] . "'");
                $status_data = $status->fetch_assoc();
            ?>
                <tr>
                    <th scope="row"><?php echo $admin_data["admin_email"] ?></th>
                    <td><?php echo $admin_data["fname"] ?></td>
                    <td><?php echo $admin_data["lname"] ?></td>
                    <td>0<?php echo $admin_data["mobile"] ?></td>
                    <td><?php echo $admin_data["joined_date"] ?></td>
                    <td><?php echo $status_data["name"] ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <div class="mb-3">
        <a href="manageAdmin.php" class="btn btn-outline-secondary btn-sm">All</a>
    </div>

<?php

    // echo("have");
} else {
    echo ("no results found");
}
// echo($name);
?>