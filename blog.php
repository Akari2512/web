<?
    include "connect.php";
    

    session_start();

    // Kiểm tra xem người dùng đã đăng nhập hay chưa
    if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) {
        // Nếu chưa đăng nhập, đặt biến $isLoggedIn thành false
        // và không chuyển hướng mà chỉ hiển thị nội dung của trang index.php
        $isLoggedIn = false;
    } else {
        // Nếu đã đăng nhập, đặt biến $isLoggedIn thành true
        $isLoggedIn = true;
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="style.css">
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

    <style>
        h1{
            font-size: 40px;
        }
        .post-container {
            display: flex;
            align-items: flex-start; /* Dịch chuyển bài viết sang bên trái */
        }

        .post-content {
            flex: 1; /* Kích thước linh hoạt cho bài viết */
        }

        .post-image {
            margin-left: 20px; /* Khoảng cách giữa bài viết và ảnh */
            flex: 0 0 300px; /* Kích thước cố định cho ảnh */
            text-align: center; /* Căn giữa chữ ảnh minh họa */
        }

        .post-image img {
            max-width: 100%; /* Ảnh vừa phải */
            height: auto;
        }
    </style>

<h1> Blog</h1>

<?php
// Kết nối đến cơ sở dữ liệu
include "connect.php";

// Truy vấn dữ liệu từ bảng 'posts'
$sql = "SELECT * FROM posts";
$result = mysqli_query($conn, $sql);

// Hiển thị dữ liệu
while ($row = mysqli_fetch_assoc($result)) {
    echo "<div class='post-container'>";
    echo "<div class='post-content'>";
    echo "<h2>" . $row['title'] . "</h2>";
    echo "<p>" . $row['content'] . "</p>";
    echo "</div>";
    echo "<div class='post-image'>";
    echo "<img src='" . $row['post_image'] . "' alt=''>";
    echo "<p class='image-caption'>Ảnh minh họa</p> ";
    echo "</div>";
    echo "</div>";
}

// Đóng kết nối
mysqli_close($conn);
?>





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
