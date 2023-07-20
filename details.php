<<<<<<< HEAD
<?php 
require_once('connect/connectDB.php');

$id = 4;
$product = executeSingleResult("select * from tb_products where product_id = $id");

$name = $product["product_name"];


?>

=======
<?php
require_once('backend/connect/connectDB.php');

// if(isset($_POST["id"])){
//   $id = $_POST["id"];
// }
$id = 2;

$product = executeResult("SELECT * FROM tb_products where product_id = $id");
?>
>>>>>>> 2fb455e9860e1b9928117ca5ca420fcb353ae717
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>
    Bánh Mousse Chanh Leo | Bánh Sinh Nhật | Mousse Passion Fruit</title>
  <meta name="description" content="Bánh Mousse Chanh Leo, Mousse Passion Fruit">
  <meta name="keywords" content="Bánh Mousse Chanh Leo, Mousse Passion Fruit">
  <!-- Favicon -->
  <link rel="apple-touch-icon" href="source/icon/logo website2.png">
  <link rel="icon" type="image/png" href="source/icon/logo website2.png">
  <link rel="icon" type="image/png" href="source/icon/logo website2.png">

  <meta property="og:title" content="Bánh Mousse Chanh Leo | Bánh Sinh Nhật | Mousse Passion Fruit" />
  <meta property="og:site_name" content="BÁNH SINH NHẬT | BÁNH TRUNG THU | BÁNH SỰ KIỆN | HỘP QUÀ TRUNG THU" />
  <meta property="og:description" content="Bánh Mousse Chanh Leo, Mousse Passion Fruit" />
  <meta property="og:url" content="san-pham/mousse-chanh-leo-5" />
  <meta property="og:image" content="source/Bánh%20Sinh%20Nhật%20THB/Banh%20Sinh%20Nhat%20003.jpg" />
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:site" content="Bánh Mousse Chanh Leo | Bánh Sinh Nhật | Mousse Passion Fruit" />
  <meta name="twitter:title" content="Bánh Mousse Chanh Leo | Bánh Sinh Nhật | Mousse Passion Fruit" />
  <meta name="twitter:description" content="Bánh Mousse Chanh Leo, Mousse Passion Fruit" />
  <meta name="twitter:image" content="source/Bánh%20Sinh%20Nhật%20THB/Banh%20Sinh%20Nhat%20003.jpg" />

  <!-- Favicon -->

  <!-- FONT -->
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Cabin" />
  <!-- FONT -->

  <!-- PLUGIN CSS -->
  <link rel="stylesheet" href="public/plugins/css/bootstrap4.min.css">
  <link rel="stylesheet" href="public/plugins/css/owl.carousel.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css">
  <link rel="stylesheet" href="lightslider/dist/css/lightslider.css">
  <link rel="stylesheet" href="ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">


  <!-- PLUGIN CSS -->

  <link href="public/frontend/css/style.css?v=0.0.7" rel="stylesheet">
  <!-- Meta Pixel Code -->
  <script>
    !function (f, b, e, v, n, t, s) {
      if (f.fbq) return; n = f.fbq = function () {
        n.callMethod ?
          n.callMethod.apply(n, arguments) : n.queue.push(arguments)
      };
      if (!f._fbq) f._fbq = n; n.push = n; n.loaded = !0; n.version = '2.0';
      n.queue = []; t = b.createElement(e); t.async = !0;
      t.src = v; s = b.getElementsByTagName(e)[0];
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
    function gtag() { dataLayer.push(arguments); }
    gtag('js', new Date());

    gtag('config', 'UA-232235704-1');
  </script><!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-QERL8JJ8K1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag() { dataLayer.push(arguments); }
    gtag('js', new Date());

    gtag('config', 'G-QERL8JJ8K1');
  </script>
</head>

<body>

<?php include("layout/header.php"); ?>

  <div class="breadcrumb">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
            <a href="" itemprop="item">
              <span itemprop="name">Trang chủ</span>
              <meta itemprop="position" content="1" />
            </a>
          </li>
          <li class="breadcrumb-item active" aria-current="page" itemprop="itemListElement" itemscope
            itemtype="https://schema.org/ListItem">
            <a href="danh-muc/banh-sinh-nhat" itemprop="item">
              <span itemprop="name">B&aacute;nh Sinh Nhật</span>
              <meta itemprop="position" content="2" />
            </a>
          </li>
          <li class="breadcrumb-item active" aria-current="page" itemprop="itemListElement" itemscope
            itemtype="https://schema.org/ListItem">
            <a href="#" itemprop="item">
              <span itemprop="name">Mousse Chanh Leo</span>
              <meta itemprop="position" content="3" />
            </a>
          </li>
        </ol>
      </nav>
    </div>
  </div>
  <section class="section-paddingY middle-section product-page">
    <div class="container">
      <div class="row">
        <div class="col-md-3">

          <ul class="menu-category">
            <li><span class="title-category">Danh mục sản phẩm</span></li>
            <hr>
            <li class="item-nav">
              <a href="#" class="open-submenu active">
                B&aacute;nh Sinh Nhật
                <i class="fa fa-angle-down" aria-hidden="true"></i>
              </a>
              <ul class="submenu-category show">
                <li class="item-nav">
                  <a href="danh-muc/gato-kem-tuoi">
                    Gato kem tươi
                  </a>
                </li>
                <li class="item-nav">
                  <a href="danh-muc/gato-kem-bo">
                    Gato kem bơ
                  </a>
                </li>
                <li class="item-nav">
                  <a href="danh-muc/banh-mousse">
                    B&aacute;nh mousse
                  </a>
                </li>
                <li class="item-nav">
                  <a href="danh-muc/banh-cuoi">
                    B&aacute;nh cưới
                  </a>
                </li>
                <li class="item-nav">
                  <a href="danh-muc/banh-valentine">
                    B&aacute;nh valentine
                  </a>
                </li>
                <li class="item-nav">
                  <a href="danh-muc/banh-su-kien">
                    B&aacute;nh sự kiện
                  </a>
                </li>
                <li class="item-nav">
                  <a href="danh-muc/banh-entremet">
                    B&aacute;nh Entremet
                  </a>
                </li>
              </ul>
            </li>
            <li class="item-nav">
              <a href="#" class="open-submenu ">
                B&aacute;nh Sinh Nhật Cho B&eacute;
                <i class="fa fa-angle-down" aria-hidden="true"></i>
              </a>
              <ul class="submenu-category ">
                <li class="item-nav">
                  <a href="danh-muc/banh-hinh-so">
                    B&aacute;nh h&igrave;nh số
                  </a>
                </li>
                <li class="item-nav">
                  <a href="danh-muc/banh-12-con-giap">
                    B&aacute;nh 12 con gi&aacute;p
                  </a>
                </li>
                <li class="item-nav">
                  <a href="danh-muc/banh-sang-tao">
                    B&aacute;nh s&aacute;ng tạo
                  </a>
                </li>
              </ul>
            </li>
            <li class="item-nav">
              <a href="#" class="open-submenu ">
                Cookies v&agrave; Mini Cake
                <i class="fa fa-angle-down" aria-hidden="true"></i>
              </a>
              <ul class="submenu-category ">
                <li class="item-nav">
                  <a href="danh-muc/choux-pastries">
                    Choux Pastries
                  </a>
                </li>
                <li class="item-nav">
                  <a href="danh-muc/banh-mi">
                    B&aacute;nh M&igrave;
                  </a>
                </li>
                <li class="item-nav">
                  <a href="danh-muc/cookies">
                    Cookies
                  </a>
                </li>
                <li class="item-nav">
                  <a href="danh-muc/macaron">
                    Macaron
                  </a>
                </li>
              </ul>
            </li>
            <li class="item-nav">
              <a href="#" class="open-submenu ">
                B&aacute;nh trung thu
                <i class="fa fa-angle-down" aria-hidden="true"></i>
              </a>
              <ul class="submenu-category ">
                <li class="item-nav">
                  <a href="danh-muc/hop-qua-trung-thu">
                    Hộp Qu&agrave; Trung Thu
                  </a>
                </li>
                <li class="item-nav">
                  <a href="danh-muc/banh-trung-thu-cac-vi">
                    B&aacute;nh trung thu c&aacute;c vị
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>



        <div class="col-md-9">
          <div class="row">
            <div class="col-12 col-lg-7">
              <div class="detail-header show-mobile">
<<<<<<< HEAD
                <h5 class="product-name">helllo</h5>
                <span>(Cake Mousse Passion Fruit)</span>  
=======

                  <h5 class="product-name">
                    <?php echo $product["product_name"] ?>
                  </h5>

                <span>(Cake Mousse Passion Fruit)</span>
>>>>>>> 2fb455e9860e1b9928117ca5ca420fcb353ae717
              </div>
              <div class="product-imgs">
                <ul id="lightSlider">
                  <li data-thumb="source/B&aacute;nh Sinh Nhật THB/Banh Sinh Nhat 003.jpg">
                    <a href="source/B&aacute;nh Sinh Nhật THB/Banh Sinh Nhat 003.jpg" data-fancybox="gallery">

                    <?php foreach ($product as $p) { ?>
                      <img src=<?php echo $p["image"] ?> class="img-fluid">
                    <?php } ?>
                    

                    </a>
                  </li>
                </ul>
                <div class="share mt-3">
                  <ul>
                    <li>Chia sẻ: </li>
                    <li>
                      <a target="_blank" href="sharer/sharer.php?u=san-pham/mousse-chanh-leo-5"
                        class="fb-xfbml-parse-ignore">
                        <img src="public/frontend/assets/img/icons/Facebook.png" alt="">
                      </a>
                    </li>
                    <li>
                      <a class="twitter-share-button" target="_blank"
                        href="https://twitter.com/share?text=&amp;url=san-pham/mousse-chanh-leo-5" data-size="large">
                        <img src="public/frontend/assets/img/icons/Twitter.png" alt=""></a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-5">
              <div class="product-detail-container">
                <div class="detail-header show-desktop">
<<<<<<< HEAD
                  <h5 class="product-name"><?= $product["product_name"] ?></h5>
=======
                  <?php foreach ($product as $p) { ?>
                    <h5 class="product-name">
                      <?php echo $p["product_name"] ?>
                    </h5>
                  <?php } ?>
>>>>>>> 2fb455e9860e1b9928117ca5ca420fcb353ae717
                  <span>(Cake Mousse Passion Fruit)</span>
                </div>
                <div class="detail-body">
                  <span class="option-result">Mousse 20cm</span>
                  <div class="button-zone">
                    <div class="row">
                      <b class="col-5">Tình trạng:</b>
                      <span class="col-7">Hết h&agrave;ng</span>
                    </div>
                    <div class="row">
                      <b class="col-5">Mã sản phẩm:</b>
                      <span class="col-7"></span>
                    </div>
                    <div class="row">
                      <b class="col-5">Thành phần:</b>
                      <span class="col-7">chanh leo, đường trắng, gelatin, whipping cream tatua, Cream
                        cheese...</span>
                    </div>
                    <div class="row">
                      <b class="col-5">Bảo quản:</b>
                      <span class="col-7">Bảo quản m&aacute;t từ 2&deg;C - 6&deg;C</span>
                    </div>
                    <div class="size-zone option-zone row">
                      <b class="col-md-12">Kích thước:</b>
                      <ul class="product-sizes">
                        <li>
                          <label class="option-container btn active" for="size9">
                            Mousse 20cm
                            <input type="radio" name="size" id="size9" class="input-option size-option" value="9"
                              checked data-value="Mousse 20cm">
                          </label>
                        </li>
                        <li>
                          <label class="option-container btn " for="size10">
                            Mousse 22cm
                            <input type="radio" name="size" id="size10" class="input-option size-option" value="10"
                              data-value="Mousse 22cm">
                          </label>
                        </li>
                        <li>
                          <label class="option-container btn " for="size11">
                            Mousse 30cm
                            <input type="radio" name="size" id="size11" class="input-option size-option" value="11"
                              data-value="Mousse 30cm">
                          </label>
                        </li>
                      </ul>
                    </div>
                    <div class="row">
                      <b class="col-md-4">
                        Giá bán:
                      </b>
                      <div class="col-md-7">
                        <span class="product-price">
                          
                        <?php foreach ($product as $p) { ?>
                          <span class="price text-price"><?php echo $p["price"] ?></span>
                        <?php } ?>
                        
                        </span>
                      </div>
                    </div>
                    <b> Giá có thể thay đổi theo kích cỡ:</b> <span class="text-yellow">Liên hệ</span>
                    <input class="quantity-input" type="hidden" min="1" value="1" autocomplete="off" />
                    <button class="add-to-cart js-add-to-cart">
                      <img src="public/frontend/assets/img/icons/shopping-bag.svg" alt="" />
                      Thêm vào giỏ
                    </button>
                    <button class="add-to-cart mt-3 contact-card">
                      Đặt hàng nhanh nhất <br> 090 754 6668 | 096 938 6611
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 mt-3">
              <div class="card-content-pro">
                <ul class="nav nav-pills tabs-categories" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab-left" data-toggle="pill" href="#pills-home" role="tab"
                      aria-controls="pills-home" aria-selected="true">Mô
                      tả sản phẩm</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
                      aria-controls="pills-profile" aria-selected="false">
                      Giao hàng
                    </a>
                  </li>
                </ul>

                <div class="tab-content mt-3" id="pills-tabContent">
                  <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                    aria-labelledby="pills-home-tab">
                    
                      <p><span style="font-size: 12pt;">
                        <?php foreach ($product as $p) { ?>
                          <?php echo $p["description"] ?>
                          <?php } ?>
                      </span></p>
                       
                  </div>
                  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                  </div>
                </div>
              </div>
              <div class="tags">
                <i class="fa fa-tags" aria-hidden="true"></i>
                <p><a href="danh-muc/banh-sinh-nhat">B&aacute;nh Sinh Nhật</a>, <a
                    href="danh-muc/banh-sinh-nhat">B&aacute;nh Sinh Nhật Tại H&agrave; Nội</a>, <a
                    href="danh-muc/banh-sinh-nhat">B&aacute;nh Sinh Nhật H&igrave;nh Logo C&ocirc;ng Ty</a>, <a
                    href="danh-muc/banh-cho-be">B&aacute;nh Sinh Nhật Cho B&eacute; Trai</a>, <a
                    href="danh-muc/banh-cho-be">B&aacute;nh Sinh Nhật Cho B&eacute; G&aacute;i</a></p>
                <p><a href="san-pham/banh-mousse-chanh-leo-5">B&aacute;nh Mousse Chanh Leo</a></p>
                <p>&nbsp;</p>
              </div>
            </div>

            <div class="col-12 mt-3">
              <section class="testimonial">
                <div class="container">
                  <div class="row">
                    <div class="section-header">
                      <p class="section-title">Feeback</p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="clients-carousel owl-carousel">
                      <div class="single-box">
                        <div class="content">
                          <p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam, doloribus minima
                            praesentium
                            laborum ea earum."</p>
                          <h4>Jason Doe</h4>
                        </div>
                      </div>
                      <div class="single-box">
                        <div class="content">
                          <p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam, doloribus minima
                            praesentium
                            laborum ea earum."</p>
                          <h4>Dave Wood</h4>
                        </div>
                      </div>
                      <div class="single-box">
                        <div class="content">
                          <p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam, doloribus minima
                            praesentium
                            laborum ea earum."</p>
                          <h4>Matt Demon</h4>
                        </div>
                      </div>
                      <div class="single-box">
                        <div class="content">
                          <span class="rating-star"><i class="icofont-star"></i><i class="icofont-star"></i><i
                              class="icofont-star"></i><i class="icofont-star"></i><i class="icofont-star"></i></span>
                          <p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam, doloribus minima
                            praesentium
                            laborum ea earum."</p>
                          <h4>jimmy kimmel</h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
            </div>


            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js">
            </script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.min.js">
            </script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js">
            </script>
            <script>
              $('.clients-carousel').owlCarousel({
                loop: true,
                nav: false,
                autoplay: true,
                autoplayTimeout: 5000,
                animateOut: 'fadeOut',
                animateIn: 'fadeIn',
                smartSpeed: 450,
                margin: 30,
                responsive: {
                  0: {
                    items: 1
                  },
                  768: {
                    items: 2
                  },
                  991: {
                    items: 2
                  },
                  1200: {
                    items: 2
                  },
                  1920: {
                    items: 2
                  }
                }
              });
            </script>

            <div class="col-12 mt-3">
              <div class="section-header">
                <p class="section-title">Sản phẩm gợi ý</p>
              </div>
              <div class="section-body">
                <div class="owl-products-some owl-carousel owl-theme">
                  <div class="one-product-container">

                    <div class="product-images">
                      <a class="product-image hover-animation" href="san-pham/opera-cake-27">
                        <img src="source/B&aacute;nh Sinh Nhật THB/Banh opera 001.jpg" alt="Opera Cake " />
                        <img src="source/B&aacute;nh Sinh Nhật THB/Banh opera 001.jpg" alt="Opera Cake " />
                      </a>
                    </div>
                    <div class="product-info">
                      <p class="product-name">
                        <a href="#/">
                          Opera Cake
                        </a>
                      </p>
                      <div class="product-price">

                        <span class="price">400,000&#8363;</span>
                      </div>
                    </div>
                  </div>
                  <div class="one-product-container">

                    <div class="product-images">
                      <a class="product-image hover-animation" href="san-pham/cream-cheese-layer-cake-36">
                        <img src="source/B&aacute;nh Sinh Nhật/kembo 005a.jpg" alt="Cream Cheese Layer Cake" />
                        <img src="source/B&aacute;nh Sinh Nhật/kembo 005a.jpg" alt="Cream Cheese Layer Cake" />
                      </a>
                    </div>
                    <div class="product-info">
                      <p class="product-name">
                        <a href="#/">
                          Cream Cheese Layer Cake
                        </a>
                      </p>
                      <div class="product-price">

                        <span class="price">350,000&#8363;</span>
                      </div>
                    </div>
                  </div>
                  <div class="one-product-container">

                    <div class="product-images">
                      <a class="product-image hover-animation" href="san-pham/red-velvet-cake-heart-71">
                        <img src="source/B&aacute;nh Sinh Nhật/Red Velvet Cake 1.jpg" alt="Red Velvet Cake Heart" />
                        <img src="source/B&aacute;nh Sinh Nhật/Red Velvet Cake 1.jpg" alt="Red Velvet Cake Heart" />
                      </a>
                    </div>
                    <div class="product-info">
                      <p class="product-name">
                        <a href="#/">
                          Red Velvet Cake Heart
                        </a>
                      </p>
                      <div class="product-price">

                        <span class="price">Liên hệ</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php include("layout/footer.php"); ?>

  <div id="fb-root"></div>
  <div class='zalome'>
    <a href='#' target='_blank'>
      <img alt='icon zalo' src='public/frontend/assets/img/icons/icon-zalo.png' />
    </a>
  </div>
  <script>
    (function (d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s);
      js.id = id;
      js.src =
        'vi_VN/sdk.js#xfbml=1&version=v3.2&appId=1378687992242263&autoLogAppEvents=1';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
  </script>
  <!-- Messenger Plugin chat Code -->
  <div id="fb-root"></div>

  <!-- Your Plugin chat code -->
  <div id="fb-customer-chat" class="fb-customerchat">
  </div>

  <script>
    var chatbox = document.getElementById('fb-customer-chat');
    chatbox.setAttribute("page_id", "111597538192489");
    chatbox.setAttribute("attribution", "biz_inbox");
  </script>

  <!-- Your SDK code -->
  <script>
    window.fbAsyncInit = function () {
      FB.init({
        xfbml: true,
        version: 'v16.0'
      });
    };

    (function (d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'vi_VN/sdk/xfbml.customerchat.js';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
  </script>
  <script>
    // When the user scrolls the page, execute myFunction
    // window.onscroll = function () { myFunction() };

    // Get the header
    var header = document.getElementById("HeaderTop");

    // Get the offset position of the navbar
    var sticky = header.offsetTop;

    // Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
    function myFunction() {
      if (window.pageYOffset > sticky) {
        header.classList.add("fixed");
      } else {
        header.classList.remove("fixed");
      }
    }
  </script>
  <button class="gototop text-yellow">
    <img src="public/frontend/assets/img/icons/goto.png" alt="ve dau trang" style="margin-right: 10px"> Về đầu trang
  </button>

  <script src="public/plugins/js/jquery3.3.1.min.js"></script>
  <script>
    var baseUrl = "";
  </script>
  <script src="public/frontend/assets/js/config.js"></script>


  <script src="public/plugins/js/bootstrap4.min.js"></script>
  <script src="public/plugins/js/owl.carousel.min.js"></script>
  <script src="ajax/libs/lightslider/1.1.6/js/lightslider.min.js"></script>
  <script src="ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>



  <script src="public/frontend/assets/js/main.js?v=1.0.8"></script>
  <script src="public/myplugins/js/messagebox.js"></script>

  <!-- Load Facebook SDK for JavaScript -->
  <div id="fb-root"></div>
  <script>
    (function (d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s);
      js.id = id;
      js.src = "en_US/sdk.js#xfbml=1&version=v3.0";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
  </script>

  <script>
    var colors = [{ "id": null, "name": "Mousse 20cm" }, 
    { "id": null, "name": "Mousse 22cm" }, 
    { "id": null, "name": "Mousse 30cm" }];
    var sizes = [{ "id": "9", "name": "Mousse 20cm" },
     { "id": "10", "name": "Mousse 22cm" }, 
     { "id": "11", "name": "Mousse 30cm" }];
    
    var productDetails = [{ "id": "363", "product_id": "5", "size": "9", "color": null, "options": null, "quantity": "0", "original_price": "320000", "price": "380000", "status": "1", "image": null, "created_at": "2023-04-10 13:21:29", "option_name": "Mousse 20cm", "size_id": "9" }, { "id": "364", "product_id": "5", "size": "10", "color": null, "options": null, "quantity": "0", "original_price": "320000", "price": "420000", "status": "1", "image": null, "created_at": "2023-04-10 13:21:29", "option_name": "Mousse 22cm", "size_id": "10" }, { "id": "365", "product_id": "5", "size": "11", "color": null, "options": null, "quantity": "0", "original_price": "320000", "price": "500000", "status": "1", "image": null, "created_at": "2023-04-10 13:21:29", "option_name": "Mousse 30cm", "size_id": "11" }];
 // console.log(productDetails);
  </script>
  <script src="public/frontend/assets/js/product_page.js"></script>
  </div>
</body>

</html>