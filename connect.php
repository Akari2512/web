<?
    
    $server = 'localhost';
    $user = 'root';
    $pass = 'mysql';
    $database = 'caulong';

    $conn = new mysqli($server, $user, $pass, $database);

    if ($conn->connect_error) {
        die("Kết nối không thành công: " . $conn->connect_error);
    }

?>

