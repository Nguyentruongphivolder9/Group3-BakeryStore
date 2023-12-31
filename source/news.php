<?php
require_once("connect/connectDB.php");
require_once("./handles_page/pagination.php");


$cate = executeResult("SELECT c.new_cate_id, c.new_cate_name 
                        FROM tb_news_cate c
                        INNER JOIN tb_news p 
                        ON c.new_cate_id = p.new_cate_id 
                        GROUP BY c.new_cate_name DESC");
$product = executeResult(("SELECT * FROM tb_news"));
$limit = 3;
$page = 1;
$number = 0;
$cate_id = $countResult = '';
if (isset($_GET['page'])) {
  $page = $_GET['page'];

}
$firstIndex = ($page - 1) * $limit;

if (isset($_GET['cate_id']) && !empty($_GET['cate_id'])) {
  $cate_id = $_GET['cate_id'];
  $sql = 'SELECT * from tb_news where deleted = 0 and new_cate_id = ' . $cate_id . ' ORDER BY new_id DESC limit ' . $firstIndex . ',' . $limit;
  $product = executeResult($sql);
  $countResult = executeSingleResult("SELECT count(new_id) AS total from tb_news where deleted = 0 and new_cate_id = $cate_id");
} else {
  $countResult = executeSingleResult("SELECT count(new_id) AS total from tb_news where deleted = 0");
  $sql = 'SELECT * from tb_news where deleted = 0 ORDER BY new_id DESC limit ' . $firstIndex . ',' . $limit;
  $product = executeResult($sql);
}

// // Thêm điều kiện để hiển thị danh mục được chọn
// if (isset($_GET['cate_id']) && !empty($_GET['cate_id'])) {
//   $selected_cate_id = $_GET['cate_id'];
//   $selected_cate_name = '';
//   foreach ($cate as $c) {
//     if ($c['new_cate_id'] == $selected_cate_id) {
//       $selected_cate_name = $c['new_cate_name'];
//       break;
//     }
//   }
// }
if ($countResult != null) {
  $count = $countResult['total'];
  $number = ceil($count / $limit);
}
// if (isset($_GET["new_cate_id"])) {
//   $cate_id_filter = $_GET["new_cate_id"];
//   $cateFilter = executeSingleResult("SELECT cate_name FROM tb_news_cate WHERE new_cate_id = $cate_id_filter");
// }
// function checkedFilter($value)
// {
//   global $cate_id_filter;
//   echo $cate_id_filter == $value ? "checked" : "";
// }
?>

<head>
  <style>
    .pagination-prod {
      position: relative;
      width: 100%;
      text-align: center;
      margin-top: 30px;
    }

    .pagination-prod .prod-page-box {
      position: relative;
      margin: 0 auto;
      display: flex;
      gap: 0.5rem;
    }

    .pagination-prod .prod-page-box .prod-page-item a {
      padding: 0.5rem 1rem;
      font-size: 16px;
      color: #000;
      border-radius: 4px;
    }

    .pagination-prod .prod-page-box .prod-page-item.active a {
      background-color: #4b36ef;
      color: #fff;
    }
  </style>
</head>
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
          <a href="tin-tuc" itemprop="item">
            <span itemprop="name">Tin tức - Sự kiện</span>
            <meta itemprop="position" content="2" />
          </a>
        </li>
      </ol>
    </nav>
  </div>
</div>
<section class="section-paddingY blog-section">
  <!-- <div class="section-loader">
    <i class="fas fa-spinner fa-5x fa-pulse"></i>
  </div> -->
  <div class="container">
    <!-- <div class="section-header">
      <p class="section-title">Tin tức - Sự kiện</p>
    </div> -->
    <div class="row">
      <div class="col-md-3">
        <ul class="menu-category">
          <li><span class="title-category">Danh mục Tin Tức</span></li>
          <hr>
          <?php foreach ($cate as $c) { ?>
            <li class="item-nav">
              <a href="?cate_id=<?= $c["new_cate_id"] ?>">
                <?php echo $c["new_cate_name"] ?>
              </a>
            </li>
          <?php } ?>
        </ul>
      </div>
      <div class="col-md-9">
        <div class="section-header">
          <p class="section-title"></p>
          <input type="hidden" name="cate_id" value="1">
        </div>
        <div class="section-body">
          <div class="row">
            <?php foreach ($product as $p) { ?>
              <div class="col-6 col-sm-6 col-lg-4 col-xl-4 pl-1 pr-1 my-2">
                <div class="one-product-container">
                  <div class="product-images">
                    <a href="new_details.php?new_id=<?= $p["new_id"] ?>">
                      <div class="product-image hover-animation" href="san-pham/opera-cake-27">
                        <img src="../<?php echo $p["new_image"] ?>" alt="Opera Cake " />
                        <img src="../<?php echo $p["new_image"] ?>" alt="Opera Cake " />
                      </div>
                    </a>

                  </div>
                  <div class="product-info">
                    <p class="product-name">
                      <a href="new_details.php?new_id=<?= $p["new_id"] ?>">
                        <?php echo $p["new_title"] ?>
                      </a>
                    </p>
                    <p class="article-description">
                    <div ><?= $p["new_summary"] ?></div>
                    </p>
                  </div>
                </div>
              </div>
            <?php } ?>
            <!-- <div class="col-12 col-sm-6 col-lg-4 col-xl-4 mt-4">
          <div class="article-column-container">
            <div class="article-image">
              <a class="product-image hover-animation" href="tin-tuc/bo-suu-tap-banh-trung-thu-2022-6">
                <img src="source/TinTuc/puppets-1.jpg" alt="">
              </a>
              <span class="name-category">Tin tức</span>
            </div>
            <div class="article-info">
              <p class="article-title">
                <a href="tin-tuc/bo-suu-tap-banh-trung-thu-2022-6">bộ sưu tập b&aacute;nh trung thu 2022</a>
              </p>
              <p class="article-description">K&Yacute; ỨC TRĂNG TR&Ograve;N &ndash; MONG ƯỚC ĐO&Agrave;N VI&Ecirc;N
                Tết Trung Thu l&agrave; một trong những ng&agrave;y tết trọng đại của d&acirc;n tộc Việt Nam
                v&agrave; l&agrave; dịp gia đ&igrave;nh qu&acirc;y quần đo&agrave;n tụ c&ugrave;ng&#8230;</p>
            </div>
          </div>
        </div>
         -->
          </div>
          <div class="section-bottom has-pagination">
            <div class="website-pagination">
              <div class="prod-page-box">
                <?php
                for ($i = 1; $i <= $number; $i++) {
                  echo '<a href="?page=' . $i . '&cate_id=' . $cate_id . '">' . $i . '</a>';
                }
                ?>
              </div>

            </div>
          </div>
        </div>
      </div>
      <!-- <div class="section-body get-product-box"></div> -->
    </div>
  </div>
  <!-- <div class="section-bottom has-pagination">
      <div class="website-pagination">

      </div>
    </div> -->
  </div>
</section>

<?php include("layout/footer.php"); ?>