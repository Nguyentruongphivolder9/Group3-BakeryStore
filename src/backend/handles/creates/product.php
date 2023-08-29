<?php
session_start();
require_once("../../../connect/connectDB.php");
if (isset($_SESSION["auth_user"])) {
    $user_id = $_SESSION["auth_user"]["user_id"];
}

$errors = [];
$uploads_imagesLink = $uploads_tmp_name = [];
$images = $imagesDelete =  [];
$errors["errorImages"] = [];

$errors["errorName"] =
    $errors["errorPrice"] =
    $errors["errorCateID"] =
    $errors["errorDescription"] = $image = '';
$errorNum = $eventNum = $noUpdateImage = 0;

date_default_timezone_set('Asia/Bangkok');
$date = date('Y-m-d H:i:s');

$target_dir = "public/images/products/";
$type_allow = ['image/png', 'image/jpeg', 'image/gif', 'image/jpg'];
$size_allow = 2;

// id
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    $id = $_POST["id"];
    $eventNum = 1;
}

// product name
if (isset($_POST["name"]) && !empty($_POST["name"])) {
    $name = trim($_POST["name"]);
    if ($eventNum == 0) {
        $productName = checkRowTable("SELECT * from tb_products where product_name = '$name'");

        if ($productName != 0) {
            $errors["errorName"] = 'Product name already exists';
            $errorNum = 1;
        } else {
            if (strlen($name) <= 3 || strlen($name) > 80) {
                $errors["errorName"] = 'character length greater than 3 is less than 80';
                $errorNum = 1;
            }
        }
    } else {
        $nameUpdate = executeSingleResult("SELECT * FROM tb_products WHERE product_id = $id");
        if ($name != $nameUpdate["product_name"]) {
            $productName = checkRowTable("SELECT * from tb_products where product_name = '$name'");
            if ($productName != 0) {
                $errors["errorName"] = 'Product name already exists';
                $errorNum = 1;
            } else {
                if (strlen($name) <= 3 || strlen($name) > 80) {
                    $errors["errorName"] = 'character length greater than 3 is less than 80';
                    $errorNum = 1;
                }
            }
        }
    }
} else {
    $errors["errorName"] = 'Product name cannot be blank';
    $errorNum = 1;
}

// product price
if (isset($_POST["price"]) && !empty($_POST["price"])) {
    $price = $_POST["price"];
    if ($price <= 10000 || $price > 10000000) {
        $errors["errorPrice"] = 'The product price is only in the range from 10.000 to 10.000.000 VND';
        $errorNum = 1;
    }
} else {
    $errors["errorPrice"] = 'Product price cannot be blank';
    $errorNum = 1;
}
// quantity product
if (isset($_POST["qtyProduct"]) && !empty($_POST["qtyProduct"])) {
    $qtyProduct = $_POST["qtyProduct"];
    if ($qtyProduct <= 0 || $qtyProduct > 100) {
        $errors["errorQty"] = 'Product quantity must be greater than 0 and less than 100';
        $errorNum = 1;
    }
} else {
    $errors["errorQty"] = 'Product quantity cannot be blank';
    $errorNum = 1;
}
// // product category
if (isset($_POST["cateID"]) && !empty($_POST["cateID"])) {
    $cateID = $_POST["cateID"];
} else {
    $errors["errorCateID"] = 'Product category cannot be blank';
    $errorNum = 1;
}
// description
if (isset($_POST["description"]) && !empty($_POST["description"])) {
    $description =  $_POST["description"];
} else {
    $errors["errorDescription"] = 'Description cannot be blank';
    $errorNum = 1;
}
// // images
if (isset($_FILES["images"]["name"])) {
    $files = $_FILES['images'];
    $file_names = $files['name'];

    if ($eventNum == 1) {
        $thumbnails = executeResult("SELECT * FROM tb_thumbnail WHERE product_id = $id");
        $imageDelete = executeSingleResult("SELECT * FROM tb_products WHERE product_id = $id");

        $imagesDelete[0] = $imageDelete["image"];
        foreach ($thumbnails as $key => $thumb) {
            $imagesDelete[$key + 1] = $thumb["thumbnail"];
        }
        foreach ($imagesDelete as $key => $imgDelete) {
            unlink('../../../../' . $imgDelete);
        }
        execute("DELETE FROM tb_thumbnail WHERE product_id = $id");
    }

    foreach ($file_names as $key => $value) {
        $original_image_link = $target_dir . basename($value);
        $imagesInsert = $target_dir . basename($value);
        $imagesLink = "../../../../$target_dir" . basename($value);
        $imagesType = $files['type'][$key];
        $imagesSize = $files['size'][$key] / 1024 / 1024;
        $counter = 1;

        // kiểm tra xem file có hợp lệ không
        if (file_exists($imagesLink)) {
            while (file_exists($imagesLink)) {
                $fileExtension = pathinfo($original_image_link, PATHINFO_EXTENSION);
                $newFileName = pathinfo($original_image_link, PATHINFO_FILENAME) . '_(' . $counter . ').' . $fileExtension;
                $imagesLink = "../../../../$target_dir" . $newFileName;
                $imagesInsert = $target_dir . $newFileName;
                $counter++;
            }
        }
        if (in_array($imagesType, $type_allow)) {
            if ($imagesSize <= $size_allow) {
                $uploads_tmp_name[$key] = $files["tmp_name"][$key];
                $uploads_imagesLink[$key] = $imagesLink;
                $images[$key] = $imagesInsert;
            } else {
                $errors["errorImages"][$key] = 'file ' . $files["name"][$key] . ' capacity must be less than ' . $size_allow . 'MB ';
                $errorNum = 1;
            }
        } else {
            $errors["errorImages"][$key] = 'file ' . $files["name"][$key] . ' format error';
            $errorNum = 1;
        }
    }
} else {
    if ($eventNum == 0) {
        $errors["errorImages"] = "Product images cannot be blank";
        $errorNum = 1;
    } else {
        $noUpdateImage = 1;
    }
}

