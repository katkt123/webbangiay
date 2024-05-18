<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/admin/config/config.php');
    $TenDangNhap= $_POST['TenDangNhap'];
    $MaQuyen= $_POST['MaQuyen'];
    $sql="UPDATE `taikhoan` SET MaQuyen=$MaQuyen WHERE TenDangNhap='$TenDangNhap'";
    $result=mysqli_query($connect,$sql);
    mysqli_close($connect);
?>