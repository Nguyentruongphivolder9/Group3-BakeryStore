<?php
$itemCart = '';
if (isset($_SESSION["auth_user"])) {
  $user_name = $_SESSION["auth_user"]["username"];
  $user_id = $_SESSION["auth_user"]["user_id"];
  $itemCart = executeSingleResult("SELECT COUNT(*) as total FROM tb_cart WHERE user_id = $user_id");
  $user = executeSingleResult("SELECT * FROM tb_user WHERE user_id = $user_id");
}
$cates = executeResult("SELECT c.cate_id, c.cate_name, SUM(p.view) AS total_views 
                        FROM tb_category c
                        INNER JOIN tb_products p 
                        ON c.cate_id = p.cate_id 
                        GROUP BY c.cate_name
                        ORDER BY total_views DESC");


// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Bakery Store</title>
  <meta name="description"
    content="Thu Hương Bakery ra đời từ năm 1996, trong suốt hơn 25 năm hình thành và phát triển, với sự nỗ lực không ngừng nghỉ Thu Hương Bakery đã mang lại những dấu ấn khó phai trong lòng người dân Thủ Đô.">
  <meta name="keywords" content="Bánh Sinh Nhật, Bánh Trung Thu, Quà Trung Thu, Thu Hương Bakery Since 1996">

  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />

  <!-- Favicon -->
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

  <!-- FONT -->
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Cabin" />
  <!-- FONT -->

  <!-- PLUGIN CSS -->
  <link rel="stylesheet" href="../public/frontend/css/librarys_css/css/bootstrap4.min.css">
  <link rel="stylesheet" href="../public/frontend/css/librarys_css/css/owl.carousel.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css">
  <link rel="stylesheet" href="../public/frontend/css/lightslider.css">
  <!-- <link rel="stylesheet" href="ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css"> -->



  <!-- PLUGIN CSS -->

  <link href="../public/frontend/css/style.css?v=0.0.7" rel="stylesheet">
  <link href="../public/frontend/css/product.css" rel="stylesheet">
  <!-- Meta Pixel Code -->
  <script>
    ! function (f, b, e, v, n, t, s) {
      if (f.fbq) return;
      n = f.fbq = function () {
        n.callMethod ?
          n.callMethod.apply(n, arguments) : n.queue.push(arguments)
      };
      if (!f._fbq) f._fbq = n;
      n.push = n;
      n.loaded = !0;
      n.version = '2.0';
      n.queue = [];
      t = b.createElement(e);
      t.async = !0;
      t.src = v;
      s = b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t, s)
    }(window, document, 'script',
      'en_US/fbevents.js');
    fbq('init', '1913464958707044');
    fbq('track', 'PageView');
  </script>
  <noscript><img height="1" width="1" style="display:none"
      src="tr?id=1913464958707044&ev=PageView&noscript=1" /></noscript>
  <!-- End Meta Pixel Code -->

  <!-- Google tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-232235704-1">
  </script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-232235704-1');
  </script><!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-QERL8JJ8K1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-QERL8JJ8K1');
  </script>

</head>

