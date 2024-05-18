<div class="content">
    <?php
        if(isset($_GET['danhmuc'])){
            switch ($_GET['danhmuc']) {
                case 'dashboard':
                    require_once 'module/main/dashboard.php';
                    break;
                case 'thongkekinhdoanh':
                    require_once 'module/main/thongkekinhdoanh.php';
                    break;
                case 'quanlysanpham':
                    require_once 'module/main/quanlysanpham.php';
                    break;
                case 'quanlydanhgia':
                    require_once 'module/main/quanlydanhgia.php';
                    break;
                case 'quanlydonhang':
                    require_once 'module/main/quanlydonhang.php';
                    break;
                case 'quanlynhaphang':
                    require_once 'module/main/quanlynhaphang.php';
                    break;
                case 'quanlyquyen':
                    require_once 'module/main/quanlyquyen.php';
                    break;
                case 'quanlyquyen_chitietquyen':
                    require_once 'module/main/quanlyquyen_chitietquyen.php';
                    break;
                case 'quanlytaikhoan':
                    require_once 'module/main/quanlytaikhoan.php';
                    break;
                case 'caidatwebsite':
                    require_once 'module/main/caidatwebsite.php';
                    break;   
                case 'quanlydonhang-chitiet':                     
                    require_once 'module/main/quanlydonhang-chitiet.php';             
                    break;  
                case 'quanlydonhang-timkiem':                     
                    require_once 'module/main/quanlydonhang-timkiem.php';             
                    break; 
                case 'thongtintaikhoan':                     
                    require_once 'module/main/thongtintaikhoan.php';             
                    break;   
                case 'chitietphieunhap':                     
                    require_once 'module/main/quanlynhaphang_view_chi_tiet_phieu.php';
                    break;
                case 'caidat':   
                    if(isset($_GET['id'])){
                        if($_GET['id']=='size'){
                            require_once 'module/main/caidat/size.php';
                        }
                        else if($_GET['id']=='nhacungcap'){
                            require_once 'module/main/caidat/nhacungcap.php';
                        }
                        else if($_GET['id']=='nhanhieu'){
                            require_once 'module/main/caidat/nhanhieu.php';
                        }
                        else if($_GET['id']=='danhmuc'){
                            require_once 'module/main/caidat/danhmuc.php';
                        }   
                    }
                    else {
                        require_once 'module/main/caidat/size.php';
                    }    
                    break;
                case 'themsanpham':                     
                    require_once 'module/main/quanlysanpham_add_product_input.php';
                    break;
                case 'suasanpham':                     
                    require_once 'module/main/quanlysanpham_fix_product_input.php';
                    break;
                case 'themphieunhap':                     
                    require_once 'module/main/quanlynhaphang_them_phieu_nhap.php';
                    break;
                default:
                    require_once 'module/main/dashboard.php';
                    break;
            }
        }
        else{
            require_once 'module/main/quanlysanpham.php';
        }

    ?>
</div>