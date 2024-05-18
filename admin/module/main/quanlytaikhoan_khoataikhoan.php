<?php
        require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/admin/config/config.php');
        $TenDangNhaphientai=$_GET['id2'];
        $TenDangNhap=$_GET['id'];
        $sqltest="SELECT TrangThai FROM taikhoan WHERE TenDangNhap='$TenDangNhap'";
        $resulttest=mysqli_query($connect,$sqltest);
        $row=mysqli_fetch_array($resulttest);
        if($row['TrangThai']==0) { //Kiểm tra xem tài khoản này có bị khóa chưa
            //Kiểm tra xem tài khoản muốn khóa có phải là tài khoản đang đăng nhập hay không
            if ($TenDangNhaphientai == $TenDangNhap){
                header("Location: ../../index.php?danhmuc=quanlytaikhoan&success=true&note=khoataikhoanfalse2");
            }
            else {
                $sql="UPDATE taikhoan SET TrangThai=1 WHERE TenDangNhap='$TenDangNhap'";
                $result=mysqli_query($connect,$sql);
                header("Location: ../../index.php?danhmuc=quanlytaikhoan&success=true&note=khoataikhoantrue&TenDangNhap=$TenDangNhap");
                
            }
        } else { //nếu đã bị khóa rồi
            header("Location: ../../index.php?danhmuc=quanlytaikhoan&success=true&note=khoataikhoanfalse");
        }
        mysqli_close($connect);
?>