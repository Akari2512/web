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
        // Lưu thông tin người dùng vào các biến
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $email = $row['email'];
        $phone = $row['phone'];
    } else {
        echo "Không tìm thấy thông tin người dùng.";
        exit(); // Thoát khỏi trang nếu không tìm thấy thông tin người dùng
    }
} else {
    echo "Người dùng chưa đăng nhập.";
    exit(); // Thoát khỏi trang nếu không có session user_id
}

// Nếu dữ liệu form được gửi đi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Xử lý dữ liệu form và cập nhật vào cơ sở dữ liệu
    // Ví dụ: cập nhật thông tin mới vào cơ sở dữ liệu và kiểm tra kết quả
    $new_name = $_POST['new_name'];
    $new_email = $_POST['new_email'];
    $new_phone = $_POST['new_phone'];

    // Cập nhật thông tin người dùng vào cơ sở dữ liệu
    $update_query = "UPDATE users SET name = '$new_name', email = '$new_email', phone = '$new_phone' WHERE user_id = $user_id";
    $update_result = mysqli_query($conn, $update_query);

    if ($update_result) {
        // Cập nhật session với thông tin mới
        $_SESSION['name'] = $new_name;
        $_SESSION['email'] = $new_email;
        $_SESSION['phone'] = $new_phone;

        // Chuyển hướng người dùng đến trang thông tin người dùng
        header("Location: information.php");
        exit(); // Chắc chắn rằng không mã PHP nào được thực hiện sau khi chuyển hướng
    } else {
        echo "Có lỗi xảy ra khi cập nhật thông tin người dùng.";
    }
}

// Đóng kết nối
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa thông tin người dùng</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* CSS cho trang sửa thông tin */
        
        #user-info {
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
        input {
                width: 100%;
                height: 45px;
                padding: 20px;
                color: #333;
                border: 1px solid #e1e1e1 !important;
                margin-bottom: 15px;
                box-sizing: border-box;
            }
        .title {
            text-align: center;
            margin-bottom: 20px;
            font-size: 25px;
            font-weight: bold;
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
        .user-info-submit input[type="submit"] {
            box-sizing: border-box;
            font-family: 'ADLaM Display Regular (in đậm)', sans-serif;
            background-color: #E95221;
            color: #fff;
            border: none;
            padding: 9px 120px;
            cursor: pointer;
            font-size: 14px;
        }
        .user-info-submit:hover input[type="submit"] {
            background-color: #ff6f4d;
        }
        .error-message {
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
            <h2 class="title">Sửa thông tin người dùng</h2>
            <form method="post" action="update.php" id="update-form">
            <div class="user-info-item">
                <span class="user-info-label">Tên:</span>
                <input type="text" name="new_name" id="name" value="<?php echo $name; ?>">
                <div id="name-error" class="error-message"></div>
            </div>
            <div class="user-info-item">
                <span class="user-info-label">Email:</span>
                <input type="email" name="new_email" id="email" value="<?php echo $email; ?>">
                <div id="email-error" class="error-message"></div>
            </div>
            <div class="user-info-item">
                <span class="user-info-label">Số điện thoại:</span>
                <input type="text" name="new_phone" id="phone" value="<?php echo $phone; ?>">
                <div id="phone-error" class="error-message"></div>
            </div>
            <div class="user-info-submit">
                    <input type="submit" value="Lưu thay đổi">
                </div>
            </form>
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
    <script>
    document.addEventListener('DOMContentLoaded', function () {
    var nameInput = document.getElementById('name');
    var nameError = document.getElementById('name-error');
    var emailInput = document.getElementById('email');
    var emailError = document.getElementById('email-error');
    var phoneInput = document.getElementById('phone');
    var phoneError = document.getElementById('phone-error');

    nameInput.addEventListener('input', function () {
        var name = nameInput.value.trim();

        if (!/^[a-zA-Z\s0-9]+$/.test(name)) {
            nameError.textContent = 'Tên không hợp lệ!';
        } else {
            nameError.textContent = '';
        }
    });

    emailInput.addEventListener('input', function () {
        var email = emailInput.value.trim();

        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            emailError.textContent = 'Email không hợp lệ!';
        } else {
            emailError.textContent = '';
        }
    });

    phoneInput.addEventListener('input', function () {
        var phone = phoneInput.value.trim();

        if (!/^(0\d{9}|(\+84)\d{9})$/.test(phone)) {
            phoneError.textContent = 'Số điện thoại không hợp lệ!';
        } else {
            phoneError.textContent = '';
        }
    });
    document.getElementById('update-form').addEventListener('submit', function (event) {
        var isValid = true;

        // Kiểm tra lỗi cho mỗi trường
        if (!/^[a-zA-Z\s0-9]+$/.test(nameInput.value.trim())) {
            nameError.textContent = 'Tên không hợp lệ!';
            isValid = false;
        }

        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInput.value.trim())) {
            emailError.textContent = 'Email không hợp lệ!';
            isValid = false;
        }

        if (!/^(0\d{9}|(\+84)\d{9})$/.test(phoneInput.value.trim())) {
            phoneError.textContent = 'Số điện thoại không hợp lệ!';
            isValid = false;
        }

        // Nếu có lỗi, ngăn chặn việc gửi form
        if (!isValid) {
            
            event.preventDefault();
        }
    });
});

        </script>

</body>
</html>
