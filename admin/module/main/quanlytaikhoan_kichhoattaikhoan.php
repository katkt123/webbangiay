<?php
        require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/admin/config/config.php');
        $TenDangNhap=$_GET['id'];
        $sqltest="SELECT TrangThai FROM taikhoan WHERE TenDangNhap='$TenDangNhap'";
        $resulttest=mysqli_query($connect,$sqltest);
        $row=mysqli_fetch_array($resulttest);
        if($row['TrangThai']==1) { //Kiểm tra xem tài khoản này có bị khóa chưa
            $sql="UPDATE taikhoan SET TrangThai=0 WHERE TenDangNhap='$TenDangNhap'";
            $result=mysqli_query($connect,$sql);
            header("Location: ../../index.php?danhmuc=quanlytaikhoan&success=true&note=kichhoattaikhoantrue&TenDangNhap=$TenDangNhap");
        } else {
            header("Location: ../../index.php?danhmuc=quanlytaikhoan&success=true&note=kichhoattaikhoanfalse");
        }
        mysqli_close($connect);
?>