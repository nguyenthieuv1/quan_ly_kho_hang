<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="./main.css">
    <style>
        .height {
            height: auto;
        }
    </style>
</head>

<body>

    <div class="container-fluid height" id="body-home">
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top">
            <div class="container-fluid">
                <!-- <i class="navbar-brand" src="./img/logo.jpg"></i> -->
                <i class="fa-solid fa-warehouse navbar-brand"></i>

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

        <div class="container mb-5" style="margin-top:94px;" id="khohang-card">

            <div class="row">
                <div class="col-md-4">
                    <h2>Danh sách loại sản phẩm</h2>
                    <p>số lượng sản phẩm chứa trong kho </p>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Loại sản phẩm</th>
                                <th>Số lượng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- <tr>
                                <td>John</td>
                                <td>Doe</td>
                                <td>john@example.com</td>
                            </tr> -->
                            <?php
                            include("connection.php");
                            $sql = "SELECT tblloaisanpham.tenloai, SUM( tblsanpham.soluong ) AS soluong
                FROM (tblsanpham 
                INNER JOIN tblloaisanpham ON tblsanpham.tblloaisanphamid = tblloaisanpham.id)
                GROUP BY tblloaisanpham.tenloai
                ORDER BY soluong desc  ";

                            $cnt_stt = 1;
                            $tenloai = [];
                            $soluong = [];

                            $result = mysqli_query($conn, $sql);
                            $sum = 0;
                            if (mysqli_num_rows($result) > 0) {

                                while ($row = mysqli_fetch_assoc($result)) {
                                    // lấy dữ liệu cho biểu đồ
                                    $tenloai[] = $row['tenloai'];
                                    $soluongtmp[] = $row['soluong'];
                                    $sum += $row['soluong'];

                                    echo ' <tr>
                                    <td>' . $cnt_stt++ . '</td>
                                    <td>' . $row['tenloai'] . '</td>
                                    <td>' . $row['soluong'] . '</td>                                    
                                    </tr>';
                                    // in ra bảng

                                }
                                foreach ($soluongtmp as $sl) {
                                    $soluong[] = ($sl / $sum) * 100;
                                }
                            }
                            ?>

                        </tbody>
                    </table>

                </div>

                <div class="col-md-8">
                    <div class="container " style="width: 100%;">
                        <h2 class="text-center">Biểu đồ tỉ lệ sản phẩm trong kho</h2>
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <canvas id="myPieChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <!-- Bootstrap JS -->
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
            <!-- Custom JS to create the chart -->
            <script>
                // Data for the pie chart
                const data = {
                    labels: <?php echo json_encode($tenloai); ?>,
                    datasets: [{
                        label: 'tỉ lệ ',
                        data: <?php echo json_encode($soluong); ?>,
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(54, 162, 235)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(153, 102, 255)',
                            'rgb(255, 159, 64)',
                            'rgb(102, 255, 204)',
                            'rgb(51, 102, 255)'
                        ],
                        hoverOffset: 4
                    }]
                };

                // Configuration for the pie chart
                const config = {
                    type: 'pie',
                    data: data,
                };

                // Render the pie chart
                const myPieChart = new Chart(
                    document.getElementById('myPieChart'),
                    config
                );
            </script>




        </div>


        <!-- Offcanvas Sidebar -->
        <div class="offcanvas offcanvas-start text-bg-dark" id="demo">
            <div class="offcanvas-header">
                <h1 class="offcanvas-title">Menu</h1>
                <button type="button" class="btn-close text-reset btn-close-white" data-bs-dismiss="offcanvas"></button>
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
            <div class="col-md-7">
                <iframe style="width:50%; height:auto" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3552.0744070526566!2d105.8166201792928!3d20.944738930877687!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ad34d09b9179%3A0xb21777bca21268f9!2zS2hvIMSQaeG7h24gbcOheSB4YW5oIFRhbSBIaeG7h3A!5e1!3m2!1svi!2s!4v1715746774108!5m2!1svi!2s" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

            </div>
        </div>
    </div>

</body>

</html>