<body>
  <div class="page-wrapper">

    <!-- MESSAGE FROM SERVER -->
    <div class="msg-top ">
      <div class="msg-from-server msg-container">
        <span class="close-msg">&times;</span>
      </div>
    </div>

    <div class="fullscreen-overlay"></div>

    <div class="cart-sidebar-container">
      <div class="header">
        <p class="title">Carts</p><span class="toggle-cart-sidebar js-toggle-cart-sidebar"><i
            class="fas fa-times fa-2x"></i></span>
      </div>
      <div class="body">
        <ul class="cart-list">
          <?php
          // Connect to the database
          $conn = new mysqli("localhost", "root", "", "projecthk2");

          // Check connection
          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }

          // Query to get cart items from tb_cart table
          $query = "SELECT product_name, flavor, size, quantity, price, total_price FROM tb_cart";
          $result = $conn->query($query);

          // Display cart items
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              $getPrice = $row['price'];
              $priceFormat = number_format($getPrice, 0);

              echo '<li>';
              echo '<p class="product-name">' . "Product: " . $row['product_name'] . '</p>';
              echo '<p class="subtotal">' . "Flavor: " . $row['flavor'] . '</p>';
              echo '<p class="subtotal"><span class="multi">' . "Price: " . $priceFormat . '$' . '</span></p>';
              echo '<p class="subtotal"><span class="multi">' . "Quantity: " . $row['quantity'] . '</span></p>';
              echo '<p class="subtotal"><span class="multi">' . "Size: " . $row['size'] . '</span></p>';
              echo '</li>';
            }
          } else {
            echo '<li>No items in the cart.</li>';
          }

          // Close the connection
          $conn->close();
          ?>
        </ul>
      </div>
      <div class="footer">
        <div class="total">
          <span class="text">Tổng tiền</span>
          <?php
          // Connect to the database
          $conn = new mysqli("localhost", "root", "", "projecthk2");

          $query = "SELECT SUM(total_price) as totalPrice FROM tb_cart";
          $result = $conn->query($query);

          // Display cart items
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              $totalPrice = $row['totalPrice'];
              echo '<li>';
              echo "" . number_format($totalPrice, 0) . " vnđ";
              echo '</li>';
            }
          } else {
            echo '<li>No items in the cart.</li>';
          }
          // Close the connection
          $conn->close();
          ?>
        </div>
        <div class="action-btns">
          <a class="action-btn goto-cart" href="carts.php">View cart</a>
        </div>
      </div>
    </div>

    <div class="mobile-menu-container">
      <div class="header">
        <p class="title">
          <img src="../../public/images/logo/logo.jpg" alt="" srcset="">
        </p><span class="toggle-mobile-menu js-toggle-mobile-menu"><i class="fas fa-times fa-2x"></i></span>
      </div>
      <div class="body">

        <nav>
          <div class="nav nav-tabs tabs-menu-mobile" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
              aria-controls="nav-home" aria-selected="true">MENU</a>
            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-category" role="tab"
              aria-controls="nav-profile" aria-selected="false">DANH MỤC SẢN PHẨM</a>
          </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade pt-3 show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <ul class="mobile-menu-list">
              <li class="li-menu">
                <a href="#">
                  Danh Muc San Pham
                  <i class="fa fa-angle-down" aria-hidden="true"></i>
                </a>
                <ul class="submenu">
                  <?php foreach ($cates as $key => $c) { ?>
                    <li>
                      <a href="product.php?cate_id=<?= $c["cate_id"] ?>"><?= $c["cate_name"] ?></a>
                    </li>
                  <?php } ?>
                </ul>
              </li>
              <li class="li-menu">
                <a href="home.php">
                  Home
                </a>
              </li>
              <li class="li-menu">
                <a href="about.php">
                  About Us
                </a>
              </li>
              <li class="li-menu">
                <a href="product.php">
                  Products
                </a>
              </li>
              <li class="li-menu">
                <a href="#">
                  News and Events
                  <i class="fa fa-angle-down" aria-hidden="true"></i>
                </a>
                <ul class='submenu'>
                  <li> <a href='shopping_guide.php'> Shopping Guide</a></li>
                  <li> <a href='news.php'> News</a></li>
                </ul>
              </li>
              <li class="li-menu">
                <a href="contact.php">
                  Contact
                </a>
              </li>
            </ul>
          </div>
          <div class="tab-pane fade  pt-3" id="nav-category" role="tabpanel" aria-labelledby="nav-profile-tab">
            <ul class="mobile-menu-list">
              <?php foreach ($cates as $key => $c) { ?>
                <li>
                  <a href="product.php?cate_id=<?= $c["cate_id"] ?>"><?= $c["cate_name"] ?></a>
                </li>
              <?php } ?>
            </ul>
          </div>
        </div>
      </div>

      <div class="footer">
        <div class="auth-actions depth1">
          <a class="auth-action" href="dang-nhap#login">
            <i class="fas fa-user-circle"></i>
            <span>Đăng nhập</span>
          </a>
          <a class="auth-action" href="dang-ky#register">
            <i class="fas fa-user-plus"></i>
            <span>Đăng kí</span>
          </a>
        </div>
      </div>
    </div>

    <header class="header">
      <div class="header-top" id="HeaderTop">
        <div class="container">
          <span class="sologan float-left">Welcome dear customers to NgocNhi Bakery store</span>
          <span class="sologan float-right">Hotline: 0707364628 | 0907733229</span>
        </div>
      </div>
      <div class="header-topbar">
        <div class="container">
          <div class="header-topbar-inner-container">
            <div class="left">
              <div class="logo">
                <a class="big-logo" href="">
                  <img src="../public/images/logo/logo.jpg" alt="">
                </a>
              </div>
            </div>

            <div class="right">

              <div class="form-search-header">
                <span class="icon">
                  <i class="fa fa-search"></i>
                </span>
                <input id="search-product" type="text" name="search" placeholder="Search product..."
                  class="form-control">
                <ul id="search-results" style="display: none;"></ul>
              </div>


              <button class="shopping-bag js-toggle-cart-sidebar">
                <img src="../public/images/icon/shopping-bag.svg" alt="">
                <span class="counter" id="cart-item">
                  <?= $itemCart['total'] ?>
                </span>
              </button>

              <div class="user-header d-none d-lg-block">
  <?php
  if (isset($_SESSION["auth_user"])) {
    $user = $_SESSION["auth_user"]; // Retrieve the user data from the session

    if ($user["role"] == "1") {
      echo '<button class="shopping-bag js-toggle-cart-sidebar">
              <img src="../public/images/icon/shopping-bag.svg" alt="">
              <span class="counter" id="cart-item">' . $cartItemCount . '</span>
            </button>';
      echo '<a href="my_account_user.php" class="user-header-button js-toggle-user-nav">';
      echo '<i class="fa fa-user" aria-hidden="true"></i> ' . $user["username"];
      echo '</a>';
      echo '<a href="User/logout.php" class="user-header-button js-toggle-user-nav">Log Out</a>';
    } else {
      echo '<a href="User/login.php" class="user-header-button js-toggle-user-nav">';
      echo '<i class="fa fa-user" aria-hidden="true"></i> Log In';
      echo '</a>';
      echo '<a href="User/register.php" class="user-header-button js-toggle-user-nav">';
      echo '<i class="fa fa-user" aria-hidden="true"></i> Sign Up';
      echo '</a>';
    }
  } else {
    echo '<a href="User/login.php" class="user-header-button js-toggle-user-nav">';
    echo '<i class="fa fa-user" aria-hidden="true"></i> Log In';
    echo '</a>';
    echo '<a href="User/register.php" class="user-header-button js-toggle-user-nav">';
    echo '<i class="fa fa-user" aria-hidden="true"></i> Sign Up';
    echo '</a>';
  }
  ?>
