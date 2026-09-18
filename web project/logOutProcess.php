<?php 
session_start();

if(isset($_SESSION["seller"])){
    $_SESSION["seller"] = null;
    session_destroy();
    echo("success");
}
?>