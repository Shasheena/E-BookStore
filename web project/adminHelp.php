<?php
require "connection.php";
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />

    <title>sBOOKS | Help</title>
</head>

<body>
    <script>
        // window.onload = function(){
        //     setTimeout("location.reload(true);",5000);

        // }
    </script>
    <div class="container-fluid vh-100">
        <?php
        if (isset($_SESSION["admin"])) {
            
        ?>
            <div class="col-12 text-center fw-bold mt-3 mb-3">
                <h3>Chat center</h3>
            </div>
            <div class="col-12 mb-5">
                <div class="row">
                    <div class="col-lg-6 chatImg2">
                        <div class="card mt-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div id="u_info">
                                            <?php
                                            if (isset($_SESSION["chat_user"])) {

                                            ?>
                                                <label><?php echo $_SESSION["chat_user"]["fname"] ?>&nbsp;<?php echo $_SESSION["chat_user"]["lname"] ?></label><br />
                                                <label id="u_email"><?php echo $_SESSION["chat_user"]["email"] ?></label>


                                            <?php
                                            } else {
                                            ?>

                                                <label>Not seleted a user</label>
                                                <label id="u_email"></label>
                                            <?php
                                            }
                                            ?>

                                        </div>
                                    </div>
                                    <div class="col-6 text-start">
                                        <p>
                                            <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample1">
                                                Choose a user
                                            </a>
                                            <!-- <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                            Button with data-bs-target
                                        </button> -->
                                        </p>
                                        <div class="collapse" id="collapseExample1">
                                            <div class="card card-body">
                                                <?php
                                                $user = Database::search("SELECT DISTINCT `user`.`fname`, `user`.`lname`, `user`.`email` FROM `chat` INNER JOIN `user` ON `user`.`email`=`chat`.`from` WHERE `to`='" . $_SESSION["admin"]["admin_email"] . "'");
                                                $user_num = $user->num_rows;
                                                for ($a = 0; $a < $user_num; $a++) {
                                                    $user_data = $user->fetch_assoc();
                                                    $user_email = $user_data["email"];
                                                ?>
                                                    <button class="btn btn-secondary mt-3 mb-3" onclick="loadUser(<?php echo $a ?>);" id="user<?php echo $a ?>"><?php echo $user_data["fname"] ?> <?php echo $user_data["lname"] ?></button>
                                                    <label id="uemail<?php echo $a ?>"><?php echo $user_email ?></label>
                                                    <br />
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-5 border-0 shadow">
                            <div class="card-body">
                                <div class="row">
                                    <?php
                                    if (isset($_SESSION["chat_user"])) {
                                        $msg = Database::search("SELECT * FROM `chat` WHERE `from`='" . $_SESSION["chat_user"]["email"] . "' AND `to`='" . $_SESSION["admin"]["admin_email"] . "' ORDER BY `date_time` DESC");
                                        $msg_num = $msg->num_rows;
                                        
                                        if ($msg_num != 0) {
                                            ?>
                                            <?php
                                            for ($z = 0; $z < $msg_num; $z++) {
                                                $msg_data = $msg->fetch_assoc();
                                    ?>
                                                <div class="col-12 d-flex justify-content-start mt-3 mb-3">
                                                    <!-- <div></div> -->
                                                    <div class="card" style="background-color: lightgreen;">
                                                        <div class="card-body">
                                                            <label><?php echo $msg_data["content"] ?></label>
                                                        </div>
                                                    </div>
                                                    <div></div>
                                                </div>
                                                
                                    <?php

                                            }
                                            
                                        }
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 chatImg1 ">
                        <div class="row">
                            <div class="input-group mb-3 mt-3">
                                <input type="text" class="form-control" id="msg" aria-describedby="emailHelp" />
                                <button class="btn btn-success" type="button" id="emailHelp" onclick="sendAdminMsg();">Send</button>
                            </div>

                            <!-- <div></div> -->
                            <?php
                            if (isset($_SESSION["chat_user"])) {
                                $msg = Database::search("SELECT * FROM `chat` WHERE `from`='" . $_SESSION["admin"]["admin_email"] . "' AND `to`='" . $_SESSION["chat_user"]["email"] . "'
                            ORDER BY `date_time` DESC");
                                $msg_num = $msg->num_rows;
                                if ($msg_num != 0) {
                                    for ($y = 0; $y < $msg_num; $y++) {
                                        $msg_data = $msg->fetch_assoc();
                            ?>
                                        <div class="col-12 d-flex justify-content-end mt-3 mb-3" id="showMsg">
                                            <div class="card" style="background-color: lightblue;">
                                                <div class="card-body">
                                                    <label><?php echo $msg_data["content"] ?></label>
                                                </div>
                                            </div>
                                        </div>
                            <?php
                                    }
                                }
                            }

                            ?>
                            
                            <div></div>

                        </div>
                        <div></div>
                    </div>
                </div>
            </div>

        <?php
            include "footer.php";
        }
        ?>
    </div>
    <script src="script.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>