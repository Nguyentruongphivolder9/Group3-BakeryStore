<?php
require_once('../connect/connectDB.php');
session_start();
if (isset($_SESSION["auth_user"])) {
    $user_name = $_SESSION["auth_user"]["username"];
    $user_id = $_SESSION["auth_user"]["user_id"];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin NgocNhiBakery</title>
    <link rel="stylesheet" href="../../public/backend/css/admin.css">
    <link rel="stylesheet" href="../../public/backend/css/table.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <div class="container">
        <aside>
            <div class="top">
                <div class="logo">
                    <div class="img-logo">
                        <img src="../../public/images/logo/Screenshot 2023-06-23 205633.png" alt="logo">
                    </div>
                    <h2 class="text-muted">NGOCNHI
                        <span class="danger">BAKERY</span>
                    </h2>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-symbols-sharp">close</span>
                </div>
            </div>

            <div class="sidebar">
                <ul>
                    <li class="nav-item active">
                        <a href="accounts/customer.php" class="nav-link">
                            <span class="material-symbols-sharp">person</span>
                            <h3>Customer</h3>
                        </a>
                    </li>
                    <li class="nav-item">
                        <div class="sub-btn nav-link">
                            <div class="title">
                                <span class="material-symbols-sharp">inventory</span>
                                <h3>Products</h3>
                            </div>
                            <span class="material-symbols-sharp more">expand_more</span>
                            <span class="material-symbols-sharp less">expand_less</span>
                        </div>
                        <ul class="sub-menu">
                            <li class="menu-item">
                                <a href="products/products.php">
                                    <span class="material-symbols-sharp unchecked">radio_button_unchecked</span>
                                    <span class="material-symbols-sharp checked">radio_button_checked</span>
                                    <h4>All Products</h4>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="products/gallery.php">
                                    <span class="material-symbols-sharp unchecked">radio_button_unchecked</span>
                                    <span class="material-symbols-sharp checked">radio_button_checked</span>
                                    <h4>Gallery</h4>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="orders.php" class="nav-link">
                            <span class="material-symbols-sharp">receipt_long</span>
                            <h3>Orders</h3>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./signIn.php" class="nav-link">
                            <span class="material-symbols-sharp">mail</span>
                            <h3>Feedbacks</h3>
                            <span class="message-count">27</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="sale.php" class="nav-link">
                            <span class="material-symbols-sharp">shopping_cart_checkout</span>
                            <h3>Sale</h3>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="ads.php" class="nav-link">
                        <span class="material-symbols-sharp">ad_units</span>
                            <h3>Advertising</h3>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="products/product_add.php" class="nav-link">
                            <span class="material-symbols-sharp">add</span>
                            <h3>Add Product</h3>
                        </a>
                    </li>
                    <li class="nav-item logout">
                        <a href="./signIn.php" class="nav-link">
                            <span class="material-symbols-sharp">logout</span>
                            <h3>Logout</h3>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>

        <div id="main">
            <div class="top">
                <div class="menu">
                    <button id="menu-btn">
                        <span class="material-symbols-sharp">menu</span>
                    </button>
                    <button id="show-menu">
                        <span class="material-symbols-sharp">arrow_right_alt</span>
                    </button>
                    <button id="shorten-menu">
                        <span class="material-symbols-sharp">arrow_left_alt</span>
                    </button>
                </div>
                <!-- <div class="input-search">
                    <input type="search" placeholder="Search Data...">
                    <img src="images/search.png" alt="">
                </div> -->
                <div class="profile-theme">
                    <div class="theme-toggler">
                        <span class="material-symbols-sharp active">light_mode</span>
                        <span class="material-symbols-sharp">dark_mode</span>
                    </div>
                    <div class="profile">
                        <div class="info">
                        <div class="info">
                            <p>Hey, <b> <?php echo $user_name ?>  </b></p>
                            <small class="text-muted"> Position : Staff </small>
                        </div>
                    </div>
                </div>
            </div>

            <div id="main-page">
                <?php include("accounts/customer.php"); ?>
            </div>
        </div>
    </div>

    <script src="../../public/backend/js/admin.js"></script>
    <script src="../../public/backend/js/adminJquery.js"></script>
</body>

</html>