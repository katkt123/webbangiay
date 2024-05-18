<?php 
	
$MaPN = $_POST['productId'];

$Dir_nm = __DIR__;
$targetDir = str_replace("admin\\module\\main", "config\\config.php", $Dir_nm);
require $targetDir;


$sql = "UPDATE phieunhap SET Trangthai = '0' WHERE MaPN = " . $MaPN;

// Thực thi truy vấn
if ($connect->query($sql) === TRUE) {
    echo "Xóa Phiếu nhập thành công!";
} else {
    echo "Lỗi: " . $connect->error;
}

// Đóng kết nối
$connect->close();
 ?>