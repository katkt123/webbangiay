<?php
ob_start();

// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shoestore";
$conn = new mysqli($servername, $username, $password, $dbname);

// Lấy loại sản phẩm từ yêu cầu AJAX
$loai = $_POST['loai'];
$sql_nhanhieu = "SELECT nh.TenNhanHieu, SUM(ctpx.SoLuong) AS TongSoLuong
                 FROM phieuxuat px
                 JOIN ctpx ON px.MaPX = ctpx.MaPX
                 JOIN sanpham sp ON ctpx.MaSP = sp.MaSP
                 JOIN nhanhieu nh ON sp.MaNhanHieu = nh.MaNhanHieu
                 JOIN loaisp l ON sp.MaLoai = l.MaLoai
                 WHERE px.TinhTrangDH = 'Đã hoàn thành' AND l.TenLoai = ?
                 GROUP BY nh.TenNhanHieu;";

$stmt_nhanhieu = $conn->prepare($sql_nhanhieu);
$stmt_nhanhieu->bind_param("s", $loai);
$stmt_nhanhieu->execute();
$result_nhanhieu = $stmt_nhanhieu->get_result();

$data_nhanhieu = array();
if ($result_nhanhieu->num_rows > 0) {
    while ($row = $result_nhanhieu->fetch_assoc()) {
        $data_nhanhieu[] = array(
            'label' => $row['TenNhanHieu'],
            'value' => $row['TongSoLuong']
        );
    }
}
// Truy vấn dữ liệu theo loại sản phẩm
$sql_loaisp = "SELECT loai.TenLoai, SUM(ctpx.SoLuong) AS TongSoLuong
               FROM phieuxuat px
               JOIN ctpx ON px.MaPX = ctpx.MaPX
               JOIN sanpham sp ON ctpx.MaSP = sp.MaSP
               JOIN loaisp loai ON sp.MaLoai = loai.MaLoai
               WHERE px.TinhTrangDH = 'Đã hoàn thành' AND loai.TenLoai = ?
               GROUP BY loai.TenLoai;";
$stmt = $conn->prepare($sql_loaisp);
$stmt->bind_param("s", $loai);
$stmt->execute();
$result_loaisp = $stmt->get_result();
$data_loaisp = array();

if ($result_loaisp->num_rows > 0) {
    while($row = $result_loaisp->fetch_assoc()) {
        $data_loaisp[] = array(
            'label' => $row['TenLoai'],
            'value' => $row['TongSoLuong']
        );
    }
}

// Truy vấn dữ liệu theo nhãn hiệu


// Truy vấn dữ liệu theo sản phẩm
$sql_sanpham = "SELECT sp.TenSP, sp.HinhAnh, nh.TenNhanHieu, l.TenLoai, SUM(ctpx.SoLuong) AS TongSoLuong
                FROM sanpham sp
                JOIN nhanhieu nh ON sp.MaNhanHieu = nh.MaNhanHieu
                JOIN loaisp l ON sp.MaLoai = l.MaLoai
                JOIN ctpx ON ctpx.MaSP = sp.MaSP
                JOIN phieuxuat px ON ctpx.MaPX = px.MaPX
                WHERE l.TenLoai = ? AND px.TinhTrangDH = 'Đã hoàn thành'
                GROUP BY sp.MaSP, sp.TenSP, sp.HinhAnh, nh.TenNhanHieu, l.TenLoai;";

$stmt_sanpham = $conn->prepare($sql_sanpham);
$stmt_sanpham->bind_param("s", $loai);
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

// Truy vấn để lấy tổng số lượng sản phẩm
$sql_tong_so_luong = "SELECT SUM(ctpx.SoLuong) AS TongSoLuong
                      FROM phieuxuat px
                      JOIN ctpx ON px.MaPX = ctpx.MaPX
                      JOIN sanpham sp ON ctpx.MaSP = sp.MaSP
                      JOIN loaisp l ON sp.MaLoai = l.MaLoai
                      WHERE px.TinhTrangDH = 'Đã hoàn thành' AND l.TenLoai = ?";

$stmt_tong_so_luong = $conn->prepare($sql_tong_so_luong);
$stmt_tong_so_luong->bind_param("s", $loai);
$stmt_tong_so_luong->execute();
$result_tong_so_luong = $stmt_tong_so_luong->get_result();

$data_tong_so_luong = array();
if ($result_tong_so_luong->num_rows > 0) {
    while ($row = $result_tong_so_luong->fetch_assoc()) {
        $data_tong_so_luong[] = array(
            'value' => $row['TongSoLuong']
        );
    }
}

// Truy vấn để lấy tổng tiền dựa trên số lượng và giá bán
$sql_tong_tien = "SELECT SUM(ctpx.SoLuong * ctpx.GiaBan) AS TongTien
                  FROM phieuxuat px
                  JOIN ctpx ON px.MaPX = ctpx.MaPX
                  JOIN sanpham sp ON ctpx.MaSP = sp.MaSP
                  JOIN loaisp l ON sp.MaLoai = l.MaLoai
                  WHERE px.TinhTrangDH = 'Đã hoàn thành' AND l.TenLoai = ?";

$stmt_tong_tien = $conn->prepare($sql_tong_tien);
$stmt_tong_tien->bind_param("s", $loai);
$stmt_tong_tien->execute();
$result_tong_tien = $stmt_tong_tien->get_result();

$data_tong_tien = array();
if ($result_tong_tien->num_rows > 0) {
    while($row = $result_tong_tien->fetch_assoc()) {
        $data_tong_tien[] = array(
            'value' => $row['TongTien']
        );
    }
}

$sql_doanh_thu = "SELECT SUM(ctpx.GiaBan * 0.1 * ctpx.SoLuong) AS DoanhThu
                  FROM phieuxuat px
                  JOIN ctpx ON px.MaPX = ctpx.MaPX
                  JOIN sanpham sp ON ctpx.MaSP = sp.MaSP
                  JOIN loaisp l ON sp.MaLoai = l.MaLoai
                  WHERE px.TinhTrangDH = 'Đã hoàn thành' AND l.TenLoai = ?";

$stmt_doanh_thu = $conn->prepare($sql_doanh_thu);
$stmt_doanh_thu->bind_param("s", $loai);
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
