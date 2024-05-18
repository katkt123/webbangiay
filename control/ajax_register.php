<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/control/taikhoan-act.php');
    $tenDangNhap= $_POST['tenDangNhap'];
    $hoTen= $_POST['hoTen'];
    $sdt=$_POST['sdt'];
    $email=$_POST['email'];
    $day=strtotime($_POST['day']);
    $mk=$_POST['mk'];
    $mk02=$_POST['mk02'];
    $diachi= $_POST['diachi'];
    $gioitinh= intval($_POST['gioitinh']);
    $ngaysinh=$_POST['day'];
    if ( empty($tenDangNhap) || empty($hoTen) || empty($sdt) || empty($email) || empty($mk) || empty($mk02) || empty($diachi) ){
        echo 'botrongthongtin';
    }
    else if ( $gioitinh=="") {
        echo 'khongchongioitinh';
    }
    else if (empty($day)) {
        echo 'khongchonngaysinh';
    }
    else if(tenDangNhapTonTai($tenDangNhap)==1){
        echo 'tendangnhapdatontai';
    }
    else if(isValidUsername($tenDangNhap)==false){
        echo 'tendangnhapkhongdung';
    }
    else if( checkHoTen($hoTen) == 0 ){
        echo 'saihoten';
    }
    else if( checkSDT($sdt) ==0){
        echo 'saisdt';
    }
    else if (checkSDTtontai($sdt)==0){
        echo 'sdtdatontai';
    }
    else if (checkEmail($email) ==0){
        echo 'saiemail';
    }
    else if( checkngaysinh($day)==0){
        echo 'saingaysinh';
    }
    else if( checkmk($mk)==0){
        echo 'saimk';
    }
    else if( checkmk02($mk02,$mk)==0){
        echo 'saimk02';
    }
    else{
        dangki($tenDangNhap,$hoTen,$sdt,$email,$ngaysinh,$mk02,$diachi,$gioitinh);
        echo 0;
    }
?>