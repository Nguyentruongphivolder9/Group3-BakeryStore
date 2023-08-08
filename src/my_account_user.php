<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require_once("connect/connectDB.php");
if (isset($_SESSION["auth_user"])) {
    var_dump($_SESSION['auth_user']);
}
?>

<head>
    <style>
        .my-account {
            width: 100%;
            background-color: #dedede2e;
            padding: 20px 0px 50px;
        }

        .my-account .my-account-box {
            width: 80%;
            margin: auto;
            display: flex;
            align-items: stretch;
        }

        .my-account .my-account-box .sidebar-user {
            flex: 0 0 190px;
            font-size: 14px;
        }

        .my-account .my-account-box .sidebar-user .name-user {
            width: 100%;
            height: 5rem;
            display: flex;
            padding: 15px 0;
            align-items: center;
            border-bottom: 1px solid #ccc;
        }

        .my-account .my-account-box .sidebar-user .name-user img {
            width: 3.025rem;
            height: 3.025rem;
            vertical-align: middle;
            border-radius: 50%;
        }

        .my-account .my-account-box .sidebar-user .name-user h4 {
            width: 100%;
            height: 3.025rem;
            padding: 0px 0px 0px 15px;

        }

        .my-account .my-account-box .sidebar-user .sidebar {
            width: 100%;
            height: auto;
            position: relative;
            padding-top: 20px;
        }

        .my-account .my-account-box .sidebar-user .sidebar .nav-item {
            width: 100%;
            height: 40px;
            margin-bottom: 10px;
        }

        .my-account .my-account-box .sidebar-user .sidebar .nav-item .nav-link {
            width: 100%;
            height: 100%;
            display: flex;
            gap: 0.7rem;
        }

        .my-account .my-account-box .sidebar-user .sidebar .nav-item:hover .nav-link p,
        .my-account .my-account-box .sidebar-user .sidebar .nav-item.active .nav-link p {
            color: red;
        }

        .my-account .my-account-box .action-page-box {
            flex: 1;
            padding-left: 30px;
        }

        /* profile */
        .my-profile-page {
            width: 100%;
            height: 100%;
            display: block;
            background-color: #fff;
            padding: 0 1.875rem 0.625rem;
            border-radius: 3px;
        }

        .my-profile-page .profile-title {
            border-bottom: 0.0625rem solid #efefef;
            padding: 1.125rem 0;
        }

        .my-profile-page .profile-title h1 {
            margin: 0;
            font-size: 1.125rem;
            font-weight: 500;
            line-height: 1.5rem;
            text-transform: capitalize;
            color: #333;
        }

        .my-profile-page .profile-title p {
            margin-top: 0.1875rem;
            font-size: .875rem;
            line-height: 1.0625rem;
            color: #555;
        }

        .my-profile-page .update-profile-box {
            padding-top: 1.875rem;
            display: flex;
            align-items: stretch;
            justify-content: space-between;
        }

        .my-profile-page .update-profile-box .profile-form {
            width: 100%;
            padding-right: 3.125rem;
        }

        .my-profile-page .update-profile-box .profile-form table tr td {
            padding-bottom: 30px;
        }

        .my-profile-page .update-profile-box .profile-form table tr td:first-child {
            text-align: right;
            width: 25%;
        }

        .my-profile-page .update-profile-box .profile-form table tr td:last-child {
            box-sizing: border-box;
            padding-left: 20px;
            width: 75%;
        }

        .my-profile-page .update-profile-box .profile-form .css-input input {
            width: 100%;
            padding: 10px;
            border: 1px solid #efefef;
            outline: none;
            border-radius: 3px;
            font-size: 16px;
            color: #141212;
            transition: .5s;
        }

        .my-profile-page .update-profile-box .profile-update-image {
            width: 17.8rem;
        }

        .my-profile-page .update-profile-box .profile-update-image .profile-image-box {
            border-left: 0.0625rem solid #efefef;
        }

        .my-profile-page .update-profile-box .profile-update-image .profile-image {
            flex-direction: column;
            width: 10.6931rem;
            margin: 0 auto;
            text-align: center;
        }

        .my-profile-page .update-profile-box .profile-update-image .profile-image .btn-photo input[type="file"] {
            visibility: hidden;
        }

        .my-profile-page .update-profile-box .profile-update-image .profile-image .btn-photo input[type="file"]::before {
            content: 'Choosen a photo';
            display: inline-block;
            border: 1px solid #efefef;
            border-radius: 3px;
            padding: 5px 8px;
            outline: none;
            white-space: nowrap;
            cursor: pointer;
            font-size: 16px;
            visibility: visible;
            margin-left: 20px;
        }

        .my-profile-page .update-profile-box .profile-update-image .profile-image .preview-photo {
            height: 6.25rem;
            width: 6.25rem;
            margin: 1.25rem 0;
            position: relative;
            margin: 10px auto;
            padding: 2px;
        }

        .my-profile-page .update-profile-box .profile-update-image .profile-image img {
            height: 100%;
            width: 100%;
            border-radius: 50%;
            object-fit: contain;
            vertical-align: middle;
        }

        .my-profile-page .update-profile-box .profile-update-image .profile-image .text {
            text-align: left;
            display: flex;
            flex-direction: column;
            padding-top: 10px;
        }

        .submit {
            background-color: red;
            padding: 0.4rem 0.9rem 0.4rem 0.9rem;
            font-weight: 500;
            font-size: 1rem;
            border-radius: 5px;
            border: none;
            transition: box-shadow 0.3s ease;
            box-shadow: 1px 1px 3px black;
        }
        .submit:hover {
            box-shadow: none;
        }
    </style>
</head>

<?php include("layout/header.php"); ?>
<section class="my-account">
    <div class="my-account-box">
        <div class="sidebar-user">
            <div class="name-user">
                <img src="../public/images/admin1.jpg" alt="">
                <h4> <?=$_SESSION['auth_user']['username'] ?> </h4>
            </div>
            <div class="sidebar">
                <ul>
                    <li class="nav-item active">
                        <a href="my_action_user/my_profile.php" class="nav-link">
                            <span class="material-symbols-sharp">person</span>
                            <p>My Account</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="my_action_user/purchase_order.php" class="nav-link">
                            <span class="material-symbols-sharp">shopping_bag</span>
                            <p>Purchase Order</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="my_action_user/warehouse_voucher.php" class="nav-link">
                            <span class="material-symbols-sharp">barcode_scanner</span>
                            <p> My Voucher</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="action-page-box" id="action-page-user">
            <?php include("my_action_user/my_profile.php"); ?>
        </div>
    </div>
    <?php if(isset($_SESSION['status'])) { ?>
        <script>
            alert('<?php echo $_SESSION['status']; ?>');
        </script>
    <?php
        unset($_SESSION['status']); // Clear the session status after displaying
    }
    ?>
</section>

<?php include("layout/footer.php"); ?>