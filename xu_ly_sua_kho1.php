<?php
include 'connection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tensp']) && isset($_POST['giasp'])&& isset($_POST['soluongnhap']) && isset($_POST['donvi'])) {
    
    $ten = $_POST['tensp'];
    $giasp = $_POST['giasp'];
    // $loaisp = $_POST['loaisp'];
    $soluong = $_POST['soluongnhap'];
    $donvi = $_POST['donvi'];
    $id = intval($_GET['id']); // Đảm bảo rằng id là số nguyên

    // Sử dụng câu lệnh chuẩn bị (prepared statement) để bảo vệ chống SQL Injection
    $stmt = $conn->prepare('UPDATE tblsanpham 
    SET ten = ?, gia = ?, soluong = ?, donvi = ?
    WHERE id = ?');

    $stmt->bind_param('sdisi', $ten, $giasp, $soluong, $donvi, $id);

    if ($stmt->execute()) {
        // Nếu cần thêm logic insert vào bảng tblphieunhap, hãy thêm ở đây

        echo '<script>
        alert("cập nhật sản phâm thành công");
        window.location.href = "kho1.php";
        </script>';
        exit(); // Đảm bảo script dừng lại sau khi chuyển hướng
    } else {
        echo '<script>alert("Có lỗi xảy ra: ' . $stmt->error . '");</script>';
    }

    $stmt->close();
}
$conn->close();
?>
