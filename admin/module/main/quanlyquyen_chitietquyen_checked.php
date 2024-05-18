<?php
    $MaQuyen=$_POST['MaQuyen'];
    $MaCN=$_POST['MaCN'];
    $HanhDong=$_POST['HanhDong'];
    require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/admin/config/config.php');

    $sql="SELECT * FROM `chitietquyenchucnang` WHERE MaQuyen=$MaQuyen and MaCN=$MaCN and HanhDong='$HanhDong' ";
    $result=mysqli_query($connect,$sql);
    if ( $row=mysqli_num_rows($result)==1 ) {
        $row=mysqli_fetch_array($result);
        if ($row['TrangThai']==0) {
            $sql1="UPDATE `chitietquyenchucnang` SET `TrangThai`=1 WHERE MaQuyen=$MaQuyen and MaCN=$MaCN and HanhDong='$HanhDong' ";
            $result1=mysqli_query($connect,$sql1);
        }
        else {
            $sql1="UPDATE `chitietquyenchucnang` SET `TrangThai`=0 WHERE MaQuyen=$MaQuyen and MaCN=$MaCN and HanhDong='$HanhDong' ";
        $result1=mysqli_query($connect,$sql1);
        }
    }
    else {
        $sql2="INSERT INTO `chitietquyenchucnang`(`MaQuyen`, `MaCN`, `HanhDong`, `TrangThai`) 
                                        VALUES ($MaQuyen,$MaCN,'$HanhDong',1)";
        $result2=mysqli_query($connect,$sql2);
    }
    mysqli_close($connect);
?>