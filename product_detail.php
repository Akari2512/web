<?php
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
    <title>Giới thiệu</title>
    <link rel="stylesheet" href="style.css">
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
        
        <style>
            /* CSS cho trang thông tin sản phẩm */
            .product-container {
                display: flex;
                justify-content: center;
                align-items: flex-start;
                flex-wrap: wrap;
                margin-top: 20px;
                overflow: auto; /* Đảm bảo container bao gồm tất cả các phần tử con đã được float */
            }

            .product-image {
                border: 1px solid black;
                flex: 0 0 50%;
                padding: 20px;
                box-sizing: border-box;
                max-width: 50%;
                float: left;
                clear: both;
                margin-right: 7px;
            }

            .product-title {
                flex: 0 0 calc(50% + 10cm);
                padding: 20px;
                text-align: justify;
                    
            }

            .product-content {
                flex: 1 1 calc(50% - 20px);
                padding: 20px;
                box-sizing: border-box;
                max-width: 1000px;
                word-wrap: break-word;
                align-self: center;
                margin-left: 8cm;
            }

            .product-price {
                color: red;
                font-size: 24px;
                display: inline-block; /* Hiển thị giá tiền và nút "Mua ngay" cùng hàng */
                margin-right: 20px; /* Khoảng cách giữa giá tiền và nút "Mua ngay" */
            }

            .buy-now-container {
                display: inline-block; /* Hiển thị nút "Mua ngay" cùng hàng với giá tiền */
                vertical-align: middle; /* Canh giữa nút "Mua ngay" theo chiều dọc */
            }

            .buy-now {
                background-color: #ff4500;
                color: #fff;
                border: none;
                padding: 10px 20px;
                font-size: 18px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            .buy-now:hover {
                background-color: #d23200;
            }
            /* CSS cho giao diện đánh giá sao */
.rating {
    display: inline-block;
    position: relative;
    bottom: 1px;
}

.rating input {
    display: none;
}

.rating label {
    cursor: pointer;
    width: 25px;
    height: 25px;
    margin: 0 2px;
    float: right;
    background-color: transparent;
}

.rating label:before {
    content: '\2605';
    font-size: 25px;
    color: #ccc;
}

.rating input:checked ~ label:before,
.rating input:checked ~ label:hover:before,
.rating label:hover ~ label:before {
    color: #ffca08;
}

/* Ẩn hover khi đã chọn */
.rating input:checked + label:hover:before {
    color: #ccc;
}
/* CSS cho phần bình luận */
.comment-section {
    margin-left: 15px;
}

.comment-section h3 {
    margin-bottom: 10px;
}

.comment-section textarea {
    width: 100%;
    margin-bottom: 10px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    resize: vertical;
}

.comment-section .rating {
    display: inline-block;
    position: relative;
    bottom: 1px;
}

.comment-section .rating input {
    display: none;
}

.comment-section .rating label {
    cursor: pointer;
    width: 25px;
    height: 25px;
    margin: 0 2px;
    float: right;
    background-color: transparent;
}

.comment-section .rating label:before {
    content: '\2605';
    font-size: 25px;
    color: #ccc;
}

.comment-section .rating input:checked ~ label:before,
.comment-section .rating input:checked ~ label:hover:before,
.comment-section .rating label:hover ~ label:before {
    color: #ffca08;
}

/* Ẩn hover khi đã chọn */
.comment-section .rating input:checked + label:hover:before {
    color: #ccc;
}

.comment-section button[type="submit"] {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.comment-section button[type="submit"]:hover {
    background-color: #0056b3;
}
hr {
    border: none; /* Loại bỏ đường viền */
    height: 1px; /* Đặt chiều cao của đường kẻ ngang */
    background-color: transparent; /* Đặt màu nền là trong suốt */
}
.comments {
    margin-top: 20px;
}

.comments p {
    flex: 1;
    background-color: rgba(255, 255, 128, .5);
    padding: 15px;
    border-radius: 10px; /* Bo góc */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Đổ bóng */
}
/* CSS cho phần hiển thị đánh giá bằng hình ảnh ngôi sao */
.comment-section .rating {
    display: inline-block;
    position: relative;
}

.comment-section .rating input {
    display: none;
}

.comment-section .rating label {
    cursor: pointer;
    width: 25px; /* Kích thước của hình ảnh ngôi sao */
    height: 25px; /* Kích thước của hình ảnh ngôi sao */
    margin: 0;
    padding: 0;
    float: right;
}

.comment-section .rating label img {
    width: 100%; /* Đảm bảo hình ảnh ngôi sao sẽ lấp đầy label */
    height: auto; /* Đảm bảo tỷ lệ khung hình */
}
.rating-summary-container {
   
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    margin-top: 20px;
    
    
}

.rating-summary {
    background-color: #f2f2f2; /* Màu nền của bảng */
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.star-rating {
    font-size: 24px; /* Kích thước của hình sao */
}

.star {
    color: #FFD700; /* Màu vàng */
}



        </style>

        <div class="product-container">
            <?php
                // Kiểm tra có tham số prd_id được truyền qua URL không
                if (isset($_GET['prd_id'])) {
                    // Lấy ID sản phẩm từ URL
                    $product_id = $_GET['prd_id'];

                    // Truy vấn CSDL để lấy thông tin sản phẩm dựa trên ID
                    $sql = "SELECT * FROM product_detail WHERE prd_id = $product_id";
                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        // Kiểm tra có sản phẩm nào được trả về từ CSDL không
                        if (mysqli_num_rows($result) > 0) {
                            // Lấy thông tin chi tiết của sản phẩm
                            $product = mysqli_fetch_assoc($result);
                            $image = $product['prd_image'];
                            $title = $product['prd_title'];
                            $content = $product['prd_content'];
                            $price = number_format($product['prd_price'], 0, '.', '.'); // Sử dụng hàm number_format để định dạng giá tiền với dấu chấm
                            
                            // Hiển thị thông tin sản phẩm
                            echo "<div>";
                            echo "<img class='product-image' src='$image' height='600' alt=''>";
                            echo "<h2 class='product-title'>$title</h2>";
                            echo "<p class='product-content'>$content</p>";
                            echo "<span class='product-price'>Giá: $price VNĐ</span>";  
                            // Form để gửi chi tiết sản phẩm đến cart.php
                            echo "<form class='buy-now-container' action='cart.php' method='post'>";
                            echo "<input type='hidden' name='prd_id' value='$product_id'>";
                            echo "<input type='hidden' name='quantity' value='1'>";
                            echo "<input class='buy-now' type='submit' name='buy_now' value='Mua ngay'>";
                            echo "</form>";
                            // Các thông tin khác của sản phẩm có thể được thêm vào ở đây
                            echo "</div>";
                        } else {
                            echo "Không tìm thấy sản phẩm.";
                        }
                    } else {
                        echo "Lỗi: " . mysqli_error($conn);
                    }
                } else {
                    echo "Không có sản phẩm được chọn.";
                }
            ?>
        </div>
    </div>
<div class="comment-section">
    <h3>Ý kiến của bạn</h3>
    <form action="submit_comment.php" method="post">
        <textarea name="comment_content" placeholder="Nhập bình luận của bạn..." rows="4" required></textarea>
        <input type="hidden" name="prd_id" value="<?php echo $product_id; ?>">
        <!-- Đánh giá sao -->
        <div class="rating">
            <input type="radio" id="star5" name="rating" value="5">
            <label for="star5"></label>
            <input type="radio" id="star4" name="rating" value="4">
            <label for="star4"></label>
            <input type="radio" id="star3" name="rating" value="3">
            <label for="star3"></label>
            <input type="radio" id="star2" name="rating" value="2">
            <label for="star2"></label>
            <input type="radio" id="star1" name="rating" value="1">
            <label for="star1"></label>
        </div>
        <button type="submit">Gửi</button>
    </form>
    <div class="comments">
        <?php
        include "connect.php"; // Kết nối đến cơ sở dữ liệu

        // Lấy ID của sản phẩm từ URL
        if (isset($_GET['prd_id'])) {
            $product_id = $_GET['prd_id'];

            // Truy vấn để lấy thông tin chi tiết của sản phẩm
            $sql_product = "SELECT * FROM product_detail WHERE prd_id = $product_id";
            $result_product = mysqli_query($conn, $sql_product);
            // Truy vấn để lấy các bình luận và đánh giá cho sản phẩm cụ thể
            $sql_review = "SELECT * FROM reviews WHERE prd_id = $product_id";
            $result_review = mysqli_query($conn, $sql_review);

            // Tiêu đề cho phần đánh giá và bình luận
            echo "<h3>Đánh giá và Bình luận</h3>";

            // Kiểm tra và hiển thị dữ liệu
            if ($result_review && mysqli_num_rows($result_review) > 0) {
                while ($row = mysqli_fetch_assoc($result_review)) {
                    echo "<h4>Đánh giá: ";
                    $rating = $row['rating'];
                    for ($i = 0; $i < $rating; $i++) {
                        echo "⭐"; // Sử dụng ký tự Unicode ngôi sao
                    }
                    echo "</h4>";
                    echo "<p>Bình luận: " . $row['comment_content'] . "</p>";
                    echo "<hr>";
                }
            } else {
                echo "<p>Chưa có đánh giá nào cho sản phẩm này.</p>";
            }
        } else {
            echo "Không có sản phẩm được chọn.";
        }

        // Đóng kết nối
        mysqli_close($conn);
        ?>
    </div>
</div>

<?php
include "connect.php"; // Kết nối đến cơ sở dữ liệu

// Lấy ID của sản phẩm từ URL
if (isset($_GET['prd_id'])) {
    $product_id = $_GET['prd_id'];

    // Truy vấn CSDL để lấy tổng số lượt đánh giá và tổng số sao
    $sql = "SELECT COUNT(id) AS total_reviews, AVG(rating) AS avg_rating FROM reviews WHERE prd_id = $product_id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $total_reviews = $row['total_reviews'];
        $avg_rating = $row['avg_rating'];

        // Bảng thống kê số sao đánh giá
        echo "<div class='rating-summary-container'>";
        echo "<div class='rating-summary'>";
        echo "<p>Tổng số đánh giá: $total_reviews</p>";
        echo "<p>Đánh giá trung bình: </p>";

        // Bảng thống kê số sao đánh giá
        echo "<div class='star-rating'>";
        $rounded_avg_rating = round($avg_rating, 0, PHP_ROUND_HALF_UP); // Làm tròn lên nếu sau dấu phẩy là 0.5, ngược lại làm tròn xuống
        $avg_rating_int = intval($rounded_avg_rating); // Chuyển đổi giá trị đánh giá trung bình thành số nguyên
        // Hiển thị các hình sao tương ứng với đánh giá trung bình
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $avg_rating_int) {
                echo "<span class='star'>&#9733;</span>"; // Hình sao đầy
            } else {
                echo "<span class='star'>&#9734;</span>"; // Hình sao rỗng
            }
        }
        echo "</div>"; // Kết thúc bảng thống kê số sao

        echo "</div>"; // Kết thúc div rating-summary
        echo "</div>"; // Kết thúc div rating-summary-container
    } else {
        echo "<p>Chưa có đánh giá nào cho sản phẩm này.</p>";
    }
} else {
    echo "<p>Chưa có đánh giá nào cho sản phẩm này.</p>";
}
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
</body>

</html>

