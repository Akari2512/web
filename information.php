<?php
// Bắt đầu hoặc khởi tạo session
session_start();

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) {
    // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập login.php
    $isLoggedIn = false;
    header("Location: login.php");
    exit(); // Chắc chắn rằng không mã PHP nào được thực hiện sau khi chuyển hướng
}else{
    $isLoggedIn = true;
}

// Kết nối đến cơ sở dữ liệu
require_once 'connect.php';

// Kiểm tra xem session user_id có tồn tại không
if (isset($_SESSION['user_id'])) {
    // Lấy user_id từ session
    $user_id = $_SESSION['user_id'];

    // Truy vấn SQL để lấy thông tin của người dùng hiện tại
    $query = "SELECT * FROM users WHERE user_id = $user_id";
    $result = mysqli_query($conn, $query);

    // Kiểm tra xem có kết quả từ truy vấn không
    if ($result && mysqli_num_rows($result) > 0) {
        // Lưu thông tin người dùng vào các biến session
        $row = mysqli_fetch_assoc($result);
        $_SESSION['name'] = $row['name'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['phone'] = $row['phone'];
    } else {
        echo "Không tìm thấy thông tin người dùng.";
    }
} else {
        echo "Người dùng chưa đăng nhập.";
}

// Đóng kết nối
mysqli_close($conn);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin người dùng</title>
    <link rel="stylesheet" href="style.css">
    <style>
        #user-info {

            box-sizing: border-box;
            margin-top: 100px !important;
            width: 400px;   
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            border: 2px solid red;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-spacing: 1px;
        }
        .title {
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
        .user-info-item {
            margin-bottom: 15px;
        }
        .user-info-label {
            font-size: 18px;
            font-weight: bold;
        }
        .user-info-submit{
            box-sizing: border-box;
            text-align: center;
            background-color: #E95221;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 14px;
            margin-top: 3px;
        }
        .user-info-submit a{
            color: #fff;
            border: none;
            cursor: pointer;
            padding: 5px 120px;
            font-size: 14px;
            text-decoration: none;
            font-family: 'ADLaM Display Regular (in đậm)', sans-serif;

        }

        .user-info-submit:hover{
            background-color: #ff6f4d; /* Màu nền mới khi nút được hover */
        }
        .user-info-change{
            box-sizing: border-box;
            text-align: center;
            background-color: #E95221;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 14px;
            margin-top: 3px;
        }
        .user-info-change a{
            color: #fff;
            border: none;
            cursor: pointer;
            padding: 5px 90px;
            font-size: 14px;
            text-decoration: none;
            font-family: 'ADLaM Display Regular (in đậm)', sans-serif;

        }
        .user-info-change:hover{
            background-color: #ff6f4d; /* Màu nền mới khi nút được hover */
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
                    <a href="introduce.php">GIỚI THIỆU</a>
                </div>
                <div class="item">
                    <a href="contact.php">LIÊN HỆ</a>
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
                    // Nếu đã đăng nhập, chuyển hướng đến trang information.php
                    echo '<a href="cart.php"><img src="Images/cart-download-regular-24.png" alt=""></a>';
                } else {
                    // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập login.php
                    echo '<a href="login.php"><img src="Images/cart-download-regular-24.png" alt=""></a>';
                }
                ?>
            </div>   
            </div>
        </div>
        <div id="user-info">
            <h2 class="title">Thông tin người dùng</h2>
            <div class="user-info-item">
                <span class="user-info-label">Tên: </span>
                <span class="user-info-value"><?php echo $_SESSION['name']; ?></span>
            </div>
            <div class="user-info-item">
                <span class="user-info-label">Email: </span>
                <span class="user-info-value"><?php echo $_SESSION['email']; ?></span>
            </div>
            <div class="user-info-item">
                <span class="user-info-label">Số điện thoại: </span>
                <span class="user-info-value"><?php echo $_SESSION['phone'];?></span>
            </div>

            <!-- Thêm các thông tin khác của người dùng nếu cần -->
            <div class="user-info-change">
                <a href="update.php">Cập nhật thông tin</a>
            </div>
            <div class="user-info-submit">
                <a href="logout.php">Đăng xuất</a>
            </div>
        </div>
    </div>

    <div id="footer">
            <div class="box">
                <div class="logo">
                    <img src="Images/logo.png" alt="" height="200px">
                </div>
                <p>Cung cấp sản phẩm với chất lượng tốt nhất cho quý khách</p>
            </div>
            <div class="box">
                <h3>NỘI DUNG</h3>
                <ul class="quick-menu">
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
                        <a href="introduce.php">GIỚI THIỆU</a>
                    </div>
                    <div class="item">
                        <a href="contact.php">LIÊN HỆ</a>
                    </div>
                </ul>
            </div>
            <div class="box">
                <h3>LIÊN HỆ</h3>
                <div class="contact">
                    <a href="https://www.facebook.com/b.thi3n">
                        <img src="Images/facebook.png" alt="">
                    </a>
                    <a href="https://www.instagram.com/neith_2107/">
                        <img src="Images/instagram.png" alt="">
                    </a>
                </div>
                   
                <div class="infor">
                <p>Địa chỉ: 22 Trần Thị Nghỉ, Phường 7, Gò Vấp, Thành Phố Hồ Chí Minh</p>
                <p>Số điện thoại: 0123 456 789</p>
                <p>Email: shopcaulong@gmail.com</p>
                </div>
                <div class="admin">
                    <a href="http://localhost/phpmyadmin/index.php?route=/">Quản lý database</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
