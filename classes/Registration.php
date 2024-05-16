<?

require_once 'connect.php';
require_once 'classes/User.php';
require_once 'config.php';

class Registration
{
    private $user;
    private $conn;
    private $registrationStatus;

    private $nameError;
    private $emailError;
    private $phoneError;
    private $passwordError;

    public function __construct(User $user)
    {
        $this->user = $user;
        
        $this->conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

        if ($this->conn->connect_error) {
            die("Kết nối đến cơ sở dữ liệu thất bại: " . $this->conn->connect_error);
        }
    }

    public function register()
    {
        // Validate input fields
        $this->validateUsername();
        $this->validateEmail();
        $this->validatePhone();
        $this->validatePassword();

        // Kiểm tra xem có thông báo lỗi hay không
        if ($this->nameError || $this->emailError || $this->phoneError || $this->passwordError) {
            $this->registrationStatus = 'Đăng ký thất bại. Vui lòng kiểm tra lại thông tin đăng ký.';
        } else {
            // Hash the password
            $hashedPassword = password_hash($this->user->getPassword(), PASSWORD_DEFAULT);

            // Prepare the SQL statement
            $stmt = $this->conn->prepare("INSERT INTO users (name, email, phone, password) VALUES (?, ?, ?, ?)");

            // Bind parameters
            $name = trim($this->user->getName());
            $phone = $this->user->getPhone();
            $email = $this->user->getEmail();
            $stmt->bind_param("ssss", $name, $email, $phone, $hashedPassword);

            // Execute the statement
            try {
                if ($stmt->execute()) {
                    $this->registrationStatus = 'Đăng ký thành công!';
                    header("Location: login.php");
                    exit;
                } else {
                    throw new Exception('Lỗi execute.');
                }
            } catch (Exception $e) {
                error_log('Lỗi: ' . $e->getMessage()); // Ghi lỗi vào tập tin log
                $this->registrationStatus = 'Đăng ký thất bại. Vui lòng thử lại.';
            }

            // Close the statement
            $stmt->close();
        }
    }

    public function getRegistrationStatus() 
    {
        return $this->registrationStatus;
    }
    public function getNameError()
    {
        return $this->nameError;
    }
    public function getEmailError()
    {
        return $this->emailError;
    }
    public function getPhoneError()
    {
        return $this->phoneError;
    }
    public function getPassError()
    {
        return $this->passwordError;
    }

    private function isUserExists()
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE phone = ? OR email = ?");
        $stmt->bind_param("ss", $phone, $email);
    
        $phone = $this->user->getPhone();
        $email = $this->user->getEmail();
    
        $stmt->execute();
        $stmt->store_result();
        $numRows = $stmt->num_rows;
    
        $stmt->close();
    
        return $numRows > 0;
    }

    private function validateUsername()
    {
        $username = trim($this->user->getName());
        if (!preg_match('/^[a-zA-Z\s0-9]+$/', $username)) {
            $this->nameError = 'Tên không hợp lệ!';
        }
    }

    private function validateEmail()
    {
        // Validate email
        $email = $this->user->getEmail();
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->emailError = 'Email không hợp lệ!';
        }
    }

    private function validatePhone()
    {
        // Validate phone
        $phone = $this->user->getPhone();
        if (!preg_match('/^(0\d{9}|(\+84)\d{9})$/', $phone)) {
            $this->phoneError = 'Số điện thoại không hợp lệ!';
        }
    }

    private function validatePassword()
    {
        // Validate password
        $password = $this->user->getPassword();
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $password)) {
            $this->passwordError = 'Mật khẩu không đủ mạnh! Cần ít nhất 8 ký tự, 1 chữ số, 1 chữ thường và 1 chữ in hoa';
        }
    }
}

?>
