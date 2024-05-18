<?php 
    session_start();
    require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/control/taikhoan-act.php');
    //Nếu chưa đăng nhập vào thì chuyển đến trang đăng nhập
    if(!isset($_SESSION['taikhoan'])){
        header('Location: ../login.php');
    }
    //Nếu đang đăng nhập với tài khoản khách hàng thì không cho vào trang admin và chuyển về trang cửa hàng
    if(getTenNhomQuyen($_SESSION['taikhoan'])=="Khách hàng"){
        header('Location: ../index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiêu đề ở đây</title>

    
    <!-- Table template -->
    <script defer src="./js/jquery.js"></script>
    <script defer src="./js/bootstrap.bundle.min.js"></script>
    <script defer src="./js/dataTables.js"></script>
    <script defer src="./js/dataTables.boostrap5.js"></script>
    <script defer src="./js/table.js"></script>
        
    

    <!-- reset css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css"> 
    <!-- icon -->
    <link rel="stylesheet" href="./assets/fonts/fontawesome-free-6.4.0-web/fontawesome-free-6.4.0-web/css/all.min.css"> 
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;1,100;1,300&display=swap" rel="stylesheet">
    <!-- slick -->
    <!-- <link
    rel="stylesheet"
    type="text/css"
    href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"
    /> -->

    <!-- Bootstrap -->



    <link rel="stylesheet" href="./assets/css/bootstrap.css" />
    <link rel="stylesheet" href="./assets/css/bootstrapTable.css" />
    
    
    <!-- <link rel="stylesheet" href="./assets/css/base.css"> -->
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/css/reponsive.css">


    <!-- font pro -->    
    <!-- <link rel="stylesheet" href="./assets/fonts/fontawesome.com/releases/v6.4.0/css/all.css">
    <link rel="stylesheet" href="./assets/fonts/fontawesome.com/releases/v6.4.0/css/sharp-light.css">
    <link rel="stylesheet" href="./assets/fonts/fontawesome.com/releases/v6.4.0/css/sharp-regular.css">
    <link rel="stylesheet" href="./assets/fonts/fontawesome.com/releases/v6.4.0/css/sharp-solid.css"> -->

</head>
<body>
<div class="app">
            <!-- Menu -->
            <div class="container-1">
                <?php require_once 'module/menu.php';?>
                
            </div>
            <div class="container-2">
                <?php require_once 'module/header.php';?>
                <?php require_once 'module/main.php';?>     
            </div>
        </div>
</body>
</html>