<?php
    $TenQuyen=$_POST['txtTenQuyenCanSua'];
    $MaQuyen=$_GET['id'];
    require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/admin/config/config.php');
    $sqltest="SELECT * FROM quyen";
    $result1=mysqli_query($connect,$sqltest);
    $flag=1;
    while ($row=mysqli_fetch_array($result1)) {
        if ($row['TenQuyen']==$TenQuyen) { //Kiểm tra xem tên quyền chỉnh sửa có trùng với tên quyền nào trong hệ thống hay không
            $flag=0;
        }
    }
    if ($flag==0) { //Quyền này đẫ tồn tại trong hệ thống
        header('Location: ../../index.php?danhmuc=quanlyquyen&success=true&note=suaquyenfalse');
    }
    else { //Hợp lệ 
        if ($TenQuyen=="") { //Để trống tên quyền
            header('Location: ../../index.php?danhmuc=quanlyquyen&success=true&note=detrongtenquyen');
        }
        else {  //-> tiến hành sửa tên quyền
        $sql= "UPDATE quyen SET MaQuyen=$MaQuyen,TenQuyen='$TenQuyen' WHERE MaQuyen=$MaQuyen";
        $result=mysqli_query($connect,$sql);  
        header('Location: ../../index.php?danhmuc=quanlyquyen&success=true&note=suaquyentrue');
        }
    }
    mysqli_close($connect);
?>      