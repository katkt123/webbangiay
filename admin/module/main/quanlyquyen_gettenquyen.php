<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/admin/config/config.php');
    $MaQuyen=$_GET['id'];
    $TenQuyen=$_GET['ten'];
    header("Location: ../../index.php?danhmuc=quanlyquyen&MaQuyen=$MaQuyen&TenQuyen=$TenQuyen&Getsuccess=true");
    mysqli_close($connect);

?>