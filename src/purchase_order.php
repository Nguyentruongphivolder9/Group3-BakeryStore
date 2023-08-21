<?php
require_once("connect/connectDB.php");
require_once("handles_page/handle_calculate.php");
session_start();
if (isset($_SESSION["auth_user"])) {
    $user_name = $_SESSION["auth_user"]["username"];
    $user_id = $_SESSION["auth_user"]["user_id"];
}

$arrayPrepare = $arrayPending = [];

$orders = executeResult("SELECT * FROM tb_order where user_id = $user_id");
$orders_details = executeResult("SELECT * FROM tb_order_detail o 
                                    INNER JOIN tb_products p
                                    ON o.product_id = p.product_id where user_id = $user_id");


function noOrderYet()
{
    echo '
    <div class="no-order-yet">
        <div>
            <img src="../public/images/icon/checklist.png" alt="">
            <p class="no-data">No orders yet</p>
        </div>
    </div>
    ';
}


function checkStatus($status)
{
    global $orders, $arrayPrepare;
    foreach ($orders as $key => $o) {
        if ($o["status"] == $status) {
            if ($status == "prepare") {
                $arrayPrepare[$key] = $o["status"];
                return $arrayPrepare;
            }
            if ($status == "pending") {
                $arrayPending[$key] = $o["status"];
                return $arrayPending;
            }
        }
    }
}

?>
<div class="purchase-order">
    <div class="po-tab-ui">
        <div class="tabs">
            <div class="tab-item active" data-tab="all">All</div>
            <div class="tab-item" data-tab="pending">Pending</div>
            <div class="tab-item" data-tab="prepare">Prepare</div>
            <div class="tab-item" data-tab="implementation">Implementation</div>
            <div class="tab-item" data-tab="delivering">Delivered</div>
            <div class="tab-item" data-tab="completed">Completed</div>
            <div class="tab-item" data-tab="cancelled">Cancelled</div>
            <div class="tab-item" data-tab="return-refund">Return/Refund</div>
        </div>
    </div>
    <div class="po-search">
        <span class="material-symbols-sharp">search</span>
        <input type="text" placeholder="You can search by product name or product category">
    </div>
    <div class="po-content-box">
        <div class="content active" data-content="all">
            <?php if ($orders != null) {
                foreach ($orders as $key => $o) {
            ?>
                    <div class="item-product-box">
                        <?php foreach ($orders_details as $key => $od) {
                            if ($od["order_id"] == $o["order_id"]) { ?>
                                <div class="detail-order">
                                    <div class="inf-prd">
                                        <div>
                                            <img src="../<?= $od["image"] ?>" alt="">
                                        </div>
                                        <div class="inf-text">
                                            <div class="prd-name"><?= $od["product_name"] ?></div>
                                            <div class="galary"><span>Size: <?= $od["size"] ?>cm</span> <span>Flavor: <?= $od["flavor"] ?></span></div>
                                            <div>x<?= $od["quantity"] ?></div>
                                        </div>
                                    </div>
                                    <div class="prd-price">
                                        <?php if ($od["sale_product"] != 0) { ?>
                                            <span class="price-del"><?php echo displayPrice($od["price"]) ?> vnđ</span>
                                            <span class="price-hight-light"><?php echo calculateOldPrice($od["price"], $od["sale_product"]) ?> vnđ</span>
                                        <?php } else { ?>
                                            <span class="price-hight-light"><?php echo displayPrice($od["price"]) ?> vnđ</span>
                                        <?php } ?>
                                    </div>
                                </div>
                        <?php }
                        } ?>
                        <div class="status-cal">
                            <div class="status-ord">
                                <span class="<?= $o["status"] ?>"><?= $o["status"] ?></span>
                            </div>
                            <div class="cal-total">
                                <?php if ($o["sale_coupon"] != 0) { ?>
                                    <span>Total Pay:
                                    </span><span class="price-del"><?php echo displayPrice($o["total_pay"]) ?> vnđ</span>
                                    <span class="price-total-pay"><?php echo displayPrice($o["total_pay"] - $o["sale_coupon"]) ?> vnđ</span>
                                <?php } else { ?>
                                    <span class="price-total-pay"><?php echo displayPrice($o["total_pay"]) ?> vnđ</span>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
            <?php }
            } else {
            } ?>


        </div>
        <div class="content" data-content="pending">
            <?php if (checkStatus("pending") != null) {
                foreach ($orders as $key => $o) {
                    if ($o["status"] == "pending") {
            ?>
                        <div class="item-product-box">
                            <?php foreach ($orders_details as $key => $od) { ?>
                                <div class="detail-order">
                                    <div class="inf-prd">
                                        <div>
                                            <img src="../<?= $od["image"] ?>" alt="">
                                        </div>
                                        <div class="inf-text">
                                            <div class="prd-name"><?= $od["product_name"] ?></div>
                                            <div class="galary"><span>Size: <?= $od["size"] ?>cm</span> <span>Flavor: <?= $od["flavor"] ?></span></div>
                                            <div>x<?= $od["quantity"] ?></div>
                                        </div>
                                    </div>
                                    <div class="prd-price">
                                        <?php if ($od["sale_product"] != 0) { ?>
                                            <span class="price-del"><?php echo displayPrice($od["price"]) ?> vnđ</span>
                                            <span class="price-hight-light"><?php echo calculateOldPrice($od["price"], $od["sale_product"]) ?> vnđ</span>
                                        <?php } else { ?>
                                            <span class="price-hight-light"><?php echo displayPrice($od["price"]) ?> vnđ</span>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="status-cal">
                                <div class="status-ord">
                                    <span class="<?= $o["status"] ?>"><?= $o["status"] ?></span>
                                </div>
                                <div class="cal-total">
                                    <?php if ($o["sale_coupon"] != 0) { ?>
                                        <span>Total Pay:
                                        </span><span class="price-del"><?php echo displayPrice($o["total_pay"]) ?> vnđ</span>
                                        <span class="price-total-pay"><?php echo displayPrice($o["total_pay"] - $o["sale_coupon"]) ?> vnđ</span>
                                    <?php } else { ?>
                                        <span class="price-total-pay"><?php echo displayPrice($o["total_pay"]) ?> vnđ</span>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
            <?php }
                }
            } else {
                noOrderYet();
            } ?>
        </div>
        <div class="content" data-content="prepare">
            <?php if (checkStatus("prepare") != null) {
                foreach ($orders as $key => $o) {
                    if ($o["status"] == "prepare") {
            ?>
                        <div class="item-product-box">
                            <?php foreach ($orders_details as $key => $od) { ?>
                                <div class="detail-order">
                                    <div class="inf-prd">
                                        <div>
                                            <img src="../<?= $od["image"] ?>" alt="">
                                        </div>
                                        <div class="inf-text">
                                            <div class="prd-name"><?= $od["product_name"] ?></div>
                                            <div class="galary"><span>Size: <?= $od["size"] ?>cm</span> <span>Flavor: <?= $od["flavor"] ?></span></div>
                                            <div>x<?= $od["quantity"] ?></div>
                                        </div>
                                    </div>
                                    <div class="prd-price">
                                        <?php if ($od["sale_product"] != 0) { ?>
                                            <span class="price-del"><?php echo displayPrice($od["price"]) ?> vnđ</span>
                                            <span class="price-hight-light"><?php echo calculateOldPrice($od["price"], $od["sale_product"]) ?> vnđ</span>
                                        <?php } else { ?>
                                            <span class="price-hight-light"><?php echo displayPrice($od["price"]) ?> vnđ</span>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="status-cal">
                                <div class="status-ord">
                                    <span class="<?= $o["status"] ?>"><?= $o["status"] ?></span>
                                </div>
                                <div class="cal-total">
                                    <?php if ($o["sale_coupon"] != 0) { ?>
                                        <span>Total Pay:
                                        </span><span class="price-del"><?php echo displayPrice($o["total_pay"]) ?> vnđ</span>
                                        <span class="price-total-pay"><?php echo displayPrice($o["total_pay"] - $o["sale_coupon"]) ?> vnđ</span>
                                    <?php } else { ?>
                                        <span class="price-total-pay"><?php echo displayPrice($o["total_pay"]) ?> vnđ</span>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
            <?php }
                }
            } else {
                noOrderYet();
            } ?>
        </div>
        <div class="content" data-content="implementation">
            <div class="item-product-box">
                <div class="detail-order">
                    <div class="inf-prd">
                        <div>
                            <img src="../public/images/products/z4345108010003_ba6d4066e3d620bce1a65f97a5a55657.jpg" alt="">
                        </div>
                        <div class="inf-text">
                            <div class="prd-name">Bánh sinh nhật bé gái công chúa</div>
                            <div class="galary"><span>Size: 12cm</span> <span>Flavor: Việt quất</span></div>
                            <div>x1</div>
                        </div>
                    </div>
                    <div class="prd-price">
                        <span class="price-del">9.350.000 vnđ</span> <span class="price-hight-light">9.300.000 vnđ</span>
                    </div>
                </div>
                <div class="status-cal">
                    <div class="status-ord">
                        <span>Hoàn Thành</span>
                    </div>
                    <div class="cal-total">
                        <span>Total Pay:</span> <span class="price-total-pay">9.300.000 vnđ</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="content" data-content="delivering">
            <div class="item-product-box">
                <div class="detail-order">
                    <div class="inf-prd">
                        <div>
                            <img src="../public/images/products/z4345108010003_ba6d4066e3d620bce1a65f97a5a55657.jpg" alt="">
                        </div>
                        <div class="inf-text">
                            <div class="prd-name">Bánh sinh nhật bé gái công chúa</div>
                            <div class="galary"><span>Size: 12cm</span> <span>Flavor: Việt quất</span></div>
                            <div>x1</div>
                        </div>
                    </div>
                    <div class="prd-price">
                        <span class="price-del">9.350.000 vnđ</span> <span class="price-hight-light">9.300.000 vnđ</span>
                    </div>
                </div>
                <div class="status-cal">
                    <div class="status-ord">
                        <span>Hoàn Thành</span>
                    </div>
                    <div class="cal-total">
                        <span>Total Pay:</span> <span class="price-total-pay">9.300.000 vnđ</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="content" data-content="completed">
            <div class="item-product-box">
                <div class="detail-order">
                    <div class="inf-prd">
                        <div>
                            <img src="../public/images/products/z4345108010003_ba6d4066e3d620bce1a65f97a5a55657.jpg" alt="">
                        </div>
                        <div class="inf-text">
                            <div class="prd-name">Bánh sinh nhật bé gái công chúa</div>
                            <div class="galary"><span>Size: 12cm</span> <span>Flavor: Việt quất</span></div>
                            <div>x1</div>
                        </div>
                    </div>
                    <div class="prd-price">
                        <span class="price-del">9.350.000 vnđ</span> <span class="price-hight-light">9.300.000 vnđ</span>
                    </div>
                </div>
                <div class="status-cal">
                    <div class="status-ord">
                        <span>Hoàn Thành</span>
                    </div>
                    <div class="cal-total">
                        <span>Total Pay:</span> <span class="price-total-pay">9.300.000 vnđ</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="content" data-content="cancelled">
            <div class="item-product-box">
                <div class="detail-order">
                    <div class="inf-prd">
                        <div>
                            <img src="../public/images/products/z4345108010003_ba6d4066e3d620bce1a65f97a5a55657.jpg" alt="">
                        </div>
                        <div class="inf-text">
                            <div class="prd-name">Bánh sinh nhật bé gái công chúa</div>
                            <div class="galary"><span>Size: 12cm</span> <span>Flavor: Việt quất</span></div>
                            <div>x1</div>
                        </div>
                    </div>
                    <div class="prd-price">
                        <span class="price-del">9.350.000 vnđ</span> <span class="price-hight-light">9.300.000 vnđ</span>
                    </div>
                </div>
                <div class="status-cal">
                    <div class="status-ord">
                        <span>Hoàn Thành</span>
                    </div>
                    <div class="cal-total">
                        <span>Total Pay:</span> <span class="price-total-pay">9.300.000 vnđ</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="content" data-content="return-refund">
            <div class="item-product-box">
                <div class="detail-order">
                    <div class="inf-prd">
                        <div>
                            <img src="../public/images/products/z4345108010003_ba6d4066e3d620bce1a65f97a5a55657.jpg" alt="">
                        </div>
                        <div class="inf-text">
                            <div class="prd-name">Bánh sinh nhật bé gái công chúa</div>
                            <div class="galary"><span>Size: 12cm</span> <span>Flavor: Việt quất</span></div>
                            <div>x1</div>
                        </div>
                    </div>
                    <div class="prd-price">
                        <span class="price-del">9.350.000 vnđ</span> <span class="price-hight-light">9.300.000 vnđ</span>
                    </div>
                </div>
                <div class="status-cal">
                    <div class="status-ord">
                        <span>Hoàn Thành</span>
                    </div>
                    <div class="cal-total">
                        <span>Total Pay:</span> <span class="price-total-pay">9.300.000 vnđ</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="po-content-box">
    <div class="content active" data-content="all">
        <?php
        if (isset($user_id)) {
            // Retrieve and display orders with all statuses for the specific user
            $orders = executeResult("SELECT * FROM tb_order WHERE user_id = $user_id");

            foreach ($orders as $order) {
                // Display order information based on your layout
                echo '<div class="order-item">';
                echo '<p>Order ID: ' . $order['order_id'] . '</p>';
                echo '<p>Customer Name: ' . $order['name'] . '</p>';
                echo '<p>Contact Information: Phone: ' . $order['phone'] . ', Address: ' . $order['address'] . '</p>';
                echo '<p>Order Date: ' . $order['order_date'] . '</p>';
                echo '<p>Status: ' . $order['status'] . '</p>';
                echo '</div>';
            }
        } else {
            echo '<p>No user logged in.</p>';
        }
        ?>
    </div>
    <!-- ... (other content sections) ... -->
</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</div>
<script>
    $(".po-tab-ui .tabs .tab-item").click(function(e) {
        e.preventDefault();
        $(this).siblings().removeClass("active");
        $(this).addClass("active");
        var selectedTab = $(this).data('tab');
        $('.content').removeClass('active');
        $('.content[data-content="' + selectedTab + '"]').addClass('active');
    });
</script>