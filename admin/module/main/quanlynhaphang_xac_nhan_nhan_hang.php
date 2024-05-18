<?php
$dir =  __DIR__;
$targetDir = str_replace("admin\\module\\main", "config\\config.php", $dir);
require $targetDir;

$MaPN = $_REQUEST['maPhieuNhap']; 

$sql = "UPDATE phieunhap SET TinhTrangDH = 'Đã nhận' WHERE MaPN = $MaPN";

if ($connect->query($sql) === TRUE) {
	$sql_ct = "SELECT `MaPN`, `MaSP`, `SoLuong`, `GiaNhap`, `SizeSP` FROM `ctpn` WHERE MaPN = " . $MaPN;
	$result = $connect->query($sql_ct);
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$gia_moi = $row["GiaNhap"] * 1.1; // Tính giá mới là giá nhập nhân với 10% (hoặc 1.1)
			$sql_sua_gia = "UPDATE sanpham SET GiaCu = GiaMoi, GiaMoi = " . $gia_moi . " WHERE MaSP = " . $row["MaSP"];
			if ($connect->query($sql_sua_gia) !== TRUE) {
		        echo "Lỗi: " . $sql_sua_gia . "<br>" . $connect->error;
		    }
		    $sql_sua_ctsize = "UPDATE `ctsizesp` SET `SoLuong`= SoLuong + " . $row["SoLuong"] . " WHERE MaSP = " . $row["MaSP"] . " and SizeSP = " . $row["SizeSP"];
		    if ($connect->query($sql_sua_ctsize) !== TRUE) {
		        echo "Lỗi: " . $sql_sua_ctsize . "<br>" . $connect->error;
		    }
		}
	}
	// 
    echo "Cập nhật trạng thái đơn hàng thành công";
} else {
    echo "Lỗi khi cập nhật trạng thái đơn hàng: " . $connect->error;
}

$connect->close();
?>
