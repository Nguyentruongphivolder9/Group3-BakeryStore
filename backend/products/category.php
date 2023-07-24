<?php
require_once('../../connect/connectDB.php');

$cates = executeResult("select * from tb_category");

?>

<head>
    <link rel="stylesheet" href="css/table.css">
    <style>
        .create {
            background-color: #58e4c8fe;
        }
    </style>
</head>

<div class="table_category">
    <h1>Category</h1>
    <button class="create" onclick="createProduct()">Create new Category</button>
    <div>
        <table>
            <table>
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="" id=""> All
                        </th>
                        <th>Id</th>
                        <th>Category Name</th>
                        <th>Total Products</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cates as $key => $cate) {
                        $cate_id = $cate["cate_id"];
                        $row = executeSingleResult("select count(*) as total from tb_products where cate_id = $cate_id");
                    ?>
                        <tr>
                            <td>
                                <input type="checkbox" name="" id="">
                            </td>
                            <td><?= $key + 1 ?></td>
                            <td><?= $cate["cate_name"] ?></td>
                            <td><?php echo $row["total"] ?></td>
                            <td class="button">
                                <button class="update" onclick='updateCate(<?= $cate["cate_id"] ?>)' type="button">Update</button>
                                <?php if ($row["total"] > 0) { ?>
                                    <button class="notDelete delete">Delete</button>
                                <?php  } else { ?>
                                    <button class="delete" onclick='deleteCate(<?= $cate["cate_id"] ?>)' type="button">Delete</button>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </table>
    </div>
</div>

<script>
    function deleteCate(id) {
        $.post(
            "handles/deletes/cate_delete.php", {
                id: id
            },
            function(data) {
                ajaxSidebar(data);
            }
        )
    }

    function createProduct() {
        $.ajax({
            url: 'products/category_add.php',
            method: "POST",
            dataType: "html",
            success: function(response) {
                $("#main-page").html(response);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }
</script>