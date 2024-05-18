<?php

// Bat dau session (quan trong)
session_start();

//Neu nguoi dung da dang nhap thanh cong, thi huy bien session
if (isset($_SESSION['taikhoan'])) 
{
	unset($_SESSION['taikhoan']);
}

//Da dang xuat, quay tro lai trang login.php
header('Location: index.php');
?>
