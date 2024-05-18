<?php
ob_start();
// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shoestore";
$conn = new mysqli($servername, $username, $password, $dbname);

// Lấy khoảng thời gian từ yêu cầu AJAX
// Lấy ngày từ yêu cầu AJAX
$ngay = $_POST['ngay'];

// Truy vấn dữ liệu theo nhãn hiệu và ngày
$sql_nhanhieu = "SELECT nh.TenNhanHieu, SUM(ctpx.SoLuong) AS TongSoLuong
                 FROM phieuxuat px
                 JOIN ctpx ON px.MaPX = ctpx.MaPX
                 JOIN sanpham sp ON ctpx.MaSP = sp.MaSP
                 JOIN nhanhieu nh ON sp.MaNhanHieu = nh.MaNhanHieu
                 WHERE px.TinhTrangDH = 'Đã hoàn thành' AND DATE(px.NgayDatHang) = '$ngay'
                 GROUP BY nh.TenNhanHieu;";

$result_nhanhieu = $conn->query($sql_nhanhieu);
$data_nhanhieu = array();
$sql_sanpham = "SELECT sp.TenSP, sp.HinhAnh, nh.TenNhanHieu, l.TenLoai, SUM(ctpx.SoLuong) AS TongSoLuong
    FROM sanpham sp
    JOIN nhanhieu nh ON sp.MaNhanHieu = nh.MaNhanHieu
    JOIN loaisp l ON sp.MaLoai = l.MaLoai
    JOIN ctpx ON ctpx.MaSP = sp.MaSP
    JOIN phieuxuat px ON ctpx.MaPX = px.MaPX
    WHERE px.TinhTrangDH = 'Đã hoàn thành' AND DATE(px.NgayDatHang) = ?
    GROUP BY sp.MaSP, sp.TenSP, sp.HinhAnh, nh.TenNhanHieu, l.TenLoai;";

$stmt_sanpham = $conn->prepare($sql_sanpham);
$stmt_sanpham->bind_param("s", $ngay);
$stmt_sanpham->execute();
$result_sanpham = $stmt_sanpham->get_result();

$san_pham = array();
if ($result_sanpham->num_rows > 0) {
    while ($row = $result_sanpham->fetch_assoc()) {
        $san_pham[] = array(
            'TenSP' => $row['TenSP'],
            'HinhAnh' => $row['HinhAnh'],
            'TenNhanHieu' => $row['TenNhanHieu'],
            'TenLoai' => $row['TenLoai'],
            'TongSoLuong' => $row['TongSoLuong']
        );
    }
}

if ($result_nhanhieu->num_rows > 0) {
    while($row = $result_nhanhieu->fetch_assoc()) {
        $data_nhanhieu[] = array(
            'label' => $row['TenNhanHieu'],
            'value' => $row['TongSoLuong']
        );
    }
}

// Truy vấn dữ liệu theo loại sản phẩm và ngày
$sql_loaisp = "SELECT loai.TenLoai, SUM(ctpx.SoLuong) AS TongSoLuong
               FROM phieuxuat px
               JOIN ctpx ON px.MaPX = ctpx.MaPX
               JOIN sanpham sp ON ctpx.MaSP = sp.MaSP
               JOIN loaisp loai ON sp.MaLoai = loai.MaLoai
               WHERE px.TinhTrangDH = 'Đã hoàn thành' AND DATE(px.NgayDatHang) = '$ngay'
               GROUP BY loai.TenLoai;";

$result_loaisp = $conn->query($sql_loaisp);
$data_loaisp = array();

if ($result_loaisp->num_rows > 0) {
    while($row = $result_loaisp->fetch_assoc()) {
        $data_loaisp[] = array(
            'label' => $row['TenLoai'],
            'value' => $row['TongSoLuong']
        );
    }
}

// Truy vấn để lấy tổng số lượng sản phẩm theo ngày
$sql_tong_so_luong = "SELECT SUM(ctpx.SoLuong) AS TongSoLuong
                      FROM phieuxuat px
                      JOIN ctpx ON px.MaPX = ctpx.MaPX
                      WHERE px.TinhTrangDH = 'Đã hoàn thành' AND DATE(px.NgayDatHang) = '$ngay'";

$result_tong_so_luong = $conn->query($sql_tong_so_luong);
$data_tong_so_luong = array();

if ($result_tong_so_luong->num_rows > 0) {
    while($row = $result_tong_so_luong->fetch_assoc()) {
        $data_tong_so_luong[] = array(
            'value' => $row['TongSoLuong']
        );
    }
}

// Truy vấn để lấy tổng tiền dựa trên số lượng và giá bán theo ngày
$sql_tong_tien = "SELECT SUM(ctpx.SoLuong * ctpx.GiaBan) AS TongTien
                  FROM phieuxuat px
                  JOIN ctpx ON px.MaPX = ctpx.MaPX
                  JOIN sanpham sp ON ctpx.MaSP = sp.MaSP
                  WHERE px.TinhTrangDH = 'Đã hoàn thành' AND DATE(px.NgayDatHang) = '$ngay'";

$result_tong_tien = $conn->query($sql_tong_tien);
$data_tong_tien = array();

if ($result_tong_tien->num_rows > 0) {
    while($row = $result_tong_tien->fetch_assoc()) {
        $data_tong_tien[] = array(
            'value' => $row['TongTien']
        );
    }
}
$sql_doanh_thu = "SELECT SUM(ctpx.SoLuong * 0.1 * ctpx.GiaBan) AS DoanhThu
                   FROM phieuxuat px
                   JOIN ctpx ON px.MaPX = ctpx.MaPX
                   JOIN sanpham sp ON ctpx.MaSP = sp.MaSP
                   WHERE px.TinhTrangDH = 'Đã hoàn thành' AND DATE(px.NgayDatHang) = ?";

$stmt_doanh_thu = $conn->prepare($sql_doanh_thu);
$stmt_doanh_thu->bind_param("s", $ngay);
$stmt_doanh_thu->execute();
$result_doanh_thu = $stmt_doanh_thu->get_result();
$data_doanh_thu = array();

if ($result_doanh_thu->num_rows > 0) {
    while($row = $result_doanh_thu->fetch_assoc()) {
        $data_doanh_thu[] = array(
            'value' => $row['DoanhThu']
        );
    }
}

// Trả về dữ liệu dưới dạng JSON
$response = array(
    'san_pham' => $san_pham,
    'nhan_hieu' => $data_nhanhieu,
    'loai_sp' => $data_loaisp,
    'tong_so_luong' => $data_tong_so_luong,
    'tong_tien' => $data_tong_tien,
    'doanh_thu' => $data_doanh_thu
);

echo json_encode($response);

$conn->close();
?>