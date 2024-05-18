<?php
    if (isset($_POST['txtTenQuyen'])) {
        $TenQuyen=$_POST['txtTenQuyen'];
        require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/admin/config/config.php');

        $sql1="SELECT * FROM quyen";
        $result1=mysqli_query($connect,$sql1);
        while ($row=mysqli_fetch_array($result1)) {
            if ($row['TenQuyen']==$TenQuyen) { //Quyền này đã tồn tại trong hệ thống
                header('Location: ../../index.php?danhmuc=quanlyquyen&success=true&note=themquyenfail');
                $temp=1;
            }
        }
        if ($temp!=1) { //Quyền chưa tồn tại (Hợp lệ) 
            if ($TenQuyen=="") { //Để trống
                header('Location: ../../index.php?danhmuc=quanlyquyen&success=true&note=detrongtenquyen');
            }
            else {  //tiến hành thêm quyền mới
                $sql = "INSERT INTO quyen(TenQuyen) VALUES('$TenQuyen')";
                $result= mysqli_query($connect,$sql);
                header('Location: ../../index.php?danhmuc=quanlyquyen&success=true&note=themquyentrue');
            }
            
        }  
        mysqli_close($connect);
    }
    
?>