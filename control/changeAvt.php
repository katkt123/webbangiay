<?php
session_start(); 
require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/model/DTB.php');

    if(isset($_POST['save-changeAvt'])){
        $tenDangNhap=$_SESSION['taikhoan'];
        $hinhanhpath=basename($_FILES['hinhAnhAvt']['name']);
        $tagret_dir="../assets/img/";
        $tagret_dirAdmin="../admin/assets/img/";
        $tagret_file= $tagret_dir.$hinhanhpath;
        if(move_uploaded_file($_FILES["hinhAnhAvt"]["tmp_name"],$tagret_file)){
            if(copy($tagret_file, $tagret_dirAdmin . $hinhanhpath)) {
                echo 'file đã được sao chép';
            } else {
                echo 'file chưa được sao chép';
            }
            echo 'file đã được update';
            $db = new DTB();
            $query="UPDATE taikhoan
            SET Avt='".$hinhanhpath."'
            WHERE TenDangNhap='".$tenDangNhap."'";
            $result = mysqli_query($db->getConnection(), $query);
        }
        else{
            echo 'file chưa update';
        }
    }
    header("location: ../index.php?danhmuc=profile");
    
?>