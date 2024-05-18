<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/admin/config/config.php');
    $TenDangNhap=$_GET['id'];  
    header("Location: ../../index.php?danhmuc=quanlytaikhoan&TenDangNhap=$TenDangNhap&Getsuccess=true");
?>