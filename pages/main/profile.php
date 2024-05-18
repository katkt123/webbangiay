
<script>
    <?php if(!isset($_SESSION['taikhoan'])){ ?>
        var url =
                `index.php?danhmuc=home`;
            window.location.href = url;
    <?php } ?>
</script>
<?php
    //dtb taikhoan nhanvien khachhang
    require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/control/taikhoan-act.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/control/taikhoan-act.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/control/user-act.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/webbangiay/model/user.php');
    $tenDangNhap=$_SESSION["taikhoan"];
    $Ma=getUser($tenDangNhap)->getMa();
    $hoTen=getUser($tenDangNhap)->getHoTen();
    $ngaySinh=getUser($tenDangNhap)->getNgaySinh();
    $sdt=getUser($tenDangNhap)->getSDT();
    $email=getUser($tenDangNhap)->getEmail();
    $diaChi=getUser($tenDangNhap)->getDiaChi();
    $gioiTinh=getUser($tenDangNhap)->getGioiTinh();
    $matKhau=getTaiKhoan($tenDangNhap)->getMatKhau();
    $avt=getTaiKhoan($tenDangNhap)->getAvt();
?>
<style>
    /* Style cho popup */
    .popup {
        
        display: none;
        position: fixed;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        padding: 20px;
        width: 400px;
        height: 400px;
        z-index: 9999;
    }
    /* Style cho overlay */
    .overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9998;
    }
</style>
<main id="profile-main" class="">
<section class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-main">
                <a  href="index.php?danhmuc=home" style="color: #807e7e;">
                    Home
                </a>
                <i class="breadcrumb-icon fa-solid fa-chevron-right"></i>
                <a href="index.php?danhmuc=profile" style="color: #807e7e;">
                    Profile
                </a>
            </div>
        </div>
    </section>
<!-- <link rel="stylesheet" href="./assets/css/bootstrap.css" /> -->
<div class="my-account mb" style="margin-top: 20px;">
    <div class="container" role="main">
        <div class="row my-account-flex">
            <div class="col-lg-3 profile-menu">
                <div class="profile-user">  
                    <div class="profile-user-img" id="popupBtn">
                        <img class="profile-user-image" alt="" src="./assets/img/<?php echo $avt?>">		
                    </div>
                    <div class="profile-info">
                        <div class="profile-user-name">
                            <?php
                                echo $hoTen;
                            ?>
                        </div>                    
                        
                        <div class="profile-user-id">
                            #
                            <?php
                                echo $Ma;
                            ?>
                        </div>
                    </div>

                </div>
                <ul class="profile-user-menu">
                 <li class="profile-user-item">
                        <a href="index.php?danhmuc=profile&profile=taikhoan">TÀI KHOẢN</a>
                    </li>
                    <li class="profile-user-item">
                        <a href="index.php?danhmuc=profile&profile=donhang">ĐƠN HÀNG</a>
                    </li>
                    <li class="profile-user-item">
                    <a href="logout.php" style="color: rgba(255, 0, 0, 0.792);">ĐĂNG XUẤT</a>
                    </li>
                    
                </ul>
            </div>
            <div class="col-lg-9 profile-main">
                <?php
                    if(isset($_GET["profile"])){
                        switch ($_GET["profile"]) {
                            case 'donhang':
                                include_once 'pages/main/profile/donhang.php';
                                break;
                            case 'taikhoan':
                                include_once 'pages/main/profile/taikhoan.php';
                                break;
                            case 'dangxuat':
                                include_once 'pages/main/profile/dangxuat.php';
                                break;
                            case 'donhang-chitiet':
                                include_once 'pages/main/profile/donhang-chitiet.php';
                                break;
                            default:
                                include_once 'pages/main/profile/taikhoan.php';
                                break;
                        }
                    }
                    else{
                        include_once 'pages/main/profile/taikhoan.php';
                    }
                
                ?>
            </div>
        </div>


    </div>
</div>
<div class="overlay" id="overlay"></div>

<div class="popup" id="popup">
    <h2>Popup Content</h2>
    <p>This is a popup window.</p>
    <div class="change-avt" id="popupBtn">
        <img alt="" src="./assets/img/<?php echo $avt?>">		
    </div>

    <div class="btn-popup-change-avt">
        <form action="./control/changeAvt.php" method="post" enctype="multipart/form-data">
            <input type="file" name="hinhAnhAvt">
            <button id="closeBtn">Thoát</button>
            <input type="submit" name="save-changeAvt" id="saveBtn">
        </form>
    </div>  
</div>
</main>
<script>
    // Lấy các phần tử DOM
    const popupBtn = document.getElementById('popupBtn');
    const overlay = document.getElementById('overlay');
    const popup = document.getElementById('popup');
    const closeBtn = document.getElementById('closeBtn');
    var image = document.querySelector('.profile-user-image');

    // Hiển thị popup khi nhấp vào nút
    popupBtn.addEventListener('click', function() {
        overlay.style.display = 'block';
        popup.style.display = 'block';
    });

    // Ẩn popup khi nhấp vào nút đóng hoặc overlay
    closeBtn.addEventListener('click', function() {
        overlay.style.display = 'none';
        popup.style.display = 'none';
    });

    overlay.addEventListener('click', function() {
        overlay.style.display = 'none';
        popup.style.display = 'none';
    });
</script>
