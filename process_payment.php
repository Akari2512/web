<?php
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



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra xem người dùng đã đăng nhập hay chưa
    if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) {
        header("Location: login.php");
        exit();
    }

    // Kết nối đến cơ sở dữ liệu
    require_once 'connect.php';

    // Lấy thông tin từ form
    $user_id = $_SESSION['user_id'];
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);

    // Thêm thông tin vào bảng payment
    $query = "INSERT INTO payment (order_id, prd_id, address, payment_method) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    $order_id = 1; // Giả sử order_id được lấy từ trang pay.php
    $prd_id = 1; // Giả sử prd_id được lấy từ trang pay.php
    mysqli_stmt_bind_param($stmt, "iiss", $order_id, $prd_id, $address, $payment_method);

    if (mysqli_stmt_execute($stmt)) {
        // Thêm thông tin thành công
        echo "<script>
                setTimeout(function(){
                    document.getElementById('payment-success').style.display = 'none';
                }, 3000); // ẩn thông báo sau 3 giây
              </script>";
        // Thực hiện các hành động khác sau khi thanh toán thành công
    } else {
        // Lỗi khi thêm thông tin
        echo "Lỗi khi lưu thông tin thanh toán: " . mysqli_error($conn);
    }
    

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    // Trường hợp không phải là phương thức POST, chuyển hướng về trang chính
    header("Location: index.php");
    exit();
}



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web bán đồ </title>
    <link rel="stylesheet" href="style.css">

    <style>


        #success{
            margin: 40px 400px;
            border: 1px solid red;
        }
        #success h2{
            text-align: center;
            margin: 40px;
            font-size: 25px;
            font-weight: bold;
            font-family: 'ADLaM Display Regular (in đậm)', sans-serif;
            color: red;
            text-transform: uppercase;
            letter-spacing: 1px;
            line-height: 1.2;
            text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
        
        }
        
        #success a {
            padding: 4px 4px;
            font-size: 22px;
            background-color: rgb(238 12 12);
            color: white;
            border: 2px solid red;
            text-decoration: none;
            /* Nếu muốn căn giữa theo chiều dọc */
            display: block;
            margin: auto; /* Sử dụng margin:auto để căn giữa theo chiều dọc */
            width: fit-content; /* Đặt chiều rộng của phần tử là fit-content để chỉ chiếm đúng phần cần thiết */
            margin-bottom: 20px;
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
                    <a href="">
                        <img src="Images/cart-download-regular-24.png" alt="">
                    </a>
                </div>
            </div>
        </div>

        <div id="success">
            <h2>Thanh toán thành công</h2>
            <a href="index.php">Trở về trang chủ</a>
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