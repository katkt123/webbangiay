<?php
$Dir_nm = __DIR__;
$targetDir = str_replace("admin\\module\\main", "config\\config.php", $Dir_nm);
require $targetDir;
// Lấy mã sản phẩm từ yêu cầu POST
$productCode = $_POST['productCode'];

// Chuẩn bị truy vấn SQL
$sql = "SELECT TenSP, hide FROM sanpham WHERE MaSP = '$productCode'";
$result = $connect->query($sql);

// Kiểm tra kết quả truy vấn
if ($result->num_rows > 0) {
    // Sản phẩm tồn tại, kiểm tra giá trị hide
    $row = $result->fetch_assoc();
    if ($row['hide'] == 1) {
        echo "ton_tai";
    } else {
        echo "khong_ton_tai";
    }
} else {
    // Sản phẩm không tồn tại
    echo "khong_ton_tai";
}

$connect->close();
?>
