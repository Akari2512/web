<?php
// Kết nối đến cơ sở dữ liệu
$servername = "localhost"; // Tên máy chủ MySQL
$username = "root"; // Tên người dùng MySQL
$password = "mysql"; // Mật khẩu của người dùng MySQL
$dbname = "caulong"; // Tên cơ sở dữ liệu

// Tạo kết nối đến cơ sở dữ liệu
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Lấy dữ liệu từ biểu mẫu liên hệ
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];

// Chèn dữ liệu vào bảng contact_form
$sql = "INSERT INTO contact_form (contact_name, contact_email, contact_phone, contact_message) VALUES ('$name', '$email', '$phone', '$message')";

if ($conn->query($sql) === TRUE) {
    echo "Dữ liệu đã được gửi thành công!";
} else {
    echo "Lỗi: " . $sql . "<br>" . $conn->error;
}

// Đóng kết nối đến cơ sở dữ liệu
$conn->close();

// Xử lý form và gửi email (nếu cần)
// ...

// Sau khi xử lý form thành công, thực hiện chuyển hướng trang web
header("Location: contact.php"); // Chuyển hướng về trang chủ của website
exit; // Đảm bảo không có mã HTML hoặc PHP nào được thực thi sau lệnh chuyển hướng


?>
