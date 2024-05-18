<?php

	$userId   = $_POST['username'];
	$password = $_POST['password'];
	include("../config/config.php");
	//Kiểm tra xem tài khoản có tồn tại hay không
	$SqlCheckUser = "SELECT TenDangNhap,MatKhau,TrangThai
					FROM taikhoan
					WHERE TenDangNhap = '$userId'";
	$resultCheck = mysqli_query($connect, $SqlCheckUser) or die('Query failed. ' . mysqli_error($connect)); 

	//Kiểm tra xem tên đăng nhập và mật khẩu có nhập đúng hay không
	$sql = "SELECT TenDangNhap,MatKhau,TrangThai
					FROM taikhoan
					WHERE TenDangNhap = '$userId' AND MatKhau = '$password' ";
	$result = mysqli_query($connect, $sql) or die('Query failed. ' . mysqli_error($connect)); 
	$row=mysqli_fetch_array($result);

	if (empty($userId) && empty($password)) {
		echo 'Để trống tên đăng nhập và mật khẩu';
	}
	else if(empty($userId)){
		echo 'Để trống tên đăng nhập';
	}
	else if(empty($password)){
		echo 'Để trống mật khẩu';
	}
	else if( mysqli_num_rows($resultCheck)!=1 ){
		echo 'Tên đăng nhập không tồn tại';
	}
	else if( mysqli_num_rows($resultCheck)==1 && mysqli_num_rows($result)!=1){
		echo 'Sai mật khẩu';
	}
	else if($row['TrangThai']==1){
		echo 'Tài khoản bị khóa';
	}
	else {
		// Đăng nhập thành công
		session_start();
		$_SESSION['taikhoan'] = $userId;
		echo "success";
	}


	mysqli_close($connect);
?>