<?php 
    $MaQuyen = $_GET['id'];
    require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/admin/config/config.php');
    $sqltest="SELECT * FROM taikhoan tk join quyen q on tk.MaQuyen=q.MaQuyen WHERE q.MaQuyen=$MaQuyen";
    $result1=mysqli_query($connect,$sqltest);
    if (mysqli_num_rows($result1)==0) { //quyền này chưa có tài khoản nào sử dụng ->tiến hành xóa
        $sql = "DELETE FROM `chitietquyenchucnang` WHERE MaQuyen=$MaQuyen";
        $result= mysqli_query($connect,$sql);
        $sql = "DELETE FROM quyen Where MaQuyen = $MaQuyen";
        $result= mysqli_query($connect,$sql);
        header('Location: ../../index.php?danhmuc=quanlyquyen&success=true&note=xoaquyentrue');
    }
    else {
        header('Location: ../../index.php?danhmuc=quanlyquyen&success=true&note=xoaquyenfalse');
    }
    mysqli_close($connect);
?>