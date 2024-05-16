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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web bán đồ </title>
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
        <div id="banner">
            <div class="box-left">
                <h2>
                    <span>VỢT CẦU LÔNG </span>
                    <br>
                    <span>CHẤT LƯỢNG CAO</span>
                </h2>
                <p>Chuyên cung cấp những loại vợt chất lượng đến với khách hàng</p>
                <a href="product.php" class="button">Mua ngay</a>
            </div>
            
            
        </div>
        <div id="wp-products">
            <a href="product.php">
            <h2>SẢN PHẨM CỦA CHÚNG TÔI</h2>
            <ul id="list-products">
                <div class="item">
                    <img src="Images/Products/vot-cau-long-kumpoo-thor-99-trang-noi-dia-trung_1705527728.png" alt="">
                   

                    <div class="name">Vợt Cầu Lông Kumpoo Thor 99 </div>
                    <div class="desc">Màu trắng (Nội Địa Trung)</div>
                    <div class="price">500.000 VNĐ</div>
                    <div class="buy-now">Mua ngay</div>
                </div>


                <div class="item">
                    <img src="Images/Products/vot-cau-long-yonex-arcsaber-73-light-dark-blue-chinh-hang_1706662428.png" alt="">
                    

                    <div class="name">Vợt Cầu Lông Yonex Arcsaber 73 Light</div>
                    <div class="desc">(Dark Blue) Chính Hãng</div>
                    <div class="price">1.000.000 VND</div>
                    <div class="buy-now">Mua ngay</div>
                </div>


                <div class="item">
                    <img src="Images/Products/vot-cau-long-kumpoo-power-control-e88ls-new-chinh-hang_1706581251.png" alt="">
                    

                    <div class="name">Vợt Cầu Lông Kumpoo Power E88LS </div>
                    <div class="desc">New, Chính Hãng</div>
                    <div class="price">650.000 VNĐ</div>
                    <div class="buy-now">Mua ngay</div>
                </div>
                <div class="item">
                    <img src="Images/Products/vot-cau-long-yonex-nanoray-72-light-blue-chinh-hang_1706661781.png" alt="">
                    

                    <div class="name">Vợt Cầu Lông Yonex Nanoray 72 </div>
                    <div class="desc">Light (Blue) Chính Hãng</div>
                    <div class="price">900.000 VNĐ</div>
                    <div class="buy-now">Mua ngay</div>
                </div>

                <div class="item">
                    <img src="Images/Products/vot-cau-long-lining-axforce-80-do-rong-lua-chen-long-limited-1_1708571735.png" alt="">
                    

                    <div class="name">Vợt Cầu Lông Lining Axforce 80</div>
                    <div class="desc">Đỏ (Rồng Lửa) Chen Long Limited - Nội Địa Trung</div>
                    <div class="price">1.200.000 VNĐ</div>
                    <div class="buy-now">Mua ngay</div>
                </div>

                <div class="item">
                    <img src="Images/Products/vot-cau-long-yonex-arcsaber-73-light-aqua-blue-chinh-hang_1706651276.png" alt="">
                    

                    <div class="name">Vợt Cầu Lông Yonex Arcsaber 73</div>
                    <div class="desc">Light (Aqua Blue) Chính Hãng</div>
                    <div class="price">700.000 VNĐ</div>
                    <div class="buy-now">Mua ngay</div>
                </div>
            </ul>
            </a>
            <div class="list-page">
                <div class="item">
                    <a href="product.php">1</a>
                </div>
                <div class="item">
                    <a href="product.php">2</a>
                </div>
                <div class="item">
                    <a href="product.php">3</a>
                </div>
                <div class="item">
                    <a href="product.php">4</a>
                </div>
            </div>
            </a>
        </div>
                <a href="product.php" id="saleoff">
            <div class="box-left">
                <h1>
                    <span>GIẢM GIÁ LÊN ĐẾN</span>
                    <span>25%</span>
                </h1>
            </div>
            <div class="box-right">
                <h1>
                    <span>ƯU ĐÃI CHO HỌC SINH - SINH VIÊN KHI MUA HÀNG</span>
                    <span>GIẢM THÊM 5% KHI ĐEM THEO THẺ HỌC SINH, SINH VIÊN</span>
                </h1>
            </div>
                </a>
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
    </div>

</body>

</html>