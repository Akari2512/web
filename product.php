<?php
include "connect.php";
include "classes/Product.php";
require_once "classes/ProductRepository.php";
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
$items_per_page = 6;

$productRepository = new ProductRepository($conn);

if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

$offset = ($page - 1) * $items_per_page;

$products = $productRepository->getAllProducts();

?>

<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản Phẩm</title>
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

        <div id="wp-products">
            <h2>SẢN PHẨM CỦA CHÚNG TÔI</h2>
            <ul id="list-products">
            <?php
            $counter = 0;

            foreach ($products as $product) {
                // Display products
                if ($counter >= $offset && $counter < $offset + $items_per_page) {
                    echo "<div class='item'>";  
                    echo "<img src='Images/Products/{$product['image_prd']}' alt=''>";
                    echo "<div class='name'>{$product['name_prd']}</div>";
                    echo "<div class='desc'>{$product['description_prd']}</div>";
                    
                    // Định dạng giá tiền ở đây
                    $formatted_price = number_format($product['price_prd'], 0, ',', '.');
                    echo "<div class='price'>{$formatted_price} VND</div>";

                    
                    echo "<a href='product_detail.php?prd_id={$product['prd_id']}' class='detail'>Xem chi tiết</a>";

                    // Add a form to submit product details to cart.php
                    echo "<form action='cart.php' method='post'>";
                    echo"<input type='hidden' name='prd_id' value='{$product['prd_id']}'>";
                    echo"<input type='hidden' name='quantity' value='1'> ";
                    echo"<input class='buy-now' type='submit' name='buy_now' value='Mua ngay' >";
                    echo"</form>";
                    // Add other product details as needed
                    echo "</div>";
                }
                $counter++;
            }
            ?>
            </ul>
            <div class="list-page">
                <?php
                $total_pages = ceil(count($products) / $items_per_page);

                for ($i = 1; $i <= $total_pages; $i++) {
                    echo "<div class='item'><a href='product.php?page=$i'>$i</a></div>";
                }
                ?>
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