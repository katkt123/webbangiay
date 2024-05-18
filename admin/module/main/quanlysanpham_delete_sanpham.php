<?php
// Kết nối CSDL
$dir =  __DIR__;
$targetDir = str_replace("admin\\module\\main", "config\\config.php", $dir);
$targetDirImg = str_replace("admin\\module\\main", "assets\\img\\", $dir);
require $targetDir;

// Lấy giá trị của id sản phẩm từ POST request
$idSanPham = $_POST['idSanPham'];

try {
	// $sql = "SELECT HinhAnh FROM `sanpham` WHERE MaSP = ?";
	// if ($stmt = $connect->prepare($sql)) {
	//     $stmt->bind_param("s", $idSanPham); // "s" đại diện cho kiểu dữ liệu string
	//     $stmt->execute();
	//     $stmt->bind_result($tenhinh);
	//     $stmt->fetch();
	//     $stmt->close();
	// }
	// $file_path = $targetDirImg . '/' . $tenhinh;
	// // Kiểm tra xem tập tin tồn tại không trước khi xóa
	// if (file_exists($file_path)) {
	//     unlink($file_path);
	// }

	// Thực hiện câu lệnh SQL DELETE
	$sql = "UPDATE sanpham SET hide = 0 WHERE MaSP = ?";
	$stmt = $connect->prepare($sql);
	$stmt->bind_param("i", $idSanPham);
	$stmt->execute();
	// Đóng kết nối CSDL
	$stmt->close();
    echo '<strong style="color = green;">Xóa sản phẩm thành công!</strong>';

} catch (Exception $ex) {
	echo '<strong style="color = red;">Xóa KHÔNG thành công!</strong>';
}


$connect->close();
?>
