<?php
session_start();

// Khai báo và gán giá trị cho biến $isLoggedIn
$isLoggedIn = isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true;

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!$isLoggedIn) {
    // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập login.php
    header("Location: login.php");
    exit(); // Dừng thực thi mã PHP
}

// Kết nối đến cơ sở dữ liệu
require_once 'connect.php';

// Lấy thông tin người dùng từ cơ sở dữ liệu
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE user_id = $user_id";
$result = mysqli_query($conn, $query);

if (!$result) {
    echo "Lỗi: " . mysqli_error($conn);
    exit(); // Dừng thực thi nếu có lỗi
}

$row = mysqli_fetch_assoc($result);
$name = $row['name'];
$email = $row['email'];
$phone = $row['phone'];




// Kiểm tra xem có thông báo thanh toán thành công được truyền từ trang xử lý thanh toán không
$payment_success = isset($_SESSION['payment_success']) ? $_SESSION['payment_success'] : false;

// Xóa biến session sau khi đã sử dụng
unset($_SESSION['payment_success']);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán</title>
    <link rel="stylesheet" href="style.css">

    <style>
        /* CSS cho phần thanh toán */
        #payment-form {
            max-width: 400px;
            margin: 40px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        #payment-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        #payment-form label {
            display: block;
            margin-bottom: 10px;
        }

        #payment-form input[type="text"],
        #payment-form input[type="email"],
        #payment-form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        #payment-form button {
            background-color: #E95221;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            display: block;
            margin: auto;
        }


        #payment-success {
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

        #payment-success .title {
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

        #continue-shopping {
            text-align: center;
            margin-top: 20px;
        }

        .continue-shopping-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #E95221;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            font-family: 'ADLaM Display Regular (in đậm)', sans-serif;
        }

        .continue-shopping-button:hover {
            background-color: #ff6f4d;
        }


    </style>
</head>

<body>

    <div id="wrapper">
    <div id="header">
            <div class="logo">
                <a href="index.php">
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
                    <a href="">
                        <img src="Images/cart-download-regular-24.png" alt="">
                    </a>
                </div>
            </div>
        </div>
        <!-- End Header -->

        

        <div id="payment-success">
            <h2 class="title">Thanh toán thành công</h2>
        </div>


        <div id="continue-shopping">
            <a href="product.php" class="continue-shopping-button">Tiếp tục mua hàng</a>
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
                    <a href="https://www.instagram.com/lonely.ston1e/">
                        <img src="Images/instagram.png" alt="">
                    </a>
                </div>
                <div class="infor">
                <p>Địa chỉ: 36 Đền Lừ 3, Hoàng Văn Thụ, Hoàng Mai, Hà Nội</p>
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
