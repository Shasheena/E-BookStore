<?php
require "connection.php";
$name = $_GET["n"];

$user  = Database::search("SELECT * FROM `user` WHERE `fname` LIKE '%" . $name . "%' OR `lname` LIKE '%" . $name . "%'");
$user_num = $user->num_rows;

if ($user_num> 0) {
?>
    <table class="table table-primary table-striped">
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
            for ($x = 0; $x < $user_num; $x++) {
                $user_data = $user->fetch_assoc();
                $status = Database::search("SELECT * FROM `status` WHERE `id`='" . $user_data["status_id"] . "'");
                $status_data = $status->fetch_assoc();
            ?>
                <tr>
                    <th scope="row"><?php echo $user_data["email"] ?></th>
                    <td><?php echo $user_data["fname"] ?></td>
                    <td><?php echo $user_data["lname"] ?></td>
                    <td>0<?php echo $user_data["mobile"] ?></td>
                    <td><?php echo $user_data["joined_date"] ?></td>
                    <td><?php echo $user_data["name"] ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <div class="mb-3">
        <a href="manageUsers.php" class="btn btn-outline-secondary btn-sm">All</a>
    </div>

<?php

    // echo("have");
} else {
    echo ("no results found");
}
// echo($name);
?>