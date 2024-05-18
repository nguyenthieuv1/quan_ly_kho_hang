<?php
session_start(); // Tiếp tục phiên làm việc

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!isset($_SESSION['username'])) {
    // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
    header('Location: login.php');
    exit;
}
else{
    header('Location: home1.php');
}

?>
<a href="logout.php">Đăng xuất</a>
