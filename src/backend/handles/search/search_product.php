<?php
// Include your database connection or any necessary files here
require_once("../../../connect/connectDB.php");

if (isset($_POST['product_id'])) {
    $searchName = $_POST['product_id'];

    $result = executeResult("SELECT * FROM tb_products WHERE product_name LIKE '%$searchName%'");

    if ($result != null) {
        foreach ($result as $row) {
            echo "<p class='product-name'>".$row['product_name']."</p>";
        }
    } else {
        echo "<p class='notfound'>No results found.</p>";
    }
}
