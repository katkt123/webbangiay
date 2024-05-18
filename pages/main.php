<?php
    if(isset($_GET["danhmuc"])){
        switch ($_GET["danhmuc"]) {
            case 'about':
                include_once 'pages/main/about.php';
                break;
            case 'products':
                include_once 'pages/main/products.php';
                break;
            case 'tiktokfeed':
                include_once 'pages/main/tiktokfeed.php';
                break;
            case 'blog':
                include_once 'pages/main/blog.php';
                break;
            case 'shell':
                include_once 'pages/main/shell.php';
                break;
            case 'checkout':
                include_once 'pages/main/checkout.php';
                break;   
            case 'product-detail':
                include_once 'pages/main/product-detail.php';
                break;
            case 'profile':
                include_once 'pages/main/profile.php';
                break; 
            case 'paysucess':
                include_once 'pages/main/paysucess.php';
                break; 
            case 'listwish':
                include_once 'pages/main/listwish.php';
                break; 
            default:
                include_once 'pages/main/home.php';
                break; 
        }
    }
    else{
        include_once 'pages/main/home.php';
    }
?>

