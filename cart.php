<?php
// Start session
session_start();

// Include database connection
include 'connect.php';

// Check database connection
if ($conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Check if user is logged in
$isLoggedIn = isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true;

// Redirect user to login page
function redirectToLogin() {
    header('Location: login.php');
    exit();
}

// Redirect user to cart page
function redirectToCart() {
    header('Location: cart.php');
    exit();
}

if (isset($_POST['pay'])) {
    if ($isLoggedIn) {
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            $userId = $_SESSION['user_id'];
            $error = false;

            foreach ($_SESSION['cart'] as $ipPrd => $product) {
                $prdId = $ipPrd;
                $quantity = $product['quantity'];

                $sql = "INSERT INTO orders (user_id, prd_id, quantity) 
                        VALUES ('$userId', '$prdId', '$quantity')";
                if (!$conn->query($sql)) {
                    $error = true;
                    break;
                }
            }

            if (!$error) {
                unset($_SESSION['cart']);
                header('Location: pay.php');
                exit();
            } else {
                echo "Lỗi khi lưu đơn hàng vào cơ sở dữ liệu.";
            }
        } else {
            header('Location: cart.php');
            exit();
        }
    } else {
        redirectToLogin();
    }
}
// Process "Mua ngay" ở product.php button click
if (isset($_POST['buy_now'])) {
    if ($isLoggedIn) {
        if (isset($_POST['prd_id'])) {
            $ipPrd = $_POST['prd_id'];

            // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
            if (isset($_SESSION['cart'][$ipPrd])) {
                // Nếu sản phẩm đã tồn tại, tăng số lượng lên 1
                $_SESSION['cart'][$ipPrd]['quantity']++;
            } else {
                // Nếu sản phẩm chưa tồn tại, thêm sản phẩm mới vào giỏ hàng
                $sql = "SELECT * FROM products WHERE prd_id = $ipPrd";
                $result = $conn->query($sql);
                if ($result && $result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $_SESSION['cart'][$ipPrd] = array(
                        'name_prd' => $row['name_prd'],
                        'image_prd' => $row['image_prd'],
                        'price_prd' => $row['price_prd'],
                        'quantity' => 1
                    );
                } else {
                    echo "Không tìm thấy sản phẩm.";
                }
            }

            redirectToCart();
        } else {
            echo "Trường 'prd_id' không được gửi trong form.";
        }
    } else {
        redirectToLogin();
    }
}

// Calculate total price of cart
function calculateTotal() {
    $total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total += intval($item['price_prd']) * intval($item['quantity']);
    }
    return $total;
}

// Increase product quantity in cart
function increaseQuantity($ipPrd) {
    if (isset($_SESSION['cart'][$ipPrd])) {
        $_SESSION['cart'][$ipPrd]['quantity']++;
    }
}

// Decrease product quantity in cart
function decreaseQuantity($ipPrd) {
    if (isset($_SESSION['cart'][$ipPrd]) && $_SESSION['cart'][$ipPrd]['quantity'] > 1) {
        $_SESSION['cart'][$ipPrd]['quantity']--;
    }
}

// Remove product from cart
if (isset($_POST['remove_product'])) {
    $ipPrdToRemove = $_POST['remove_product'];
    if (isset($_SESSION['cart'][$ipPrdToRemove])) {
        unset($_SESSION['cart'][$ipPrdToRemove]);
    }
    redirectToCart();
}

// Include database connection
include 'connect.php';