if (
    $errorNum == 0
) {
    if ($eventNum == 0) {
        $imageInsert = $images[0];
        $sql = "INSERT INTO tb_products 
        (cate_id, product_name, image, price, description, create_date, view, qty_warehouse, deleted) VALUES
        ($cateID, '$name', '$imageInsert', $price, '$description', '$date', 0, $qtyProduct, 0)";
        $success = execute($sql);
        $new_id_product = executeSingleResult("SELECT MAX(product_id) as new_id_product FROM tb_products");
        $new_id = $new_id_product["new_id_product"];
        for ($i = 1; $i < count($images); $i++) {
            $insertThumb = $images[$i];
            execute("INSERT INTO tb_thumbnail 
                (product_id, thumbnail) VALUES
                ($new_id, '$insertThumb')");
        }
        for ($i = 0; $i < count($images); $i++) {
            move_uploaded_file($uploads_tmp_name[$i], $uploads_imagesLink[$i]);
        }

        if($success){
            $content = 'has added a new product ' . $name;
            historyOperation($user_id, $content);
        }
        echo 'success';
    } else {
        if ($noUpdateImage == 0) {
            $imageUpdate = $images[0];
            $success = execute("UPDATE tb_products SET 
                cate_id = '$cateID', product_name = '$name', 
                image = '$imageUpdate', price = '$price', 
                description = '$description', update_date = '$date',
                qty_warehouse = $qtyProduct
            WHERE product_id = $id");
            for ($i = 1; $i < count($images); $i++) {
                $updateThumb = $images[$i];
                execute("INSERT INTO tb_thumbnail 
                (product_id, thumbnail) VALUES
                ($id, '$updateThumb')");
            }
            for ($i = 0; $i < count($images); $i++) {
                move_uploaded_file($uploads_tmp_name[$i], $uploads_imagesLink[$i]);
            }
        } else {
            $success = execute("UPDATE tb_products SET 
                cate_id = '$cateID', product_name = '$name', 
                price = '$price', description = '$description', 
                update_date = '$date'
            WHERE product_id = $id");
        }

        if($success){
            $content = 'has updated to product ' . $name;
            historyOperation($user_id, $content);
        }
        echo 'success';
    }
} else {
    echo json_encode($errors);
}
