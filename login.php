<?php
require_once 'connect.php';
require_once 'classes/User.php';
require_once 'classes/Login.php';
require_once 'config.php';
session_start();
$loginStatus = '';

if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) {
    // Nếu chưa đăng nhập, đặt biến $isLoggedIn thành false
    // và không chuyển hướng mà chỉ hiển thị nội dung của trang index.php
    $isLoggedIn = false;
} else {
    // Nếu đã đăng nhập, đặt biến $isLoggedIn thành true
    $isLoggedIn = true;
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn'])) {
    $loginIdentifier = $_POST['username'];
    $password = $_POST['password'];

    // Tạo một đối tượng User
    $user = new User('', $loginIdentifier, '', $password, '');

    // Tạo một đối tượng Login
    $login = new Login($user);

    // Xác thực người dùng
    if ($login->authenticate()) {
        // Xác thực thành công, chuyển hướng hoặc thực hiện các hành động khác
        $userData = $login->getUserDataFromDatabase();
        $_SESSION['user_id'] = $userData['user_id'];
        $_SESSION['name'] = $userData['name'];
        $_SESSION['isLoggedIn'] = true; // Đánh dấu người dùng đã đăng nhập
        header("Location: index.php");
        exit();
    } else {
        // Xác thực thất bại, đặt trạng thái đăng nhập
        $loginStatus = $login->getLoginStatus();
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="style.css">
    <style>
        #login{
            margin-top: 100px !important;
            width: 300px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            border: 2px solid red;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-spacing: 1px;
 
        }

        .title{
            text-align: center;
            margin-bottom: 20px;
            font-size: 25px;
            font-weight: bold;
            font-family: 'ADLaM Display Regular (in đậm)', sans-serif;
            color: red;
            text-transform: uppercase;
            letter-spacing: 1px;
            line-height: 1.2;
            text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
        }
        input {
            width: 100%;
            height: 45px;
            padding: 20px;
            color: #333;
            border: 1px solid #e1e1e1 !important;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        .button input[type="submit"] {
            background-color: #E95221;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 14px;
            margin-top: 3px;
        }

        .button input[type="submit"]:hover {
            background-color: #ff6f4d; /* Màu nền mới khi nút được hover */
        }
        .last{
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            font-weight: bold;
            color: red;
            text-transform: uppercase;
            letter-spacing: 1px;
            line-height: 1.2;
            text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
        }
        .error{
            color:#E95221;
            font-size: 14px;
        }
    </style>
</head>
<body>
<div id="wrapper">
        <div id="header">
            <div class="logo">
            <a href="index.php" >
                <img src="Images/logo.png" width="70px" height="50px" alt="">
            </a>
            </div>
            <div id="menu">
                <div class="item">
                    <a href="index.php">TRANG CHỦ</a>
                </div>
                <div class="item">
                    <a href="product.php">SẢN PHẨM</a>
                </div>
                <div class="item">
                    <a href="blog.php">BLOG</a>
                </div>
                <div class="item">
                    <a href="blog.php">GIỚI THIỆU</a>
                </div>
                <div class="item">
                    <a href="blog.php">LIÊN HỆ</a>
                </div>
            </div>
            <div id="actions">
                <div class="item">
                <?php
                // Kiểm tra xem người dùng đã đăng nhập hay chưa
                // Giả sử biến $isLoggedIn chứa trạng thái đăng nhập, nếu đăng nhập thành công thì $isLoggedIn = true

                if ($isLoggedIn) {
                    // Nếu đã đăng nhập, chuyển hướng đến trang information.php
                    echo '<a href="information.php"><img src="Images/user-regular-24.png" alt=""></a>';
                } else {
                    // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập login.php
                    echo '<a href="login.php"><img src="Images/user-regular-24.png" alt=""></a>';
                }
                ?>
                </div>
                <div class="item">
                <?php
                // Kiểm tra xem người dùng đã đăng nhập hay chưa
                // Giả sử biến $isLoggedIn chứa trạng thái đăng nhập, nếu đăng nhập thành công thì $isLoggedIn = true

                if ($isLoggedIn) {
                    // Nếu đã đăng nhập, chuyển hướng đến trang cart
                    echo '<a href="cart.php"><img src="Images/cart-download-regular-24.png" alt=""></a>';
                } else {
                    // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập login.php
                    echo '<a href="login.php"><img src="Images/cart-download-regular-24.png" alt=""></a>';
                }
                ?>
            </div>
            </div>
        </div>

        <div id="login">
        <form action="login.php" method="POST">
            <h2 class="title">Đăng nhập</h2>
            <div>
                <input type="text" name="username" id="username" placeholder="Email/Số ĐT" required>
            </div>

            <div>
                <input type="password" name="password" id="password" placeholder="Mật khẩu" required> 
            </div>

            <div class="button">
                <input type="submit" name="btn" value="Đăng nhập">
            </div>

            <p class="error"><?php echo $loginStatus; ?></p>
        </form>

        <div>
            <p class="last">Nếu chưa có tài khoản, <a href="signup.php">Đăng ký</a></p>
        </div>
    </div>
</body>
</html>