// Check database connection
if ($conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Check if user is logged in
$isLoggedIn = isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true;

// Redirect user to login page


// Redirect user to cart page

// Process "Thanh toán" button click
if (isset($_POST['pay'])) {
    if ($isLoggedIn) {
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            // Kiểm tra xem dữ liệu address và payment_method có được gửi từ form không
            if (isset($_POST['shipping_address']) && isset($_POST['payment_method'])) {
                // Lấy thông tin địa chỉ nhận hàng và phương thức thanh toán từ form
                $address = $_POST['shipping_address'];
                $paymentMethod = $_POST['payment_method'];

                // Lấy ID người dùng từ session
                $userId = $_SESSION['user_id'];
                $error = false;

                // Lặp qua từng sản phẩm trong giỏ hàng để lưu vào bảng orders
                foreach ($_SESSION['cart'] as $ipPrd => $product) {
                    $prdId = $ipPrd;
                    $quantity = $product['quantity'];

                    // Thực hiện truy vấn để lưu thông tin đơn hàng vào bảng orders
                    $sql = "INSERT INTO orders (user_id, prd_id, quantity, shipping_address, payment_method) 
                        VALUES ('$userId', '$prdId', '$quantity', '$address', '$paymentMethod')";

                    if (!$conn->query($sql)) {
                        $error = true;
                        break;
                    }
                }

                // Kiểm tra nếu không có lỗi xảy ra trong quá trình lưu đơn hàng
                if (!$error) {
                    // Xóa giỏ hàng sau khi đã thanh toán thành công
                    unset($_SESSION['cart']);
                    // Chuyển hướng đến trang pay.php hoặc thông báo thành công
                    header('Location: pay.php');
                    exit();
                } else {
                    echo "Lỗi khi lưu đơn hàng vào cơ sở dữ liệu.";
                }
            } else {
                echo "Vui lòng điền địa chỉ nhận hàng và chọn phương thức thanh toán.";
            }
        } else {
            header('Location: cart.php');
            exit();
        }
    } else {
        redirectToLogin();
    }
}

