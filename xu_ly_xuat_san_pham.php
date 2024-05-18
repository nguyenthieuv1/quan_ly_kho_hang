
<?php
include 'connection.php';

// Khởi tạo id cho sản phẩm mới (giá trị này nên được lấy từ cơ sở dữ liệu hoặc tạo tự động để đảm bảo tính duy nhất)

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])  && isset($_POST['soluongxuat'])) {

    $id = $_POST['id'];
    $soluong = $_POST['soluongxuat'];

    // Sử dụng câu lệnh chuẩn bị (prepared statement) để bảo vệ chống SQL Injection
    $stmt = $conn->prepare('UPDATE tblsanpham
    SET soluong = soluong-?
    WHERE id=?');
    $stmt->bind_param('ii',  $soluong, $id);
    
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $date = date('Y-m-d H:i:s'); // Get current date
    $stmt1 = $conn->prepare('INSERT INTO tblphieuxuat(ngayxuat, soluongxuat, tblsanphamid) VALUES (?, ?, ?)');

    $stmt1->bind_param('sii', $date, $soluong,$id); // Bind the parameters
    $stmt1->execute(); // Execute the statement
    if ($stmt->execute()) {


       
        echo '<script>
        alert("Đã xuất '. $soluong .' sản phẩm từ kho thành công");      
        window.location.href = "xuat_san_pham.php"; 
      </script>';
        exit(); // Đảm bảo script dừng lại sau khi chuyển hướng

    } else {
        echo '<script>alert("Có lỗi xảy ra: ' . $stmt->error . '");</script>';
    }

    $stmt->close();
}
$conn->close();
?>