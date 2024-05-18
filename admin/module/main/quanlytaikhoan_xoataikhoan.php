<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/admin/config/config.php');
    $TenDangNhap=$_GET['id']; 
    $sql1="DELETE FROM user WHERE TenDangNhap='$TenDangNhap' "; //xóa user 
    $result1=mysqli_query($connect,$sql1);
    $sql2="DELETE FROM taikhoan WHERE TenDangNhap='$TenDangNhap' "; //xóa tài khoản 
    $result2=mysqli_query($connect,$sql2);
    header("Location: ../../index.php?danhmuc=quanlytaikhoan&TenDangNhap=$TenDangNhap&success=true&note=xoataikhoantrue");
    mysqli_close($connect);

?>