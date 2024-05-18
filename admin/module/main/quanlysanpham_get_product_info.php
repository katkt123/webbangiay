<?php
$productId = $_POST['productId'];

// Thực hiện truy vấn để lấy danh sách các size và số lượng tương ứng của sản phẩm
$dir =  __DIR__;
$targetDir = str_replace("admin\\module\\main", "config\\config.php", $dir);
require $targetDir;

$html = '';
$sql = "SELECT * FROM `sanpham` WHERE MaSP = " . $productId;
$result = $connect->query($sql);
if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
    $html .= '<tr><td>Mã sản phẩm:</td><td>' . $row["MaSP"] . '</td></tr>';
    $html .= '<tr><td>Tên sản phẩm:</td><td>' . $row["TenSP"] . '</td></tr>';
    $html .= '<tr><td>Số sao đánh giá:</td><td>' . $row["SoSaoDanhGia"] . '</td></tr>';
    $html .= '<tr><td>Số lượt đánh giá:</td><td>' . $row["SoLuotDanhGia"] . '</td></tr>';
    $html .= '<tr><td>Mô tả sản phẩm:</td><td>' . $row["MoTa"] . '</td></tr>';
    $html .= '<tr><td>File hình ảnh:</td><td>' . $row["HinhAnh"] . '</td></tr>';
    $html .= '<tr><td>Sản phẩm mới:</td><td>' . $row["SanPhamMoi"] . '</td></tr>';
    $html .= '<tr><td>Sản phẩm HOT:</td><td>' . $row["SanPhamHot"] . '</td></tr>';
    $html .= '<tr><td>Giá cũ:</td><td>' . $row["GiaCu"] . '</td></tr>';
    $html .= '<tr><td>Giá mới:</td><td>' . $row["GiaMoi"] . '</td></tr>';

    $sql = "SELECT TenNhanHieu FROM `nhanhieu` WHERE MaNhanHieu = " . $row["MaNhanHieu"];
    // Thực thi truy vấn
    $resultML = $connect->query($sql);
    $tennh = 'koco';
    if ($resultML->num_rows > 0) {
        $rowd = $resultML->fetch_assoc();
        $tennh = $rowd["TenNhanHieu"];
    }
    $html .= '<tr><td>Mã nhãn hiệu:</td><td>' . $row["MaNhanHieu"] . ' (' .$tennh.')</td></tr>';

    $sql = "SELECT * FROM `loaisp` WHERE MaLoai = " . $row["MaLoai"];
    // Thực thi truy vấn
    $resultML = $connect->query($sql);
    $tenloai = 'koco';
    if ($resultML->num_rows > 0) {
        $rowd = $resultML->fetch_assoc();
        $tenloai = $rowd["TenLoai"];
    }
    $html .= '<tr><td>Mã loại:</td><td>' . $row["MaLoai"] . ' (' . $tenloai . ')</td></tr>';
    $html .= '<tr><td>Số lượng đã bán:</td><td>' . $row["SoLuongDaBan"] . '</td></tr>';
}


echo $html;
?>