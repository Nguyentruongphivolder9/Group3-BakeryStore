<?php
require_once("../connect/connectDB.php");

$id = '';
$adsUpdate = [];
$adsUpdate["type_ads"] = '';

$cates = executeResult("SELECT * FROM tb_category");
$products = executeResult("SELECT * FROM tb_products WHERE deleted = 0");
$ads = executeResult("SELECT * FROM tb_ads ORDER BY ads_id DESC");

if (isset($_POST["id"]) && !empty($_POST["id"])) {
    $id = $_POST["id"];

    $adsUpdate = executeSingleResult("SELECT * FROM tb_ads where ads_id = $id");
}

function checkTypeAdsUpdate($value)
{
    global $adsUpdate;
    echo $adsUpdate["type_ads"] == $value ? "selected" : "";
}

function checkTypeProductUpdate($value)
{
    global $products;
    echo $products["product_id"] == $value ? "selected" : "";
}
function checkTypeCateUpdate($value)
{
    global $cates;
    echo $cates["cate_id"] == $value ? "selected" : "";
}
?>

<div class="ads-page">
    <h1>Advertising Management</h1>
    <div class="ads-add">
        <div class="ads-event">
            <h2>Create Advertising</h2>
        </div>
        <div>
            <input type="text" name="ads_id" value="<?= ($id != null ? $adsUpdate["ads_id"] : '') ?>">
        </div>
        <form id="adsForm" method="post" enctype="multipart/form-data" action="">
            <div class="type-ads-box">
                <label for="">Type advertisement</label> <br>
                <div class="type-ads">
                    <div class="select-container">
                        <select name="typeAds" id="typeAds" class="select-box" onchange="checkTypeAds()">
                            <option value="">______Option______</option>
                            <option value="sale" <?php checkTypeAdsUpdate('sale') ?>>Sale</option>
                            <option value="category" <?php checkTypeAdsUpdate('category') ?>>Category</option>
                            <option value="product" <?php checkTypeAdsUpdate('product') ?>>Product</option>
                            <option value="news" <?php checkTypeAdsUpdate('news') ?>>News</option>
                        </select>
                    </div>
                    <div class="typeAdsOption"></div>
                </div>
                <p style="color: red;" class="errorTypeAds"></p>
            </div>
            <div class="image-box">
                <label for="">Image advertisement</label> <br>
                <input id="imageAds" type="file" name="imageAds">
                <div id="preview-images"></div>
                <?php if ($id != null) { ?>
                    <div id="image-ads">
                        <img src="../../<?= $adsUpdate["image_ads"] ?>">
                    </div>
                <?php } ?>
                <p style="color: red;" class="errorImages"></p>
            </div>
            <div class="ads-date">
                <div class="start-date-box">
                    <label for="">Start Date</label> <br>
                    <input id="startDate" type="date" name="startDate" value="<?= ($id != null ? $adsUpdate["start_date"] : '') ?>">
                </div>
                <div class="end-date-box">
                    <label for="">End Date</label> <br>
                    <input id="endDate" type="date" name="endDate" value="<?= ($id != null ? $adsUpdate["end_date"] : '') ?>">
                </div>
            </div>
            <p style="color: red;" class="errorDate"></p>
            <div class="ads-event">
                <button id="addAds" class="submit" type="button">Add</button>
            </div>
        </form>
    </div>
    <div class="table_ads scroll-table">
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Type</th>
                    <th>Image</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ads as $key => $a) { ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td>
                            <?php if ($a["type_ads"] == "product") {
                                $showProductID = $a["product_id"];
                                $productShow = executeSingleResult("SELECT product_name FROM tb_products Where product_id = $showProductID");
                                echo $a["type_ads"] . ": " . $productShow["product_name"];
                            } elseif ($a["type_ads"] == "category") {
                                $showCateID = $a["cate_id"];
                                $cateShow = executeSingleResult("SELECT cate_name FROM tb_category Where cate_id = $showCateID");
                                echo $a["type_ads"] . ": " . $cateShow["cate_name"];
                            } else {
                                echo $a["type_ads"];
                            } ?>
                        </td>
                        <td class="image-banner">
                            <img src="../../<?= $a["image_ads"] ?>" alt="">
                        </td>
                        <td><?= $a["start_date"] ?></td>
                        <td><?= $a["end_date"] ?></td>
                        <td>
                            <button class="update" type="button" onclick="updateAds(<?= $a['ads_id'] ?>)">Update</button>
                            <button class="delete" type="button" onclick="deleteAds(<?= $a['ads_id'] ?>)">Delete</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div id="success">
        <div class="message">
            <p>successfully added an ad !</p>
            <div class="button-success">
                <button id="okButton">Ok</button>
            </div>
        </div>
    </div>
</div>
<script>
    function checkTypeAds() {
        $(document).ready(function() {
            var typeAds = $("#typeAds").val();

            typeAdsOption(typeAds)
        })
    }

    $(function() {
        <?php if ($id != null) { ?>
            typeAdsOption('<?= $adsUpdate["type_ads"] ?>');
        <?php } ?>
    });

    function typeAdsOption(typeAds) {
        if (typeAds == "category") {
            const html = `
                    <div class="select-container">
                        <select name="cateID" class="select-box">
                            <option value="">___Category Name___</option>
                            <?php foreach ($cates as $c) { ?>
                                <option value="<?= $c["cate_id"] ?>"><?= $c["cate_name"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                `;
            $(".typeAdsOption").empty().append(html);
        } else if (typeAds == "product") {
            const html = `
                    <div class="select-container">
                        <select name="productID" class="select-box">
                            <option value="">___Product Name___</option>
                            <?php foreach ($products as $p) { ?>
                                <option value="<?= $p["product_id"] ?>"><?= $p["product_name"] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                `;
            $(".typeAdsOption").empty().append(html);
        } else {
            $(".typeAdsOption").empty();
        }
    }

    $("#success").hide();
    $("#addAds").click(function(e) {
        e.preventDefault();
        $(document).ready(function() {
            var formData = new FormData($("#adsForm")[0]);

            $.ajax({
                type: "POST",
                url: 'handles/creates/ads.php',
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    alert(res)
                    if (res === 'success') {
                        showSuccessMessage("ads.php");
                    } else {
                        var errors = JSON.parse(res);
                        for (var key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                var value = errors[key];
                                $('.' + key).empty().append(value);
                            }
                        }
                    }
                }
            })
        })
    })

    $(document).ready(function() {
        $('#imageAds').on("change", function() {
            previewFiles(this, "#preview-images", 400);
            $(".errorImages").empty().append('');
        });
    });

    function deleteAds(id) {
        const html = `
        <div class="message-confirm-box">
            <div class="message-confirm">
                <div>Are you sure to permanently delete ads?</div>
                <div>
                    <button class="cancel" type="button">Cancal</button>
                    <button id="delete-ads" class="delete" type="button">Delete</button>
                </div>
            </div>
        </div>
    `;
        $("body").append(html);

        $(".cancel").click(function() {
            $(".message-confirm-box").remove();
        });

        $("#delete-ads").click(function() {
            $.post(
                "handles/deletes/ads.php", {
                    id: id
                },
                function(res) {
                    $(".message-confirm-box").remove();
                    ajaxPages(res);
                }
            )
        });
    }

    function updateAds(id) {
        var postData = {
            id: id
        }
        ajaxPageData("ads.php", postData);
    }
</script>