</div>

            </div>
          </div>
        </div>
      </div>


      <div class="header-nav">
        <div class="container">
          <div class="header-nav-inner-container">
            <a class="toggle-mobile-menu js-toggle-mobile-menu d-lg-none" href="#/">
              <i class="fas fa-bars fa-2x"></i>
            </a>
            <!-- DESKTOP MENU HERE-->
            <div class="desktop-menu d-none d-lg-flex">
              <ul class="main-menu">
                <li class="li-menu">
                  <a href="#">
                    Danh Muc San Pham
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                  </a>
                  <ul class="submenu">
                    <?php foreach ($cates as $key => $c) { ?>
                      <li>
                        <a href="product.php?cate_id=<?= $c["cate_id"] ?>"><?= $c["cate_name"] ?></a>
                      </li>
                    <?php } ?>
                  </ul>
                </li>
                <li class="li-menu">
                  <a href="home.php">
                    Home
                  </a>
                </li>
                <li class="li-menu">
                  <a href="about.php">
                    About Us
                  </a>
                </li>
                <li class="li-menu">
                  <a href="product.php">
                    Products
                  </a>
                </li>
                <li class="li-menu">
                  <a href="#">
                    News and Events
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                  </a>
                  <ul class='submenu'>
                    <li> <a href='shopping_guide.php'> Shopping Guide</a></li>
                    <li> <a href='news.php'> News</a></li>
                  </ul>
                </li>
                <li class="li-menu">
                  <a href="contact.php">
                    Contact
                  </a>
                </li>
              </ul>

            </div>
            <!-- END DESKTOP MENU HERE-->

          </div>
        </div>
      </div>
    </header>
  </div>
  <div id="success-box">
    <div class="cart-success">
      <div class="icon"><img src="../public/images/icon/icons8-success-50.png" alt=""></div>
      <div>Successfully added product to cart!</div>
    </div>
  </div>

  <script>
    load_cart_item_number();

    function load_cart_item_number() {
      $.ajax({
        url: '../handles_page/action.php',
        method: 'GET',
        data: {
          cartItem: 'cart_item'
        },
        success: function (response) {
          $("#cart-item").text(response); // Update the cart item count in the span
        }
      });
    }
  </script>