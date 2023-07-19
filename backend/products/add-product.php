<?php
require_once('../connect/connectDB.php');

$errors = array();
$errors["images"] = $thumbnails = [];
$errors["name"] =
    $errors["price"] =
    $errors["cateID"] =
    $errors["description"] =
    $errors["image"] =
    $errors["thumbnail"] =
    $errors["description"] =
    $name = $image = $cateID = $price = $description = '';

$category = executeResult("SELECT * FROM tb_category");

date_default_timezone_set('Asia/Bangkok');
$date = date('Y-m-d H:i:s');

// if (isset($_GET["id"])) {
//     $id = $_GET["id"];

//     $product = executeSingleResult("select * from tb_products where id = $id");

//     $thumbnails = executeSingleResult("select * from tb_thumbnail where product_id = $id");

//     $name = $product["product_name"];
//     $cateID = $product["cate_id"];
//     $price = $product["price"];
//     $image = $product["image"];
//     $description = $product["description"];
// }

if (isset($_POST) && !empty($_POST)) {
    if($_POST["name"]){
        $name = $_POST["name"];
    }
    if($_POST["cateID"]){
        $cateID = $_POST["cateID"];
    }
    if($_POST["price"]){
        $price = $_POST["price"];
    }
    if($_POST["description"]){
        $description = $_POST["description"];
    }

    $target_dir = "public/images/products/";
    $type_allow = ['image/png', 'image/jpeg', 'image/gif', 'image/jpg'];
    $size_allow = 10;

    $uploadPath = '../../' . $target_dir;
    // kiểm tra rồi tạo folder product
    if (!is_dir($uploadPath)) {
        mkdir($uploadPath);
    }

    function checkAndUploadFile($file, $target_dir, $size_allow, $type_allow)
    {
        $result = [];
        $thumbnailLink = "../../$target_dir" . basename($file["name"]);
        $type = $file['type'];
        $size = $file['size'] / 1024 / 1024;

        if (!file_exists($thumbnailLink)) {
            if (in_array($type, $type_allow)) {
                if ($size <= $size_allow) {
                    move_uploaded_file($file["tmp_name"], $thumbnailLink);
                } else {
                    $result['error'] = 'size_err';
                }
            } else {
                $result['error'] = 'type_err';
            }
        } else {
            $result['error'] = 'oldFile_err';
        }

        return $result;
    }

    if (isset($_FILES["image"]) && !empty($_FILES["image"]["name"])) {
        $file = $_FILES["image"];
        $image = $target_dir . basename($file["name"]);
        $result = checkAndUploadFile($_FILES["image"], $target_dir, $size_allow, $type_allow);
        if (isset($result['error'])) {
            $errors["image"] = $result['error'];
        }
    } else {
        $errors["image"] = "Image cannot be left blank";
    }

    if (isset($_FILES["images"]) && !empty($_FILES["images"]["name"][0])) {
        $files = $_FILES['images'];
        $file_names = $files['name'];

        foreach ($file_names as $key => $value) {
            $thumbnails[$key] = $target_dir . basename($value);
            $result = checkAndUploadFile(
                [
                    'name' => $files['name'][$key],
                    'type' => $files['type'][$key],
                    'size' => $files['size'][$key],
                    'tmp_name' => $files['tmp_name'][$key]
                ],
                $target_dir,
                $size_allow,
                $type_allow
            );

            if (isset($result['error'])) {
                $errors["images"][$key] = $result['error'];
            }
        }
    } else {
        $errors["thumbnail"] = "Thumbnail cannot be left blank";
    }
    
    if (!empty($errors["image"])) {
        $messImg = '';
        if ($errors["image"] == "oldFile_err") {
            $messImg = 'file ' . $file["name"] . ' already exists in the directory' . '<br>';
        } elseif ($errors["image"] == 'type_err') {
            $messImg = 'file ' . $file["name"] . ' format error' . '<br>';
        } else {
            $messImg = 'file ' . $file["name"] . ' capacity must be less than ' . $size_allow . 'MB ' . '<br>';
        }
    }
    
    if (!empty($errors["images"])) {
        $messThumb = '';
        foreach ($errors["images"] as $key => $error) {
            if ($error == 'oldFile_err') {
                $messThumb .= 'file ' . $files["name"][$key] . ' already exists in the directory' . '<br>';
            } elseif ($error == 'type_err') {
                $messThumb .= 'file ' . $files["name"][$key] . ' format error' . '<br>';
            } else {
                $messThumb .= 'file ' . $files["name"][$key] . ' capacity must be less than ' . $size_allow . 'MB ' . '<br>';
            }
        }
    }
    
    if (empty($name)) {
        $errors["name"] = "Product name cannot be left blank";
    }
    if (empty($cateID)) {
        $errors["cateID"] = "Category cannot be left blank";
    }
    if (empty($price)) {
        $errors["price"] = "Price cannot be left blank";
    }
    if (empty($description)) {
        $errors["description"] = "Description cannot be left blank";
    }

    // if ($id == '') {
        if (
            empty($error["name"]) 
            && empty($error["cateID"]) 
            && empty($error["price"]) 
            && empty($error["image"]) 
            && empty($error["thumbnail"])
            && empty($error["description"])
            && empty($messImg) 
            && empty($messThumb) 
        ) {
            execute("insert into tb_products 
            (cate_id, product_name, image, price, description, create_date, deleted) values
            ($cateID, '$name', '$image', $price, '$description', '$date', 0)");
            $new_id = executeSingleResult("select max(product_id) as new_product_id from tb_products");
            $new_product_id = $new_id["new_product_id"];
            foreach ($thumbnails as $key => $thumb){
                execute("insert into tb_thumbnail (product_id, thumbnail) values ($new_product_id, '$thumb')");
            }
        }
    // } else {
        
    // }


    // foreach ($files as $key => $f) {
    //     // $sql = "insert into tb_thumbnail (product_id, thumbnail) values
    //     // ($f)";
    //     // execute($sql);
    //     echo '<pre>';
    //     print_r($f);
    //     die();
    // }
}

function checkCate($value)
{
    global $cateID;
    echo $cateID == $value ? "selected" : "";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tiny.cloud/1/408p82mzgtitwtkc01bmbjchrnbzm4tc67jdfy6ouuzd59uu/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <h1>Add Product</h1>
    <div>
        <form action="" method="post" enctype="multipart/form-data">
            <div>
                <div>
                    <label for="">Product name</label> <br>
                    <input type="text" name="name" value="<?= $name ?>">
                    <?php
                    if (!empty($errors["name"])) {
                        echo '<p style="color: red;">' . $errors["name"] . '</p>';
                    }
                    ?>
                </div>
                <div>
                    <label for="">Price</label> <br>
                    <input type="number" name="price" value="<?= $price ?>">
                    <?php
                    if (!empty($errors["price"])) {
                        echo '<p style="color: red;">' . $errors["price"] . '</p>';
                    }
                    ?>
                </div>
                <div>
                    <select name="cateID" id="">
                        <option value="">___Category___</option>
                        <?php foreach ($category as $cate) { ?>
                            <option value="<?= $cate["cate_id"] ?>" <?php checkCate($cate["cate_id"]) ?>><?= $cate["cate_name"] ?></option>
                        <?php } ?>
                    </select>
                    <?php
                    if (!empty($errors["cateID"])) {
                        echo '<p style="color: red;">' . $errors["cateID"] . '</p>';
                    }
                    ?>
                </div>
            </div>
            <div>
                <label for="">Product image</label> <br>
                <input id="input-image" type="file" name="image" accept="image/*" onchange="delete_oldImage()"> <br>
                <?php
                if ($image != '') {
                    echo "<img src='../../$image' width='200px' id='oldImage'>";
                }
                ?>
                <div id="preview-image" style="display: flex; gap: 2rem;"></div>
                <div>
                    <?php
                    if (!empty($errors["image"])) {
                        echo '<p style="color: red;">' . $messImg . '</p>';
                    }
                    ?>
                </div>
            </div>
            <div>
                <label for="">Thumbnail</label> <br>
                <input id="input-images" type="file" name="images[]" multiple="multiple" accept="image/*"> <br>

                <!-- show thumbnail -->
                <div id="preview-images" style="display: flex; gap: 2rem;"></div>
                <div>
                    <!-- error thumbnail -->
                    <?php
                    if (!empty($errors["thumbnail"])) {
                        echo '<p style="color: red;">' . $errors["thumbnail"] . '</p>';
                    } elseif (!empty($mess)) {
                        echo "<p style='color: red;'>$mess</p>";
                    }
                    ?>
                </div>
            </div>
            <div>
                <textarea name="description" class="description" cols="30" rows="10"></textarea>
            </div>
            <div>
                <input type="submit" value="Save">
            </div>
        </form>
    </div>
    <script>
        tinymce.init({
            selector: '.description',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name'
        });
    </script>
    <script>
        function delete_oldImage() {
            var oldImage = document.getElementById('oldImage');
            oldImage.remove();
        }

        function delete_oldThumbnail() {
            var oldThumbnail = document.getElementById('oldThumbnail');
            oldThumbnail.remove();
        }

        function previewImage() {
            var $preview = $("#preview-image").empty();
            if (this.files) $.each(this.files, readAndPreview);

            function readAndPreview(i, file) {
                var reader = new FileReader();
                $(reader).on("load", function() {
                    $preview.append($("<img/>", {
                        src: this.result,
                        height: 100,
                        width: 200
                    }));
                });
                reader.readAsDataURL(file);
            }
        }

        function previewImages() {
            var $preview = $("#preview-images").empty();
            if (this.files) $.each(this.files, readAndPreview);

            function readAndPreview(i, file) {
                var reader = new FileReader();
                $(reader).on("load", function() {
                    $preview.append($("<img/>", {
                        src: this.result,
                        height: 100,
                        width: 200
                    }));
                });
                reader.readAsDataURL(file);
            }
        }
        $('#input-images').on("change", previewImages);
        $('#input-image').on("change", previewImage);
    </script>
</body>

</html>