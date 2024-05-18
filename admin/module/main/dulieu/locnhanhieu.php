<?php
ob_start();
// Kết nối đến cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shoestore";
$conn = new mysqli($servername, $username, $password, $dbname);

// Lấy nhãn hiệu từ yêu cầu AJAX
$nhan_hieu = $_POST['nhan_hieu']; // Lấy giá trị nhãn hiệu từ form

// Truy vấn dữ liệu theo nhãn hiệu
$sql_nhanhieu = "SELECT nh.TenNhanHieu, SUM(ctpx.SoLuong) AS TongSoLuong
                 FROM phieuxuat px
                 JOIN ctpx ON px.MaPX = ctpx.MaPX
                 JOIN sanpham sp ON ctpx.MaSP = sp.MaSP
                 JOIN nhanhieu nh ON sp.MaNhanHieu = nh.MaNhanHieu
                 WHERE px.TinhTrangDH = 'Đã hoàn thành' AND nh.TenNhanHieu = ?
                 GROUP BY nh.TenNhanHieu";

$stmt = $conn->prepare($sql_nhanhieu);
$stmt->bind_param("s", $nhan_hieu);
$stmt->execute();
$result_nhanhieu = $stmt->get_result();

$data_nhanhieu = array();
if ($result_nhanhieu->num_rows > 0) {
    while($row = $result_nhanhieu->fetch_assoc()) {
        $data_nhanhieu[] = array(
            'label' => $row['TenNhanHieu'],
            'value' => $row['TongSoLuong']
        );
    }
}
    $sql_sanpham = "SELECT sp.TenSP, sp.HinhAnh, nh.TenNhanHieu, l.TenLoai, SUM(ctpx.SoLuong) AS TongSoLuong
    FROM sanpham sp
    JOIN nhanhieu nh ON sp.MaNhanHieu = nh.MaNhanHieu
    JOIN loaisp l ON sp.MaLoai = l.MaLoai
    JOIN ctpx ON ctpx.MaSP = sp.MaSP
    JOIN phieuxuat px ON ctpx.MaPX = px.MaPX
    WHERE nh.TenNhanHieu = ? AND px.TinhTrangDH = 'Đã hoàn thành'
    GROUP BY sp.MaSP, sp.TenSP, sp.HinhAnh, nh.TenNhanHieu, l.TenLoai;";

$stmt_sanpham = $conn->prepare($sql_sanpham);
$stmt_sanpham->bind_param("s", $nhan_hieu);
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


// Truy vấn dữ liệu theo loại sản phẩm
$sql_loaisp = "SELECT l.TenLoai, SUM(ctpx.SoLuong) AS TongSoLuong
               FROM phieuxuat px
               JOIN ctpx ON px.MaPX = ctpx.MaPX
               JOIN sanpham sp ON ctpx.MaSP = sp.MaSP
               JOIN nhanhieu nh ON sp.MaNhanHieu = nh.MaNhanHieu
               JOIN loaisp l ON sp.MaLoai = l.MaLoai
               WHERE px.TinhTrangDH = 'Đã hoàn thành' AND nh.TenNhanHieu = ?
               GROUP BY l.TenLoai;";

$stmt_loaisp = $conn->prepare($sql_loaisp);
$stmt_loaisp->bind_param("s", $nhan_hieu);
$stmt_loaisp->execute();
$result_loaisp = $stmt_loaisp->get_result();

$data_loaisp = array();
if ($result_loaisp->num_rows > 0) {
    while ($row = $result_loaisp->fetch_assoc()) {
        $data_loaisp[] = array(
            'label' => $row['TenLoai'],
            'value' => $row['TongSoLuong']
        );
    }
}

// Truy vấn để lấy tổng số lượng sản phẩm
$sql_tong_so_luong = "SELECT SUM(ctpx.SoLuong) AS TongSoLuong
                      FROM phieuxuat px
                      JOIN ctpx ON px.MaPX = ctpx.MaPX
                      JOIN sanpham sp ON ctpx.MaSP = sp.MaSP
                      JOIN nhanhieu nh ON sp.MaNhanHieu = nh.MaNhanHieu
                      WHERE px.TinhTrangDH = 'Đã hoàn thành' AND nh.TenNhanHieu = ?";

$stmt_tong_so_luong = $conn->prepare($sql_tong_so_luong);
$stmt_tong_so_luong->bind_param("s", $nhan_hieu);
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
                  JOIN nhanhieu nh ON sp.MaNhanHieu = nh.MaNhanHieu
                  WHERE px.TinhTrangDH = 'Đã hoàn thành' AND nh.TenNhanHieu = ?";

$stmt_tong_tien = $conn->prepare($sql_tong_tien);
$stmt_tong_tien->bind_param("s", $nhan_hieu);
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
                  JOIN nhanhieu nh ON sp.MaNhanHieu = nh.MaNhanHieu
                  WHERE px.TinhTrangDH = 'Đã hoàn thành' AND nh.TenNhanHieu = ?";

$stmt_doanh_thu = $conn->prepare($sql_doanh_thu);
$stmt_doanh_thu->bind_param("s", $nhan_hieu);
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