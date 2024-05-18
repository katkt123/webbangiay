<?php
// Xử lý dữ liệu từ form
$tenSP = $_POST['tenSP'];
$giaMoi = $_POST['giaSP'];
$tenNhanHieu = $_POST['tenNhanHieu'];
$tenLoai = $_POST['maLoai'];
$moTa = $_POST['editorContent'];

$Dir_nm = __DIR__;
$targetDir = str_replace("admin\\module\\main", "config\\config.php", $Dir_nm);
require $targetDir;

$uploadOk = 0;
$nameImg = [];

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
	    echo "Xin lỗi, tên tệp đã tồn tại. ";
	    $uploadOk = 0;
	}

	// Cho phép chỉ một số định dạng tệp ảnh
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
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

if ($uploadOk == 1) {
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
	$sql = "INSERT INTO sanpham (TenSP, SoSaoDanhGia, SoLuotDanhGia, MoTa, HinhAnh, SanPhamMoi, SanPhamHot, GiaCu, GiaMoi, SoLuongDaBan, MaNhanHieu, MaLoai, hide) 	VALUES ('$tenSP', 0, 0, '$moTa', '$nameImg[0]', 1, 0, 0, $giaMoi, 0, $maNhanHieu, $maLoai, 1)";

	// Loại bỏ phần tử đầu tiên của mảng $nameImg
	array_shift($nameImg);
	// Thực thi câu truy vấn và kiểm tra kết quả
	if ($connect->query($sql) === TRUE) {
		$MaSP = $connect->insert_id;
		foreach ($nameImg as $img) {
			$sql_hinh = "INSERT INTO `hinhanh`(`SCR_ANH`, `MaSP`) VALUES ('$img','$MaSP')";
			if ($connect->query($sql_hinh) !== TRUE) {
                echo "Lỗi: " . $sql_hinh . "<br>" . $connect->error;
            }
		}
		$sql_size = "SELECT SizeSP FROM `sizesp`"; // Removed `WHERE 1` since it's unnecessary
		$result = $connect->query($sql_size);
		if ($result->num_rows > 0) {
		    while ($row = $result->fetch_assoc()) {
		        // Assuming $MaSP is already defined somewhere in your code
		        $SizeSP = $row['SizeSP']; // Store the value of 'SizeSP' from the row
		        // Now, construct the SQL query for insertion
		        $sql_insert = "INSERT INTO `ctsizesp`(`MaSP`, `SizeSP`, `SoLuong`) VALUES ('$MaSP', '$SizeSP', 0)";
		        // Execute the insertion query
		        $connect->query($sql_insert);
		    }
		}
	    echo "Thêm dữ liệu thành công!!!";
	} else {
		echo "Thêm Không thành công!!!";
	}
}




// if ($uploadOk == 1) {
// 	$tenhinh = $_FILES['hinhanh']["name"];
// 	$sql = "INSERT INTO sanpham (TenSP, SoSaoDanhGia, SoLuotDanhGia, MoTa, HinhAnh, SanPhamMoi, SanPhamHot, GiaCu, GiaMoi, SoLuongDaBan, MaNhanHieu, MaLoai, hide)
// 	VALUES ('$tenSP', 0, 0, '$moTa', '$tenhinh', 1, 0, 0, $giaMoi, 0, $maNhanHieu, $maLoai, 1)";

// 	// Thực thi câu truy vấn và kiểm tra kết quả
// 	if ($connect->query($sql) === TRUE) {
// 	    echo "Thêm dữ liệu thành công!!!";
// 	} else {
// 		echo "Thêm Không thành công!!!";
// 	}
// }

// if ($uploadOk == 0) { // không có ảnh
// 	try {
// 		$tenhinh = $_FILES['hinhanh']["name"];
// 		$sql = "INSERT INTO sanpham (TenSP, SoSaoDanhGia, SoLuotDanhGia, MoTa, HinhAnh, SanPhamMoi, SanPhamHot, GiaCu, GiaMoi, SoLuongDaBan, MaNhanHieu, MaLoai)
// 		VALUES ('$tenSP', 0, 0, '$moTa', 'NULL', 1, 0, 0, $giaMoi, 0, $maNhanHieu, $maLoai)";

// 		// Thực thi câu truy vấn và kiểm tra kết quả
// 		if ($connect->query($sql) === TRUE) {
// 		    echo '<br><strong style="color: lightgreen;">Thêm thành công!!! </strong>';;
// 		}
// 	} catch (Exception $e) {
// 		echo '<br><strong style="color: red;">Thêm Không thành công!!! </strong>';
// 	}
	
// }
?>