<?php
include "connect.php"; // Kết nối đến cơ sở dữ liệu

// Kiểm tra xem dữ liệu đã được gửi từ biểu mẫu hay chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ biểu mẫu
    $comment_content = $_POST['comment_content'];
    $rating = $_POST['rating']; // Đánh giá sao

    // Kiểm tra xem có sản phẩm ID được gửi từ trang product_detail.php không
    if (isset($_POST['prd_id'])) {
        $product_id = $_POST['prd_id']; // Lấy ID sản phẩm từ form
        // SQL để chèn dữ liệu vào cơ sở dữ liệu
        $sql = "INSERT INTO reviews (comment_content, rating, prd_id) VALUES ('$comment_content', '$rating', '$product_id')";

        // Thực thi truy vấn
        if (mysqli_query($conn, $sql)) {
            echo "Bình luận đã được gửi thành công.";
            // Chuyển hướng lại trang sản phẩm sau khi gửi đánh giá
            header("Location: product_detail.php?prd_id=$product_id");
            exit(); // Dừng script sau khi chuyển hướng
        } else {
            echo "Lỗi: " . mysqli_error($conn);
        }
    } else {
        echo "Lỗi: Không có sản phẩm được chọn.";
    }
}

// Lấy ID của sản phẩm từ URL
if (isset($_GET['prd_id'])) {
    $product_id = $_GET['prd_id'];

    // Truy vấn để lấy các bình luận và đánh giá cho sản phẩm cụ thể
    $sql = "SELECT * FROM reviews WHERE prd_id = $product_id";
    $result = mysqli_query($conn, $sql);

    // Tiêu đề trang
    echo "<h1>Đánh giá và Bình luận cho sản phẩm</h1>";

    // Kiểm tra và hiển thị dữ liệu
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<h3>Đánh giá: " . $row['rating'] . "</h3>";
            echo "<p>Bình luận: " . $row['comment_content'] . "</p>";
            echo "<hr>";
        }
    } else {
        echo "<p>Chưa có đánh giá nào cho sản phẩm này.</p>";
    }
} else {
    echo "Lỗi: Không có sản phẩm được chọn.";
}

// Đóng kết nối
mysqli_close($conn);
?>
