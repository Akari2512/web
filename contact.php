<?
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
    <title>Web bán đồ </title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* CSS for custom styles */
    
        h1{
            font-size: 40px;
        }

        .content > div {
            flex: 1 1 800px;
            margin: 10px;
        }

        .content h2 {
            text-align: left;
        }

        .content p {
            text-align: justify;
            flex-wrap: wrap;
        }

        /* Thêm CSS cho email và số điện thoại */
        .email,
        .phone {
            color: orange;
        }
      /* CSS cho bảng thông tin tư vấn */
.contact-form { 
    margin: 20px 200px;
    border: 2px solid red;
    background-color: #f2f2f2;
    padding: 50px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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

.contact-form input[type="text"],
.contact-form input[type="email"],
.contact-form input[type="tel"],
.contact-form textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.contact-form textarea {
    resize: vertical;
}

.contact-form input[type="submit"] {
    background-color: #E95221;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 14px;
            margin-top: 3px;
}

.contact-form input[type="submit"]:hover {
    background-color: #ff6f4d;
}

.other-locations {
    float: right;
    width: calc(50% - 20px);
    padding: 20px;
    margin-left: 20px;
    background-color: #f2f2f2;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.other-locations h2 {
    margin-bottom: 10px;
}
.other-locations ul {
    list-style-type: none;
    padding: 0;
}

.other-locations ul li {
    margin-bottom: 10px;
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
        <section>
    <div>
            <div class="content">
                <div>
                    <h1>Liên hệ</h1>
                    <div>
                        <h2>Thông tin liên hệ:</h2>
                        <p><strong>Email:</strong> <span class="email">shopcaulong@gmail.com</span></p>
                        <p><strong>Số điện thoại:</strong> <span class="phone">0123 456 789</span></p>
                    </div>
                </div>
      
                <div class="other-locations">
    <h2>Các cơ sở khác:</h2>
    <ul>
<li><strong>123 Đường Hoàng Mai, Quận Hoàng Mai, Hà Nội</strong> <a href="https://maps.google.com/?q=123 Đường Hoàng Mai, Quận Hoàng Mai, Hà Nội" target="_blank"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/aa/Google_Maps_icon_%282020%29.svg/1428px-Google_Maps_icon_%282020%29.svg.png" alt=" " style="width: 20px; height: 20px;"></a></li>
        <li><strong>456 Đường Nguyễn Trãi, Quận Thanh Xuân, Hà Nội</strong> <a href="https://maps.google.com/?q=456 Đường Nguyễn Trãi, Quận Thanh Xuân, Hà Nội" target="_blank"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/aa/Google_Maps_icon_%282020%29.svg/1428px-Google_Maps_icon_%282020%29.svg.png" alt=" " style="width: 20px; height: 20px;"></a></li>
        <li><strong>789 Đường Cầu Giấy, Quận Cầu Giấy, Hà Nội</strong> <a href="https://maps.google.com/?q=789 Đường Cầu Giấy, Quận Cầu Giấy, Hà Nội" target="_blank"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/aa/Google_Maps_icon_%282020%29.svg/1428px-Google_Maps_icon_%282020%29.svg.png" alt=" " style="width: 20px; height: 20px;"></a></li>
        <li><strong>101 Đường Lê Lai, Quận 1, Thành phố Hồ Chí Minh</strong> <a href="https://maps.google.com/?q=101 Đường Lê Lai, Quận 1, Thành phố Hồ Chí Minh" target="_blank"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/aa/Google_Maps_icon_%282020%29.svg/1428px-Google_Maps_icon_%282020%29.svg.png" alt=" " style="width: 20px; height: 20px;"></a></li>
        <li><strong>112 Đường Nguyễn Văn Linh, Quận 7, Thành phố Hồ Chí Minh</strong> <a href="https://maps.google.com/?q=112 Đường Nguyễn Văn Linh, Quận 7, Thành phố Hồ Chí Minh" target="_blank"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/aa/Google_Maps_icon_%282020%29.svg/1428px-Google_Maps_icon_%282020%29.svg.png" alt=" " style="width: 20px; height: 20px;"></a></li>
    </ul>
</div>

        </div>

                <div>
                    <h2 style="margin-left: 10px;">Địa chỉ : 22 Trần Thị Nghĩ , Phường 7 , Gò Vấp , Thành Phố Hồ Chí Minh</h2>
                </div>
                <div>
                    <div style="float: justify; margin-left: 20px;">
                        <img src="images/introduce/diachi.png" alt="Địa chỉ"
                        style="max-width: 25%; max-height: 50%;  ">
                    </div>
                </div>
        </div>
    

    <form action="process_contact.php" method="POST" class="contact-form">
        <h2 class="title">Thông tin tư vấn:</h2>
        <input type="text" name="name" id="name" placeholder="Họ và tên" required>
        <input type="email" name="email" id="email" placeholder="Email" required>
        <input type="tel" name="phone" id="phone" placeholder="Số điện thoại" required>
        <textarea id="message" name="message" rows="4" placeholder="Nội dung tư vấn" required></textarea><br>
        <input type="submit" value="Gửi">
    </form>
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