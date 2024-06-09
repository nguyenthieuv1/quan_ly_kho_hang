<?php
include 'connection.php';

    $id = intval($_GET['id']); // Đảm bảo rằng id là số nguyên

    // Sử dụng câu lệnh chuẩn bị (prepared statement) để bảo vệ chống SQL Injection
    $stmt = $conn->prepare('DELETE from tblsanpham
    WHERE id = ?');

    $stmt->bind_param('i', $id);

   try {
        if ($stmt->execute()) {
            // Nếu cần thêm logic insert vào bảng tblphieunhap, hãy thêm ở đây
    
            echo '<script>
            alert("đã xóa thành công");
            window.location.href = "kho1.php";
            </script>';
            exit(); // Đảm bảo script dừng lại sau khi chuyển hướng
        }
    } catch (Exception $e) {
        echo '<script>
        alert("Có lỗi xảy ra: bạn phải xóa phiếu nhập và phiếu xuất trước khi xóa sản phẩm này");
        window.location.href = "kho1.php";
        </script>';
        exit();
    }


    $stmt->close();

$conn->close();
?>