if(isset($_POST['checkout'])) {
    // Thực hiện các xử lý cần thiết trước khi chuyển hướng, ví dụ: lưu thông tin giỏ hàng vào cơ sở dữ liệu, tính toán tổng số tiền, v.v.

    // Chuyển hướng người dùng đến trang thanh toán (pay.php)
    header("Location: pay.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng</title>
    <link rel="stylesheet" href="style.css">
    <style>
        #cart{
            
            margin: 40px 40px;
            border: 1px solid red;
            box-sizing: border-box;
        }
        #cart h2{

            text-align: center;
            margin: 20px;
            font-size: 25px;
            font-weight: bold;
            font-family: 'ADLaM Display Regular (in đậm)', sans-serif;
            color: red;
            text-transform: uppercase;
            letter-spacing: 1px;
            line-height: 1.2;
            text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            overflow-x: auto; /* Cho phép cuộn ngang khi nội dung tràn ra */
            overflow-y: auto; /* Cho phép cuộn dọc khi nội dung tràn ra */
        }
        th, td {
            
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        th {
            background-color: #E95221;
            color: white;
        }
        td img {
            max-width: 100px;
            height: auto;
            display: block;
            margin: auto;
        }
        .quantity-buttons button {
            padding: 5px 10px;
            margin: 0 5px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .quantity-buttons button:hover {
            background-color: #45a049;
        }

        table button {
            background-color: #E95221;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 6px 12px;
            cursor: pointer;
            font-size: 14px;
        }
        #address {
            width: 80%; /* Đặt chiều rộng của ô nhập là 100% của phần tử cha */
            padding: 10px; /* Thêm padding để tăng kích thước */
            font-size: 16px; /* Đặt kích thước phông chữ */
            /* Các thuộc tính CSS khác nếu cần */
            border: 1px solid red;
        }
        label{
            font-family: 'ADLaM Display Regular (in đậm)', sans-serif;
            font-size: 20px;
        }

        #button {
        text-align: center;
        display: flex; /* Sắp xếp các phần tử con theo chiều ngang */
        justify-content: space-between; /* Các phần tử con sẽ căn đều với khoảng cách giữa chúng */
        }   

        .button-form {
            flex: 1; /* Phần tử sẽ mở rộng ra để chiếm hết không gian có thể */
            margin-right: 10px; /* Khoảng cách giữa các phần tử */
        }

        .button {
            width: 50%; /* Nút button sẽ chiếm hết không gian của phần tử cha */
            height: 50px; /* Chiều cao của nút */
            background-color: #E95221;
            color: #fff;
            border: none;
            border-radius: 0; /* Góc bo tròn */
            cursor: pointer;
            font-size: 14px;
            text-align: center; /* Canh giữa nội dung */
            line-height: 50px; /* Chỉ đạo dòng giữa */
        }

        .button:hover {
            background-color: #ff6f4d; /* Màu nền mới khi nút được hover */
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
                    if ($isLoggedIn) {
                        echo '<a href="information.php"><img src="Images/user-regular-24.png" alt=""></a>';
                    } else {
                        echo '<a href="login.php"><img src="Images/user-regular-24.png" alt=""></a>';
                    }
                    ?>
                </div>
                <div class="item">
                    <?php
                    if ($isLoggedIn) {
                        echo '<a href="cart.php"><img src="Images/cart-download-regular-24.png" alt=""></a>';
                    } else {
                        echo '<a href="login.php"><img src="Images/cart-download-regular-24.png" alt=""></a>';
                    }
                    ?>
                </div>
            </div>
        </div>

        

        <!-- Hiển thị giỏ hàng -->
        <div id="cart">
            <h2>GIỎ HÀNG CỦA BẠN</h2>
            <table>
                <tr>
                    <th>Ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Tổng tiền</th>
                    <th></th>
                </tr>
                <?php
                if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $ipPrd => $product) {
                        echo "<tr>";
                        echo "<td><img src='Images/Products/{$product['image_prd']}' width='100' height='90' alt=''></td>";
                        echo "<td>{$product['name_prd']}</td>";
                        echo "<td>" . number_format($product['price_prd'], 0, ',', '.') . " VNĐ</td>";
                        echo "<td>";
                        echo "<form method='post'>";
                        echo "<input type='hidden' name='prd_id' value='$ipPrd'>";
                        echo "<button type='submit' name='decrease_quantity' value='$ipPrd'>-</button>";
                        echo "<span>" . (isset($product['quantity']) ? $product['quantity'] : 0) . "</span>";
                        echo "<button type='submit' name='increase_quantity' value='$ipPrd'>+</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "<td>" . number_format($product['price_prd'] * $product['quantity'], 0, ',', '.') . " VND</td>";
                        echo "<td><form method='post'><button type='submit' name='remove_product' value='$ipPrd'>Xóa</button></form></td>";
                        echo "</tr>";
                    }
                    echo "<tr><td colspan='5'><strong>Thành tiền:</strong></td><td>" . number_format(calculateTotal(), 0, ',', '.') . " VND</td></tr>";

                } else {
                    echo "<tr><td colspan='6'>Giỏ hàng của bạn đang trống.</td></tr>";
                }
                ?>
            </table>
            
            <!-- Form địa chỉ và phương thức thanh toán -->
            
            <form method="post">
                <!-- Các trường nhập địa chỉ -->
                <div>
                    <label for="address">Địa chỉ nhận hàng:</label>
                    <input type="text" id="address" name="shipping_address" required>
                </div>

                <!-- Phần chọn phương thức thanh toán -->
                <div>
                    <label>Phương thức thanh toán:</label>
                    <input type="radio" id="cash" name="payment_method" value="cash" required>
                    <label for="cash">Tiền mặt</label>

                    <input type="radio" id="wallet" name="payment_method" value="wallet" required>
                    <label for="wallet">Ví điện tử</label>

                    <input type="radio" id="bank" name="payment_method" value="bank" required>
                    <label for="bank">Ngân hàng</label>
                </div>

                <!-- Thêm trường ẩn để gửi prd_id -->
                <?php
                if (!empty($_POST['prd_id'])) {
                    echo '<input type="hidden" name="prd_id" value="' . $_POST['prd_id'] . '">';
                }
                ?>

                <div id="button">
                    <form class="button-form" method="post">
                        <button type="submit" name="pay" class="button">Thanh toán</button>
                    </form>

                    <!-- Form tiếp tục mua hàng -->
                    <form class="button-form" method="post" action="product.php">
                        <button type="submit" class="button">Tiếp tục mua hàng</button>
                    </form>
                </div>
            </form>



        
        </div>

        <?php
        if ($isLoggedIn) {
            if (isset($_POST['prd_id'])) {
                echo '<input type="hidden" name="prd_id" value="' . $_POST['prd_id'] . '">';
            }
            echo '<form method="post">';
            echo '</form>';
        } else {
            echo '<button type="button" onclick="redirectToLogin()">Đăng nhập để mua</button>';
        }

        if (isset($_POST['increase_quantity'])) {
            increaseQuantity($_POST['increase_quantity']);
        }

        if (isset($_POST['decrease_quantity'])) {
            decreaseQuantity($_POST['decrease_quantity']);
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