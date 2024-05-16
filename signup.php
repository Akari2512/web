<?php
    require_once 'classes/User.php';
    require_once 'classes/Registration.php';
    include 'connect.php';


    $registrationStatus = '';
    $registration = null;

    if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) {
        // Nếu chưa đăng nhập, đặt biến $isLoggedIn thành false
        // và không chuyển hướng mà chỉ hiển thị nội dung của trang index.php
        $isLoggedIn = false;
    } else {
        // Nếu đã đăng nhập, đặt biến $isLoggedIn thành true
        $isLoggedIn = true;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Tạo một đối tượng User
        $user = new User($name, $email, $phone, $password);

        // Tạo một đối tượng Registration
        $registration = new Registration($user);
        // Thực hiện quá trình đăng ký
        
        $registration->register();

        $registrationStatus = $registration->getRegistrationStatus();  

    }
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Đăng ký</title>
        <link rel="stylesheet" href="style.css">
        <style>
            #signin{
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
            }

            .button input[type="submit"]:hover {
                background-color: #ff6f4d; /* Màu nền mới khi nút được hover */
            }
        
            .last{
                text-align: center;
                margin-top: 10px;
                font-size: 12px;
                font-weight: bold;
                color: red;
                text-transform: uppercase;
                letter-spacing: 1px;
                line-height: 1.2;
                text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
            }

            .message-container {
                color:#E95221;
                font-size: 12px;
            }

            .regex-error {
                color:#E95221;
                font-size: 12px;
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
        <form action="signup.php" method="POST">
            <div id="signin">
            <h2 class="title">Đăng ký</h2>
            <div class="regex-error" id="username-error"></div>
            <div class="message-container"><? echo $registration ? $registration->getNameError() : ''; ?></div>
            <div class="input1">
                <input type="text" name="name" id="name" placeholder="Nhập tên của bạn (Không dấu)" required>
            </div>
            
            <div class="message-container" id="email-error"></div>
            <div class="message-container"> <? echo $registration ? $registration->getEmailError() : ''; ?></div>
            <div class="input1">
                <input type="email" name="email" id="email" placeholder="Nhập email của bạn (*)" required>
            </div>

            <div class="message-container" id="phone-error"></div>
            <div class="message-container"><? echo $registration ? $registration->getPhoneError() : ''; ?></div>
            <div class="input1">
                <input type="tel" name="phone" id="phone" placeholder="Số điện thoại" required>
            </div>

            <div class="message-container" id="password-error"></div>
            <div class="message-container"><? echo $registration ? $registration->getPassError() : ''; ?></div>
            <div class="input1">
                <input type="password" name="password" id="password" placeholder="Mật khẩu" required> 
            </div>
            <div id="password-mismatch" style="color:#E95221; font-size: 12px;"></div>
            <div class="input1">
                    
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Nhập lại mật khẩu" required> 
            </div>
            <div class="message-container">
                <?php
                    if ($registrationStatus) {
                        echo '<p class="registration-message">' . $registrationStatus . '</p>';
                    }
                ?>
            </div>
            <div class="button">
                <input type="submit" name="btn" id="register-button" value="Đăng ký">
            </div>
            <p class="last">Nếu đã có tài khoản,<a href="login.php"> Đăng nhập </a></p>

            </div>
            </form>

            <script>
    document.addEventListener('DOMContentLoaded', function () {
        var usernameInput = document.getElementById('name');
        var usernameError = document.getElementById('username-error');
        var emailError = document.getElementById('email-error');
        var phoneError = document.getElementById('phone-error');
        var passwordError = document.getElementById('password-error');
        var passwordInput = document.getElementById('password');
        var confirmPasswordInput = document.getElementById('confirm_password'); 
        var mismatchMessage = document.getElementById('password-mismatch');
        var registerButton = document.getElementById('register-button');

        usernameInput.addEventListener('input', function () {
        var username = usernameInput.value.trim();  // Sử dụng trim() ở đây để loại bỏ khoảng trắng
        
        usernameInput.addEventListener('input', function () {
        var username = usernameInput.value.trim();  // Sử dụng trim() để loại bỏ khoảng trắng ở đầu và cuối chuỗi

        if (!/^[a-zA-Z\s0-9]+$/.test(username)) {
            usernameError.textContent = 'Tên không hợp lệ!';
        } else {
            usernameError.textContent = '';
        }
    });
});
        // Kiểm tra email khi người dùng nhập liệu
        document.getElementById('email').addEventListener('input', function () {
            var email = this.value;

            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                emailError.textContent = 'Email không hợp lệ!';
            } else {
                emailError.textContent = '';
            }
        });

        // Kiểm tra số điện thoại khi người dùng nhập liệu
        document.getElementById('phone').addEventListener('input', function () {
            var phone = this.value;

            if (!/^(0\d{9}|(\+84)\d{9})$/.test(phone)) {
                phoneError.textContent = 'Số điện thoại không hợp lệ!';
            } else {
                phoneError.textContent = '';
            }
        });

        confirmPasswordInput.addEventListener('input', function () {
            var password = passwordInput.value;
            var confirmPassword = confirmPasswordInput.value;

            if (password !== confirmPassword) {
                mismatchMessage.textContent = 'Mật khẩu không khớp!';
                registerButton.disabled = true;
            } else {
                mismatchMessage.textContent = '';
                registerButton.disabled = false;
            }
        });

        passwordInput.addEventListener('input', function () {
            var password = this.value;

            if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/.test(password)) {
                passwordError.textContent = 'Mật khẩu không đủ mạnh! Cần ít nhất 8 ký tự, 1 chữ số, 1 chữ thường và 1 chữ in hoa';
            } else {
                passwordError.textContent = '';
            }
        });

        confirmPasswordInput.dispatchEvent(new Event('input'));
    });


</script>
    </body>
    </html>