<?php
// Kết nối đến cơ sở dữ liệu
include "connect.php";

// Xử lý dữ liệu từ form và chèn vào cơ sở dữ liệu
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $content = $_POST['content'];
    $rating = $_POST['rating'];

    // Thực hiện truy vấn để chèn đánh giá vào cơ sở dữ liệu
    $sql = "INSERT INTO reviews (content, rating) VALUES ('$content', '$rating')";
    if (mysqli_query($conn, $sql)) {
        echo "Đánh giá đã được gửi thành công.";
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
}
?>
