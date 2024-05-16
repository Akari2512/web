<?php

require_once 'connect.php';
require_once 'classes/User.php';
require_once 'config.php';

class Login
{
    private $user;
    private $conn;
    private $loginStatus;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

        if ($this->conn->connect_error) {
            die("Kết nối đến cơ sở dữ liệu thất bại: " . $this->conn->connect_error);
        }
    }

    public function authenticate()
{
    $emailOrPhone = $this->user->getEmail();
    $password = $this->user->getPassword(); // Lấy mật khẩu chưa hashed từ người dùng

    // Lấy mật khẩu đã hashed từ cơ sở dữ liệu
    $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ? OR phone = ?");
    $stmt->bind_param("ss", $emailOrPhone, $emailOrPhone);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the query returned a row
    if ($result->num_rows > 0) {
        // Fetch the user data
        $userData = $result->fetch_assoc();
        $hashedPasswordFromDatabase = $userData['password']; // Lấy mật khẩu đã hashed từ cơ sở dữ liệu
        $passwordFromUser = $this->user->getPassword(); // Lấy mật khẩu chưa hashed từ người dùng
        // Verify the password
        // So sánh
        if (password_verify($passwordFromUser, $hashedPasswordFromDatabase)) {
            // Đăng nhập thành công

            $this->loginStatus = 'Đăng nhập thành công!';
            return true;
        } else {
            // Đăng nhập thất bại
            $this->loginStatus = 'Sai tên đăng nhập hoặc mật khẩu không đúng. Vui lòng thử lại.';
            return false;
        }
    } else {
        $this->loginStatus = 'Tài khoản không tồn tại. Vui lòng kiểm tra lại thông tin đăng nhập.';
        return false;
    }
}
    public function getUserDataFromDatabase()
    {
        $loginIdentifier = $this->user->getLoginIdentifier();

        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ? OR phone = ?");
        $stmt->bind_param("ss", $loginIdentifier, $loginIdentifier);
        
        $stmt->execute();
        $result = $stmt->get_result();

        // Lấy dữ liệu người dùng từ kết quả
        $userData = $result->fetch_assoc();

        $stmt->close();

        return $userData;
    }

    public function getLoginStatus()
    {
        return $this->loginStatus;
    }
}
?>
