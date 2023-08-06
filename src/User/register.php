<?php
session_start();
$username = $email = $phone = $password = '' ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="../../public/backend/css/login-register.css">
</head>
<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <form action="code-User.php" method="post">
                    <h2 class="login-h2">Register Form</h2>
                    <div class="inputbox">
                        <ion-icon name="person"></ion-icon>
                        <input type="text" name="username" required value="<?php echo $username ?>" >
                        <label for="">Username:</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="mail"></ion-icon>
                        <input type="email" name="email"  value="<?php echo $email ?>"required >
                        <label for="">Email :</label>
                    </div>
                    <div class="inputbox">
                    <ion-icon name="call"></ion-icon>
                        <input type="text" name="phone" value="<?php echo $phone ?>" required >
                        <label for="">Phone :</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-open"></ion-icon>
                        <input type="password" name="password" value="<?php echo $password ?>" required>
                        <label for="">Your Password :</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed"></ion-icon>
                        <input type="password" name="repeatPassword" required>
                        <label for="">Repeat Your Password :</label>
                    </div>
                    <button type="submit" name="submit-register-btn">Submit</button>
                    <div class="register">
                        <p> Tôi đã có tài khoản <a href="../../src/User/login.php"> Đăng Nhập </a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <?php if(isset($_SESSION['status'])) { ?>
        <script>
            alert('<?php echo $_SESSION['status']; ?>');
        </script>
    <?php
        unset($_SESSION['status']); // Clear the session status after displaying
    }
    ?>
</body>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</html>