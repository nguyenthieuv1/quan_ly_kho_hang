<?php
session_start(); // Bắt đầu phiên làm việc

include("connection.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'])  && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM tbluser";
    // Thực thi truy vấn
    $result = mysqli_query($conn, $sql);
    // Kiểm tra số bản ghi trả về có lớn hơn 0 hay không
    if (mysqli_num_rows($result) > 0) {
        // Lặp qua từng dòng dữ liệu
        $check =false;
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['username'] == $username && $row['password'] == $password) {

                 // Lưu thông tin người dùng vào session
                $_SESSION['username'] = $username;
                $check = true;
                header('Location: secure_page.php');                
                exit;
            }
        }
        if (!$check) {            
            echo "<script>alert('Sai tên đăng nhập hoặc mật khẩu!'); window.location = 'login.php'</script>  ";
        }
    }
}
?>