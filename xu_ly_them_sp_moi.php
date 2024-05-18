
<?php
include 'connection.php';

// Khởi tạo id cho sản phẩm mới (giá trị này nên được lấy từ cơ sở dữ liệu hoặc tạo tự động để đảm bảo tính duy nhất)
$cnt_id = 18;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tensp']) && isset($_POST['giasp']) && isset($_POST['loaisp']) && isset($_POST['soluongnhap']) && isset($_POST['donvi'])) {
    echo '<script>alert( $ten, $giasp, $loaisp, $soluong, $donvi );</script>';
    $ten = $_POST['tensp'];
    $giasp = $_POST['giasp'];
    $loaisp = $_POST['loaisp'];
    $soluong = $_POST['soluongnhap'];
    $donvi = $_POST['donvi'];

    // Sử dụng câu lệnh chuẩn bị (prepared statement) để bảo vệ chống SQL Injection
    $stmt = $conn->prepare('INSERT INTO tblsanpham ( ten, gia, soluong, tblloaisanphamid, donvi) VALUES ( ?, ?, ?, ?, ?)');

    $stmt->bind_param('sdiis',  $ten, $giasp, $soluong, $loaisp, $donvi);
    // Tăng cnt_id trước khi thực hiện câu lệnh


    if ($stmt->execute()) {

        // thực hiện insert vào bảng tblphieunhap
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $date = date('Y-m-d H:i:s'); // Get current date
        $stmt1 = $conn->prepare('INSERT INTO tblphieunhap (ngaynhap, soluongnhap, tblsanphamid) VALUES (?, ?, (SELECT id FROM tblsanpham ORDER BY id DESC LIMIT 1))');

        $stmt1->bind_param('si', $date, $soluong); // Bind the parameters
        $stmt1->execute(); // Execute the statement

        echo '<script>
        alert("Nhập sản phẩm mới thành công");
        window.location.href = "nhap_san_pham_moi.php";
      </script>';
        exit(); // Đảm bảo script dừng lại sau khi chuyển hướng
        exit(); // Đảm bảo script dừng lại sau khi chuyển hướng
    } else {
        echo '<script>alert("Có lỗi xảy ra: ' . $stmt->error . '");</script>';
    }

    $stmt->close();
}
$conn->close();
?>
