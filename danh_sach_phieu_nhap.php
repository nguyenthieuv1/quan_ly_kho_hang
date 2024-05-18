<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./main.css">
    <style>
        .height {
            height: 100vh;
        }
    </style>
</head>

<body>
    <div class="container-fluid p-0 height">
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
            <div class="container-fluid">
                <!-- <i class="navbar-brand" src="./img/logo.jpg"></i> -->
                <a href="home1.php"><i class="fa-solid fa-warehouse navbar-brand"></i></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mynavbar">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="kho1.php">Sản phẩm</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" type="button" data-bs-toggle="offcanvas" data-bs-target="#demo">
                                Menu
                            </a>
                        </li>

                    </ul>
                    <ul class="navbar-nav justify-content-end">
                        <li class="nav-item">
                            <a href="/logout.php" class="nav-link">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i> Đăng xuất
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="container" id="body-kho1">
            <h4 class="text-center" style="margin-top: 75px;">Danh sách phiếu nhập</h4>
            <table class="table text-center">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Mã phiếu</th>
                        <th scope="col">Ngày nhập</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Số lượng nhập</th>
                        <th scope="col">Thể loại</th>
                        <th scope="col">Giá nhập</th>
                        <th scope="col">Đơn vị</th>
                        <th scope="col" colspan="2">Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr> -->
                    <?php
                    include("connection.php");
                    $cnt = 1;
                    $sql = "SELECT tblphieunhap.id, tblphieunhap.ngaynhap, tblphieunhap.soluongnhap,
                    tblsanpham.ten, tblsanpham.donvi ,tblsanpham.gia, tblloaisanpham.tenloai
                    FROM (tblphieunhap
                    INNER JOIN tblsanpham ON tblphieunhap.tblsanphamid = tblsanpham.id)
                    INNER JOIN tblloaisanpham ON tblloaisanpham.id = tblsanpham.tblloaisanphamid
                    order by tblphieunhap.id desc
                    ";

                    // Thực thi truy vấn
                    $result = mysqli_query($conn, $sql);

                    // Xử lý kết quả
                    if (mysqli_num_rows($result) > 0) {
                        // Lặp qua từng dòng dữ liệu

                        while ($row = mysqli_fetch_assoc($result)) {
                            // Xử lý dòng dữ liệu, ví dụ:
                    ?>
                            <tr>
                                <th scope="row"><?php echo $cnt;
                                                $cnt++ ?></th>
                                <td>
                                    <?php echo $row["id"]; ?>
                                </td>
                                <td><?php echo $row["ngaynhap"]; ?></td>
                                <td><?php echo $row["ten"]; ?></td>
                                <td><?php echo $row["soluongnhap"]; ?></td>
                                <td><?php echo $row["tenloai"]; ?></td>
                                <td><?php echo $row["gia"]; ?></td>
                                <td><?php echo $row["donvi"]; ?></td>                                
                                <td><a class="btn btn-danger" href="delete_phieu_nhap.php?id=<?php echo $row["id"]; ?>">xóa</a></td>
                            </tr>


                    <?php
                        }
                    } else {
                        echo "0 results";
                    }
                    mysqli_close($conn);
                    ?>

                </tbody>
            </table>
        </div>


        <!-- Offcanvas Sidebar -->
        <div class="offcanvas offcanvas-start text-bg-dark" id="demo">
            <div class="offcanvas-header">
                <h1 class="offcanvas-title">Menu</h1>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">

                <nav class="navbar navbar-dark bg-dark">

                    <div class="container-fluid">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="nhap_san_pham_moi.php">Nhập sản phẩm mới</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="nhap_san_pham_san_co.php">Nhập thêm sản phẩm sẵn có</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="danh_sach_phieu_nhap.php">Xem danh sách phiếu nhập</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="xuat_san_pham.php">Xuất sản phẩm từ kho</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="danh_sach_phieu_xuat.php">Danh sách phiếu xuất</a>
                            </li>

                        </ul>
                    </div>
                </nav>
            </div>
        </div>

    </div>
    <div class=" p-4 bg-dark text-white text-center">
        <div class="row">
            <div class="col-md-5">
                <h5>Thông tin liên hệ</h5>
                <p>Công ti cổ phần dienmayxanh</p>
                <p>Địa chỉ: số 12 đường trần phú Hà Đông - Hà Nội</p>
                <p>Điện thoại: 0356789123</p>
            </div>
            <div class="col-md-7" >
                <iframe style="width:50%; height:auto" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3552.0744070526566!2d105.8166201792928!3d20.944738930877687!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ad34d09b9179%3A0xb21777bca21268f9!2zS2hvIMSQaeG7h24gbcOheSB4YW5oIFRhbSBIaeG7h3A!5e1!3m2!1svi!2s!4v1715746774108!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>

</body>

</html>