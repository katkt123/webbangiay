<?php

$id = $_GET['id'];

// Kết nối với cơ sở dữ liệu
$conn = mysqli_connect("localhost", "root", "", "shoestore");
  
  //lấy thông tin sản phẩm,khách hàng,nhân viên
$sql="SELECT
  px.NgayDatHang,
  px.TinhTrangDH,
  px.TongSoLuong,
  khachhang.HoTen as HotenKH,
  khachhang.SDT as SDTKH,
  khachhang.DiaChi as diachi,
  sanpham.TenSP,
  sanpham.HinhAnh,
  ctpx.SoLuong,
  ctpx.SizeSP,
  ctpx.GiaBan
FROM phieuxuat px
INNER JOIN ctpx ON px.MaPX = ctpx.MaPX
INNER JOIN user khachhang ON px.MaKH = khachhang.Ma
INNER JOIN sanpham ON ctpx.MaSP = sanpham.MaSP
WHERE px.MaPX = $id;";
$result = $conn->query($sql);
if ($result->num_rows === 0) {
    echo "<p>Không có dữ liệu phiếu xuất.</p>";
    die();
  }
if ($result->num_rows > 0) {
    // Lấy dữ liệu
    $row = $result->fetch_assoc();
    $ngayDatHang = $row['NgayDatHang'];
   $tinhTrangDonHang = $row['TinhTrangDH'];
   $tongSoLuong = $row['TongSoLuong']; 
    $hotenKH = $row['HotenKH'];
    $sdtKH = $row['SDTKH'];
    $diaChi = $row['diachi'];
    $hinhAnh = $row['HinhAnh'];
    $tenSP = $row['TenSP'];
    $soLuong = $row['SoLuong'];
    $size = $row['SizeSP'];
    $giaBan = $row['GiaBan'];
    $tongTienSP = $soLuong * $giaBan;
    $tongTien =0;
    $tongTien += $tongTienSP;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin chi tiết đơn hàng</title>
    <style>

        .container {
            max-width: 100%;
            margin: 0 auto;
            overflow: hidden;
        }
        .left-column {
            float: left;
            width: 70%; 
            padding-left:20px;
        }
        .right-column {
            float: right;
            width: 30%;
        }
        h1 {
            text-align: center;
        }

        .info-wrapper {
            border: 1px solid #ddd;
            padding: 20px;
        }

        .row {
            display: flex;
            margin-bottom: 10px;
        }

        .label {
            width: 150px;
            font-weight: bold;
        }

        .value {
            flex: 1;
        }

        img {
            max-width: 100px;
        }

        .table-info {
            width: 100%;
            border-collapse: collapse;
        }

        .table-info th, .table-info td {
            border: 1px solid #ddd;
            padding: 5px;
            text-align: center;
        }

        .table-info tfoot {
            font-weight: bold;
        }
        #back{
            background-color: #ddd;
            color:black;
            border: 1px solid #0077b5;
            border-radius: 5px;
            padding: 10px 20px;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            font-weight: bold;
        }
        #back a{
            text-decoration: none;
        }
    </style>
</head>
<body>

<div id="form-chi-tiet">
        <div class="container">  
        <button onclick="quayLai()" id="back">Quay lại</button>
        <script>
            function quayLai() {
            window.location.href = "index.php?danhmuc=quanlydonhang";
            }
        </script>
        <h1>Thông tin chi tiết hóa đơn</h1> 
        <br>  
        <div class="left-column">
            <div class="row">
                <div class="label">Tên khách hàng:</div>
                <div class="value"><?php echo $hotenKH; ?></div>
            </div>
            <div class="row">
                <div class="label">Số điện thoại:</div>
                <div class="value"><?php echo $sdtKH; ?></div>
            </div>
            <div class="row">
                <div class="label">Địa chỉ giao hàng:</div>
                <div class="value"><?php echo $diaChi; ?></div>
            </div>
        </div>
        <div class="right-column">
            <div class="row">
                <div class="label">Ngày đặt hàng:</div>
                <div class="value"><?php echo $ngayDatHang; ?></div>
            </div>
            <div class="row">
                <div class="label">Tình trạng đơn hàng:</div>
                <div class="value"><?php echo $tinhTrangDonHang; ?></div>
            </div>
                <div class="row">
                <div class="label">Tổng số lượng:</div>
                <div class="value"><?php echo $tongSoLuong; ?></div>
            </div>
        </div>
            <table class="table-info">
                <thead>
                    <tr style="background-color: cornflowerblue;">
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Số lượng</th>
                        <th>Size</th>
                        <th>Giá bán</th>
                        <th>Tổng tiền</th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td>1</td>
                            <td style="text-align: left;"><?php echo $tenSP; ?></td>
                            <td><img src="../assets/img/<?php echo $hinhAnh; ?>" alt="<?php echo $hinhAnh; ?>"></td>
                            <td><?php echo $soLuong; ?></td>
                            <td><?php echo $size; ?></td>
                            <td><?php echo number_format($giaBan, 0, ',', '.'); ?> VNĐ</td>
                            <td><?php echo number_format($tongTienSP, 0, ',', '.'); ?> VNĐ</td>
                        </tr>
                    <?php
                    $stt = 2;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $hinhAnh = $row['HinhAnh'];
                        $tenSP = $row['TenSP'];
                        $soLuong = $row['SoLuong'];
                        $size = $row['SizeSP'];
                        $giaBan = $row['GiaBan'];
                        $tongTienSP = $soLuong * $giaBan;
                        $tongTien += $tongTienSP;
                    ?>
                        <tr>
                            <td><?php echo $stt++; ?></td>
                            <td style="text-align: left;"><?php echo $tenSP; ?></td>
                            <td><img src="../assets/img/<?php echo $hinhAnh; ?>" alt="<?php echo $hinhAnh; ?>"></td>
                            <td><?php echo $soLuong; ?></td>
                            <td><?php echo $size; ?></td>
                            <td><?php echo number_format($giaBan, 0, ',', '.'); ?> VNĐ</td>
                            <td><?php echo number_format($tongTienSP, 0, ',', '.'); ?> VNĐ</td>
                        </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="6">Tổng tiền</th>
                        <th><?php echo number_format($tongTien, 0, ',', '.'); ?> VNĐ</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    </div>
    </div>
    </div>
</body>
</html>
