<?php
// Bắt đầu hoặc khởi tạo session
session_start();

// Xóa toàn bộ session
session_unset();

// Hủy toàn bộ session
session_destroy();

// Chuyển hướng về trang đăng nhập hoặc trang chính của ứng dụng
header("Location: login.php"); // Thay 'login.php' bằng URL của trang đăng nhập hoặc trang chính của ứng dụng
exit();
?>