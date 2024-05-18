<?php
// Xử lý dữ liệu từ form
$maSP = $_POST['MaSP']; 
$tenSP = $_POST['tenSP'];
$moTa = $_POST['editorContent'];
$SoSaoDanhGia = $_POST['SoSaoDanhGia'];
$SoLuotDanhGia = $_POST['SoLuotDanhGia'];
$SoLuongDaBan = $_POST['SoLuongDaBan'];
$GiaCu = $_POST['giacu'];
$giaMoi = $_POST['giamoi'];
$tenNhanHieu = $_POST['tenNhanHieu'];
$tenLoai = $_POST['tenLoai'];
$SanPhamMoi = $_POST['SanPhamMoi'];
$SanPhamHot = $_POST['SanPhamHot'];

$Dir_nm = __DIR__;
$targetDir = str_replace("admin\\module\\main", "config\\config.php", $Dir_nm);
require $targetDir;

echo count($_FILES['hinhanh']['name']) . ' ';

$newAva = 0;
$newhinh = 0;

if (count($_FILES['hinhanh']['name']) <= 1) {
	if ($_FILES['hinhanh']['size'][0] > 0) {
		$sql = "SELECT HinhAnh FROM `sanpham` WHERE MaSP = ?";
		if ($stmt = $connect->prepare($sql)) {
		    $stmt->bind_param("s", $maSP); // "s" đại diện cho kiểu dữ liệu string
		    $stmt->execute();
		    $stmt->bind_result($tenhinh);
		    $stmt->fetch();
		    $stmt->close();
		}
		$file_path = str_replace("admin\\module\\main", "assets\\img\\", $Dir_nm) . '/' . $tenhinh;
		if (file_exists($file_path)) {
		    unlink($file_path);
		    $newAva = 1;
		}
	}
} else {	
	if ($_FILES['hinhanh']['size'][0] > 0) {
		$sql = "SELECT HinhAnh FROM `sanpham` WHERE MaSP = ?";
		if ($stmt = $connect->prepare($sql)) {
		    $stmt->bind_param("s", $maSP); // "s" đại diện cho kiểu dữ liệu string
		    $stmt->execute();
		    $stmt->bind_result($tenhinh);
		    $stmt->fetch();
		    $stmt->close();
		}
		$file_path = str_replace("admin\\module\\main", "assets\\img\\", $Dir_nm) . '/' . $tenhinh;
		if (file_exists($file_path)) {
		    unlink($file_path);
		    $newAva = 1;
		}
	}
	$sql = "SELECT SCR_ANH FROM `hinhanh` WHERE MaSP = " . $maSP;
	$result = $connect->query($sql);
	if ($result->num_rows > 0) {
	    while ($row = $result->fetch_assoc()) {
	    	$file_path = str_replace("admin\\module\\main", "assets\\img\\", $Dir_nm) . '/' . $row['SCR_ANH'];
			// Kiểm tra xem tập tin tồn tại không trước khi xóa
			if (file_exists($file_path)) {
			    unlink($file_path);
			}
	    }
	}
	$newhinh = 1;
}



// $nameImg = [];

foreach ($_FILES['hinhanh']['tmp_name'] as $key => $tmp_name) {
	$file_name = $_FILES['hinhanh']['name'][$key];
    $file_tmp = $_FILES['hinhanh']['tmp_name'][$key];
    $file_type = $_FILES['hinhanh']['type'][$key];
    $file_size = $_FILES['hinhanh']['size'][$key];

	$targetDir = str_replace("admin\\module\\main", "assets\\img\\", $Dir_nm);
	$target_file = $targetDir . basename($file_name);
	// echo $target_file;
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	// Kiểm tra nếu tệp đã tồn tại
	if (file_exists($target_file)) {
		$filename_parts = pathinfo($target_file);
	    $filename = $filename_parts['filename'];
	    $extension = $filename_parts['extension'];
	    $counter = 1;
	    while (file_exists($targetDir . $filename . "_" . $counter . "." . $extension)) {
	        $counter++;
	    }
	    $target_file = $targetDir . $filename . "_" . $counter . "." . $extension;
	}
	// Cho phép chỉ một số định dạng tệp ảnh
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		if ($file_size > 0)
	    	echo "Xin lỗi, chỉ cho phép tải lên các tệp JPG, JPEG, PNG & GIF. ";
	    $uploadOk = 0;
	}
	// Kiểm tra $uploadOk có bị lỗi nào không
	if ($uploadOk == 1) {
	    if (move_uploaded_file($file_tmp, $target_file)) {
	        $nameImg[] = $file_name;
	    } else {
	        echo "Xảy ra lỗi khi tải lên tệp. ";
	        $uploadOk = 0;
	    }
	}
}

$sql = "SELECT MaNhanHieu FROM nhanhieu WHERE TenNhanHieu = ?";
// Chuẩn bị và thực thi câu truy vấn sử dụng prepared statement
if ($stmt = $connect->prepare($sql)) {
    $stmt->bind_param("s", $tenNhanHieu); // "s" đại diện cho kiểu dữ liệu string
    $stmt->execute();
    $stmt->bind_result($maNhanHieu);
    $stmt->fetch();
    $stmt->close();
}
$sql = "SELECT MaLoai FROM loaisp WHERE TenLoai = ?";
// Chuẩn bị và thực thi câu truy vấn sử dụng prepared statement
if ($stmt = $connect->prepare($sql)) {
    $stmt->bind_param("s", $tenLoai); // "s" đại diện cho kiểu dữ liệu string
    $stmt->execute();
    $stmt->bind_result($maLoai);
    $stmt->fetch();
    $stmt->close();
}

if ($newAva == 1) {
	$tenhinh = $nameImg[0];
} else {
	$spl = 'SELECT HinhAnh FROM `sanpham` WHERE MaSP = ?';
	// Chuẩn bị và thực thi câu truy vấn sử dụng prepared statement
	if ($stmt = $connect->prepare($spl)) {
	    $stmt->bind_param("s", $maSP); // "s" đại diện cho kiểu dữ liệu string
	    $stmt->execute();
	    $stmt->bind_result($tenhinh);
	    $stmt->fetch();
	    $stmt->close();
	}
} 

$sph = $SanPhamHot == 'true' ? 1:0;
$spm = $SanPhamMoi == 'true' ? 1:0;
$sql = "UPDATE sanpham SET TenSP = '$tenSP', SanPhamMoi = $spm, SanPhamHot = $sph, SoSaoDanhGia = $SoSaoDanhGia, SoLuotDanhGia = $SoLuotDanhGia, MoTa = '$moTa', 
SoLuongDaBan = $SoLuongDaBan,HinhAnh = '$tenhinh',GiaCu = $GiaCu, GiaMoi = $giaMoi, MaNhanHieu = $maNhanHieu, MaLoai = $maLoai WHERE MaSP = $maSP";
if ($connect->query($sql) === TRUE){
	if ($newhinh == 1) {
		$sql_del = 'DELETE FROM `hinhanh` WHERE MaSP = ' . $maSP;
		$connect->query($sql_del);
		if ($newAva == 1)
			array_shift($nameImg);
		foreach ($nameImg as $img) {
			$sql_hinh = "INSERT INTO `hinhanh`(`SCR_ANH`, `MaSP`) VALUES ('$img','$maSP')";
			if ($connect->query($sql_hinh) !== TRUE) {
	            echo "Lỗi: " . $sql_hinh . "<br>" . $connect->error;
	        }
		}
	}
	echo "Cập Nhật Thành Công!";
} else {
	echo "Cập Nhật Không Thành Công!";
}



?>