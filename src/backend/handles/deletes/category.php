<?php
session_start();
require_once("../../../connect/connectDB.php");

$user_id = '';

if (isset($_SESSION["auth_user"])) {
    $user_id = $_SESSION["auth_user"]["user_id"];
}

if(isset($_POST["id"])){
    $id = $_POST["id"];

    $cate = executeSingleResult("SELECT cate_name FROM tb_category where cate_id = $id");

    $success = execute("DELETE from tb_category where cate_id = $id");
    execute("DELETE from tb_cate_size where cate_id = $id");

    if ($success) {
        $content = 'has deleted a category ' . $cate["cate_name"];
        historyOperation($user_id, $content);
    }
}
echo 'products/gallery.php';
?>