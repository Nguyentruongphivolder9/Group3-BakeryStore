<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive </title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/408p82mzgtitwtkc01bmbjchrnbzm4tc67jdfy6ouuzd59uu/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-jquery@1/dist/tinymce-jquery.min.js"></script>

</head>

<body>
    <div class="container">
        <aside>
            <div class="top">
                <div class="logo">
                    <div class="img-logo">
                        <img src="../public/images/logo/Screenshot 2023-06-23 205633.png" alt="logo">
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
                        <a href="./dashboad.html" class="nav-link">
                            <span class="material-symbols-sharp">grid_view</span>
                            <h3>Dashboard</h3>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./customer.php" class="nav-link">
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
                                <a href="products/category.php">
                                    <span class="material-symbols-sharp unchecked">radio_button_unchecked</span>
                                    <span class="material-symbols-sharp checked">radio_button_checked</span>
                                    <h4>Category</h4>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="products/products.php">
                                    <span class="material-symbols-sharp unchecked">radio_button_unchecked</span>
                                    <span class="material-symbols-sharp checked">radio_button_checked</span>
                                    <h4>All Products</h4>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <div class="sub-btn nav-link">
                            <div class="title">
                                <span class="material-symbols-sharp">receipt_long</span>
                                <h3>Orders</h3>
                            </div>
                            <span class="material-symbols-sharp more">expand_more</span>
                            <span class="material-symbols-sharp less">expand_less</span>
                        </div>
                        <ul class="sub-menu">
                            <li class="menu-item">
                                <a href="./logIn.php">
                                    <span class="material-symbols-sharp unchecked">radio_button_unchecked</span>
                                    <span class="material-symbols-sharp checked">radio_button_checked</span>
                                    <h4>dsfsdfs</h4>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="./dashboad.html">
                                    <span class="material-symbols-sharp unchecked">radio_button_unchecked</span>
                                    <span class="material-symbols-sharp checked">radio_button_checked</span>
                                    <h4>detail</h4>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="./signIn.php" class="nav-link">
                            <span class="material-symbols-sharp">insights</span>
                            <h3>Analytics</h3>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./signIn.php" class="nav-link">
                            <span class="material-symbols-sharp">mail</span>
                            <h3>Messages</h3>
                            <span class="message-count">27</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./signIn.php" class="nav-link">
                            <span class="material-symbols-sharp">report</span>
                            <h3>Reports</h3>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./signIn.php" class="nav-link">
                            <span class="material-symbols-sharp">settings</span>
                            <h3>Settings</h3>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="products/add-product.php" class="nav-link">
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
                <div class="input-search">
                    <input type="search" placeholder="Search Data...">
                    <img src="images/search.png" alt="">
                </div>
                <div class="profile-theme">
                    <div class="theme-toggler">
                        <span class="material-symbols-sharp active">light_mode</span>
                        <span class="material-symbols-sharp">dark_mode</span>
                    </div>
                    <div class="profile">
                        <div class="info">
                            <p>Hey, <b>Ngoc Nhi</b></p>
                            <small class="text-muted">Admin</small>
                        </div>
                        <div class="profile-photo">
                            <img src="images/admin1.jpg" alt="admin 1">
                        </div>
                    </div>
                </div>
            </div>

            <div id="main-page">
                
            </div>
        </div>
    </div>
    <script>
      $('textarea#tiny').tinymce({
        height: 500,
        menubar: false,
        plugins: [
           'a11ychecker','advlist','advcode','advtable','autolink','checklist','export',
           'lists','link','image','charmap','preview','anchor','searchreplace','visualblocks',
           'powerpaste','fullscreen','formatpainter','insertdatetime','media','table','help','wordcount'
        ],
        toolbar: 'undo redo | a11ycheck casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist checklist outdent indent | removeformat | code table help'
      });
    </script>

    <script>
        $(document).ready(function () {
            function ajaxSidebar(url) {
                if (url != null) {
                    $.ajax({
                        url: url,
                    })
                        .done(function (response) {
                            $("#main-page").empty().append(response);
                        })
                        .fail(function () {
                            console.log("error");
                        })
                        .always(function () {
                            console.log("completed");
                        });
                }
            }

            $('.sidebar .nav-item .sub-btn').on('click', function () {
                $(this).next('.sub-menu').slideToggle();
                $(this).children('.more').toggle();
                $(this).children('.less').toggle();
            });

            $(".sidebar ul .nav-item").click(function (e) {
                e.preventDefault();
                const link = $(this).children('.nav-link').attr("href");

                $(this).siblings().removeClass("active");
                $(this).addClass("active");
                const hasSubBtn = $(this).children("div").hasClass("sub-btn");
                const hasMenuItem = $('.sidebar .menu-item').hasClass("active");
                if (!hasSubBtn && hasMenuItem) {
                    $('.sidebar .menu-item').removeClass("active");
                }
                ajaxSidebar(link);
                // click menu-item
                $(".menu-item").on('click', function (e) {
                    e.stopImmediatePropagation();
                    const linkItem = $(this).children('a').attr("href");
                    $(".menu-item").siblings().removeClass("active");
                    $(this).addClass("active");
                    ajaxSidebar(linkItem);
                    return false;
                });

                return false;
            });

        });
    </script>
    <script src="js/admin.js"></script>
</body>

</html>