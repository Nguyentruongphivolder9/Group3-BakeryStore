<?php
session_start();
if(isset($_SESSION["authenticeted"]) ){
    $_SESSION["status"] = "Please login to your account before purchasing ";
    header("Location: login.php");
    exit();
}
?>